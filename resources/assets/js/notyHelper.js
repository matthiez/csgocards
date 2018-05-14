import Noty from "noty"
import helper from "./helper"

export default class NotyHelper {
  static notice({
                  data = "Undefined notice. Please contact an admin.",
                  type = "information",
                  closeWith = "click",
                  position = "bottomCenter"
                }) {
    return new Noty({
      text: `${helper.currentTime()} ${data}`,
      layout: position,
      theme: "semanticui",
      type: type,
      closeWith: [closeWith]
    }).show()
  }

  static success(data) {
    NotyHelper.notice({data, type: "success"})
  }

  static info(data) {
    NotyHelper.notice({data, type: "success"})
  }

  static error(data) {
    NotyHelper.notice({data, type: "error"})
  }

  static warn(data) {
    NotyHelper.notice({data, type: "warning"})
  }

  static noty(opts) {
    new Noty(opts).show()
  }
}