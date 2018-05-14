import "babel-polyfill"
import mdl from "material-design-lite"
import mdlComp from "mdl-components-ext"
import mdlSelect
  from "../../../node_modules/mdl-selectfield/dist/mdl-selectfield.min.js"

import "./bank/index"
import "./dashboard"
import "./giveaway"
import "./theme"

window.addEventListener("rejectionhandled", rejectionhandled => console.log({rejectionhandled}))
window.addEventListener("unhandledrejection", unhandledrejection => console.log({unhandledrejection}))