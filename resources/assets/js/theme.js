import {$header, $toggleCinema, $noTitleOnHover} from "./elements"
import helper from "./helper"

export default (() => {
  $toggleCinema && $toggleCinema.addEventListener("click", () => helper.toggle($header));

  [...$noTitleOnHover].forEach(ele => ele.addEventListener("mouseover", () => {
    ele.title = ""
  }))
})()