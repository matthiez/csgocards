import {$poker, $location, $avatars} from "../elements"
import helper from "../helper"
import noty from "../notyHelper"

export default () => {
  if (window.location.pathname !== "/registration") {
    (function pokerSetAvatarCustom() {
      $poker.customAvatar && $poker.customAvatar.addEventListener("change", () => helper.upload(
        $poker.customAvatar.form.getAttribute("action"), $poker.customAvatar.form, $poker.customAvatar.files[0]))
    })()
  }

  for (let form of $poker.createRingGame) {
    const selectGame = form.querySelector("select[name=game]")
    const config = form.querySelector(".config")
    //const type = form.querySelector('input[name=type]').value;

    config.style.display = "none"

    selectGame && selectGame.addEventListener("change", () => {
      config.style.display = "block"
    })

    form && form.addEventListener("submit", (ev) => {
      ev.preventDefault()
      helper.axios.post(form.getAttribute("action"), new FormData(form))
        .then(res => helper.afterCreateCustomRingGame(form, config, res.data))
        .catch(err => helper.axiosErrorHandler(err))
    })
  }

  $location && $location.addEventListener("change", () => {
    helper.axios.post($location.form.getAttribute("action"), new FormData($location.form))
      .then(res => noty.success(res.data))
      .catch(err => {
        helper.axiosErrorHandler(err)
      })
  })

  $avatars && [...$avatars].forEach(avatar => {
    avatar.addEventListener("click", () => {
      if (avatar.nextElementSibling.style.outline === "") avatar.nextElementSibling.style.outline = "1px dotted grey"
      else avatar.nextElementSibling.style.outline = ""
      if (window.location.pathname !== "/registration") {
        helper.axios.post(avatar.form.getAttribute("action"), new FormData(avatar.form))
          .then(res => noty.success(res.data))
          .catch(err => helper.axiosErrorHandler(err))
          .then(() => {
            avatar.nextElementSibling.style.outline = ""
          })
      }
    })
  });

  (function pokerDeleteMyCustomGames() {
    if ($poker.myCustomGames) {
      const eles = $poker.myCustomGames.querySelectorAll("tbody .mdl-data-table__select")
      const toggleAll = $poker.myCustomGames.querySelector("thead .mdl-data-table__select input")

      const customGameIds = new Proxy([], {
        get: (target, property) => target[property],
        apply: (target, thisArg, args) => thisArg[target].apply(this, args),
        deleteProperty: (target, property) => true,
        set(target, property, value) {
          target[property] = value
          $poker.deleteMyCustomGames.querySelector("button[type=submit]").disabled = target.length <= 0
          return true
        }
      })

      toggleAll && toggleAll.addEventListener("change", () => {
        customGameIds.length = 0
        if (toggleAll.checked) {
          for (let i = 0, length = eles.length; i < length; i++) {
            eles[i].MaterialCheckbox.check()
            customGameIds.push(eles[i].dataset.id)
          }
        }
        else for (let i = 0, length = eles.length; i < length; i++) eles[i].MaterialCheckbox.uncheck()
      })

      for (let ele of eles) {
        ele.addEventListener("change", function (ev) {
          if (ev.target.checked && !customGameIds.includes(ele.dataset.id)) customGameIds.push(ele.dataset.id)
          else {
            const i = customGameIds.indexOf(ele.dataset.id)
            if (i > -1) customGameIds.splice(i, 1)
          }
        })
      }

      $poker.deleteMyCustomGames && $poker.deleteMyCustomGames.addEventListener("submit", (ev) => {
        ev.preventDefault()
        $poker.deleteMyCustomGames.querySelector("input[name=customGameIds]").value = JSON.stringify(customGameIds)
        helper.axios.post($poker.deleteMyCustomGames.getAttribute("action"), new FormData($poker.deleteMyCustomGames))
          .then(res => {
            for (let customGameId of customGameIds) $poker.myCustomGames.querySelector("tbody > tr[data-id=" + customGameId + "]").remove()
            noty.success(res.data)
          })
          .catch(err => helper.axiosErrorHandler(err))
          .then(() => toggleAll.classList.remove("is-checked"))
      })
    }
  })()
}