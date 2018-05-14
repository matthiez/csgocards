import {$inventory} from "../elements"

export default () => {
  const inventory = window.UserData.Inventory
  if (Array.isArray(inventory)) {
    for (const item of inventory) {
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
  }
}