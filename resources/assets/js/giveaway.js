import helper from "./helper"
import {$enterGiveaway, $header, $toggleCinema} from "./elements"

export default (() => {
  $enterGiveaway && $enterGiveaway.addEventListener("submit", ev => {
    ev.preventDefault()
    helper.axios.post($enterGiveaway.getAttribute("action"), new FormData($enterGiveaway))
      .then(res => helper.success(res.data))
      .catch(err => helper.axiosErrorHandler(err))
  })
  $toggleCinema && $toggleCinema.addEventListener("click", () => helper.toggle($header))
})()