import helper from "../helper"
import notyHelper from "../notyHelper"
import {$tradeLink, $timezone} from "../elements"

export default () => {
  $tradeLink && $tradeLink.addEventListener("change", () => {
    helper.axios.post($tradeLink.form.getAttribute("action"), new FormData($tradeLink.form))
      .then(res => {
        const tradelink = res.data
        UserData.Steam.tradeLink = tradelink
        notyHelper.success(`Your tradelink has been updated to ${tradelink}`)
      })
      .catch(err => helper.axiosErrorHandler(err))
  })

  $timezone && $timezone.addEventListener("change", () => {
    helper.axios.post($timezone.form.getAttribute("action"), new FormData($timezone.form))
      .then(res => {
        const timezone = res.data
        UserData.General.timezone = timezone
        notyHelper.success(`Your timezone has been updated to ${timezone}`)
      })
      .catch(err => helper.axiosErrorHandler(err))
  })
}
