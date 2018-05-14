import {$inventory} from "../elements"
import helper from "../helper"
import renderInventory from "./renderInventory"

export default (() => {
  require("./events")

  if (window.location.pathname === "/deposit") {
    renderInventory()
    helper.sortItems($inventory)
    helper.addItemClickListeners()
  }
})()