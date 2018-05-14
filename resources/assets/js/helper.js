import bankManager from "./bankManager"
import Axios from "axios"
import {AdditionalError, LaraError} from "./errors"
import {$poker, $selected, $toolbar, $itemContainers} from "./elements"
import noty from "./notyHelper"

export default class Helper {
  static get axios() {
    return Axios.create({
      timeout: 60000,
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": Helper.getMetaTagByName("csrf-token"),
        "X-Requested-With": "XMLHttpRequest"
      },
      validateStatus: status => status >= 200 && status < 300
    })
  }

  static axiosErrorHandler(err) {
    if (err.response) {
      if (err.response.status === 400)
        return new AdditionalError(err.response.data || "Unknown error!")
      else if (err.response.status === 422)
        return new LaraError(err.response.data || "Unknown error!")
      else
        return new Error(`The request was made and the server responded with a status code that falls out of the range of 400 & 422`)
    }
    console.log(`Axios: err.response empty`, err)
    if (err.request)
      console.log(`The request was made but no response was received, 'error.request' is an instance of XMLHttpRequest`)
    else console.log(`Something happened in setting up the request that triggered an Error`)
    return null
  }

  static currentTime(timeZone = UserData.General.timezone ? UserData.General.timezone : "Europe/Berlin") {
    return (new Date()).toLocaleTimeString([], {
      timeZone,
      hour: "2-digit",
      minute: "2-digit",
      second: "2-digit"
    })
  }

  static afterSubmitTrade() {
    Helper.clearClassesSelectedBankItems($itemContainers)
    $selected.innerHTML = ""
    $toolbar.style.display = "none"
  }

  static afterCreateCustomRingGame(form, config, customRingGameData) {
    $poker.myCustomGames.querySelector("tbody").insertAdjacentHTML("afterbegin", customRingGameData.html)
    componentHandler.upgradeDom()
    form.reset()
    config.style.display = "none"
    noty.noty({
      text: `${Helper.currentTime()} ${"msg" in customRingGameData ? customRingGameData.msg : String(customRingGameData)}`,
      layout: "center",
      theme: "relax",
      type: "success",
      closeWith: ["button"]
    })
  }

  static upload(url, form, file) {
    if (!window.File || !window.FileReader || !window.FileList || !window.Blob)
      throw new Error("The File APIs are not fully supported in this browser.")
    const reader = new FileReader()
    reader.onload = () => {
      Helper.axios.post(url, new FormData(form))
        .then(res => noty.success(res.data))
        .catch(err => Helper.axiosErrorHandler(err))
    }
    reader.readAsDataURL(file)
  }

  static addItemClickListeners() {
    [...$itemContainers].forEach(container => {
      if (container.classList.contains("item-not-accepted"))
        return
      container.addEventListener("click", () => {
        container.classList.toggle("selected")
        bankManager.addItem(container.dataset.assetid, container.dataset.value)
        if (bankManager.items.length < 1) {
          $selected.innerHTML = ""
          $toolbar.style.display = "none"
          return
        }
        $selected.innerHTML = `<b>${bankManager.items.length} ${bankManager.items.length === 1 ? "item" : "items"} selected with a total value of ${bankManager.itemsValue} chips</b>`
        $toolbar.style.display = "block"
      })
    })
  }

  static sortItems(inv) {
    return [].map.call(inv.children, Object).sort((b, a) => (a.dataset.value - b.dataset.value)).forEach(elem => inv.appendChild(elem))
  }

  static clearClassesSelectedBankItems(itemContainers) {
    [...itemContainers].forEach(elem => elem.classList.remove("selected"))
  }

  static toggle(ele) {
    ele.style.display = ele.style.display === "none" ? "block" : "none"
  }

  static getMetaTagByName(name) {
    return document.head.querySelector(`[name=${name}]`).content
  }
}