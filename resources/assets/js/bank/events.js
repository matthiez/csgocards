import {$inventory, $deposit, $selectInventory, $withdraw} from "../elements"
import helper from "../helper"
import bankManager from "../bankManager"
import sockets from "../socket"
import noty from "../notyHelper"

export default (() => {
  $deposit && $deposit.addEventListener("submit", async ev => {
    ev.preventDefault()
    $deposit.querySelector("input[name=\"items\"]").value = JSON.stringify(bankManager.items)
    try {
      const res = await helper.axios.post($deposit.getAttribute("action"), new FormData($deposit))
      if ("data" in res) {
        const data = res.data
        sockets.bank.emit("deposit", data)
        noty.success(`Deposit ${data} has started.<br>`)
      }
    }
    catch (err) {
      helper.axiosErrorHandler(err)
    }
    finally {
      bankManager.reset()
      helper.afterSubmitTrade()
    }
  })

  $selectInventory && $selectInventory.addEventListener("change", async () => {
    let data = []
    try {
      const res = await helper.axios.post($selectInventory.form.getAttribute("action"), new FormData($selectInventory.form))
      data = res.data
    }
    catch (err) {
      helper.axiosErrorHandler(err)
    }
    if (Array.isArray(data) && data.length) {
      $inventory.innerHTML = ""
      for (const item of data) {
        if (!item.tradable) continue
        if (!item.marketable) continue
        if (Number(item.appid) !== 730) continue
        if (Number(item.contextid) !== 2) continue
        const value = Number(item.value)
        if (item.value === 0) continue
        const marketHashname = item.market_hash_name
        if (marketHashname.includes("Souvenir")) continue
        const assetId = item.assetid
        $inventory.insertAdjacentHTML("beforeend", `<div class='mdl-cell mdl-cell--2-col-desktop mdl-cell--4-col-phone item-container' data-value='${value}' data-selected='0' data-assetid='${assetId}'>
                        <div class='rarity ${item.rarity}'></div>
                        <div class='helper'>
                            <span class='value'>${value}</span>
                            <span>
                                <img src='${window.App.staticUrl}img/poker-chip-16.png' alt='value' height='16' width='16' />
                            </span>
                        </div>
                        <div class='thumb'>
                            <img src='http://steamcommunity-a.akamaihd.net/economy/image/${item.icon_url}/150fx150f' alt='${marketHashname}' class='center' />
                        </div>
                        <div class='name text-center'>${marketHashname}</div>
                    </div>`)
      }
      $withdraw.querySelector("input[name=\"inventory\"]").value = $selectInventory.value
    }
    else console.error("Expected array.")
    helper.sortItems($inventory)
    helper.addItemClickListeners()
  })

  $withdraw && $withdraw.addEventListener("submit", async ev => {
    ev.preventDefault()
    $withdraw.querySelector("input[name=\"items\"]").value = JSON.stringify(bankManager.items)
    try {
      const res = await helper.axios.post($withdraw.getAttribute("action"), new FormData($withdraw))
      if ("data" in res) {
        const data = res.data
        sockets.bank.emit("withdrawal", data)
        noty.success(`Withdrawal ${data} has started.<br>`)
      }
    }
    catch (err) {
      helper.axiosErrorHandler(err)
    }
    finally {
      bankManager.reset()
      helper.afterSubmitTrade()
    }
  })
})()