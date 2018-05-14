import {bank} from "../socket"
import {$balance, $myPokerOverview} from "../elements"
import noty from "../notyHelper"

bank.addEventListener("err", bankErr => {
  console.log({bankErr})
  noty.error(bankErr)
})

bank.addEventListener("offer_declined", bankOfferDeclined => {
  console.log({bankOfferDeclined})
  noty.info(bankOfferDeclined)
})

bank.addEventListener("offer_invalid", bankOfferInvalid => {
  console.log({bankOfferInvalid})
  noty.info(bankOfferInvalid)
})

bank.addEventListener("offer_countered", bankOfferCountered => {
  console.log({bankOfferCountered})
  noty.warn(bankOfferCountered)
})

bank.addEventListener("offer_done", bankTradeDone => {
  console.log({bankTradeDone})
  noty.success(bankTradeDone.msg)
  if (window.location.pathname === "/deposit" || window.location.pathname === "/withdrawal") window.location.reload()
})

bank.addEventListener("offer_sent", bankOfferSent => {
  console.log({bankOfferSent})
  noty.success(bankOfferSent.msg || bankOfferSent)
})

bank.addEventListener("update_my_poker", bankUpdateMyPoker => {
  console.log({bankUpdateMyPoker})
  if ($myPokerOverview.propRake) $myPokerOverview.propRake.textContent = bankUpdateMyPoker.propRake
  if ($myPokerOverview.equalRake) $myPokerOverview.equalRake.textContent = bankUpdateMyPoker.equalRake
  if ($myPokerOverview.inPlayCash) $myPokerOverview.inPlayCash.textContent = bankUpdateMyPoker.inPlayCash
  if ($myPokerOverview.inPlayTourney) $myPokerOverview.inPlayTourney.textContent = bankUpdateMyPoker.inPlayTourney
  if ($myPokerOverview.tourneyFees) $myPokerOverview.tourneyFees.textContent = bankUpdateMyPoker.tourneyFees
})

bank.addEventListener("balance", bankBalance => {
  console.log({bankBalance})
  if (bankBalance.afterTrade) {
    noty.notice({
      data: `Trade done! Your new balance: ${bankBalance.balance} chips.`,
      type: "info",
      layout: "topRight",
      timeout: 5000
    })
  }
  $balance && [...$balance].forEach(ele => {
    ele.balance.textContent = bankBalance.balance
  })
})