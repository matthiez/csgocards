export const $poker = {
  customAvatar: document.getElementById("custom_avatar"),
  myCustomGames: document.getElementById("my_custom_games"),
  deleteMyCustomGames: document.getElementById("delete_my_custom_games"),
  createRingGame: document.getElementsByClassName("create_ring_game")
}

export const $myPokerOverview = {
  propRake: document.querySelector("#my_poker_overview .prop-rake"),
  equalRake: document.querySelector("#my_poker_overview .equal-rake"),
  inPlayCash: document.querySelector("#my_poker_overview .inplay-cg"),
  inPlayTourney: document.querySelector("#my_poker_overview .inplay-tourney"),
  tourneyFees: document.querySelector("#my_poker_overview .tourney-fees"),
  update: document.getElementById("update_my_poker")
}

export const $customAvatar = document.getElementById("custom_avatar")
export const $location = document.getElementById("location")
export const $header = document.querySelector("header")
export const $enterGiveaway = document.getElementById("enter_giveaway")
export const $inventory = document.getElementById("inventory")
export const $selectInventory = document.getElementById("select_inventory")
export const $itemContainers = document.getElementsByClassName("item-container")
export const $selected = document.getElementById("selected")
export const $setTradelink = document.getElementById("tradelink")
export const $toolbar = document.getElementById("toolbar")
export const $balance = document.getElementsByClassName("balance")
export const $avatars = document.querySelectorAll("input[name=avatar]")
export const $toggleCinema = document.getElementById("toggle_cinema")
export const $timezone = document.getElementById("timezone")
export const $tradeLink = document.getElementById("trade_link")
export const $deposit = document.getElementById("deposit")
export const $withdraw = document.getElementById("withdraw")
export const $noTitleOnHover = document.getElementsByClassName("hover-no-title")

export default {
  $poker,
  $myPokerOverview,
  $customAvatar,
  $location,
  $header,
  $enterGiveaway,
  $inventory,
  $selectInventory,
  $itemContainers,
  $selected,
  $setTradelink,
  $toolbar,
  $balance,
  $avatars,
  $toggleCinema,
  $timezone,
  $tradeLink,
  $deposit,
  $withdraw,
  $noTitleOnHover
}