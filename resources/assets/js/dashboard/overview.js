import {$myPokerOverview} from "../elements"
import {bank} from "../socket"

export default () => {
  $myPokerOverview.update && $myPokerOverview.update.addEventListener("click", () => bank.emit("update_my_poker"))
}