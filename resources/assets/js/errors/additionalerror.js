import noty from "../notyHelper"

export default class AdditionalError extends Error {
  constructor(errData = "Undefined Error!") {
    super(errData)
    this.errData = errData
    this.name = "AdditionalError"
    if (typeof(Error.captureStackTrace) === "function") Error.captureStackTrace(this, this.name)
    else this.stack = (new Error(this.errData)).stack

    noty.error(`
            <b>${this.name}</b>
            <ul>
                ${this.errData}
            </ul>
        `)
  }
}