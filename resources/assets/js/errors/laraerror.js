import noty from "../notyHelper"

export default class LaraError extends Error {
  constructor(errData) {
    super(errData)
    this.errData = errData
    this.name = "LaraError"
    if (typeof(Error.captureStackTrace) === "function") Error.captureStackTrace(this, this.name)
    else this.stack = (new Error(this.errData)).stack

    let errors = ""
    if (Object.keys(this.errData).length >= 1) {
      for (let msg in this.errData) {
        if (!this.errData.hasOwnProperty(msg)) continue
        errors += `<li>${this.errData[msg]}</li>`
      }
    }
    else errors += `<li>No errors sent with the response.</li>`

    noty.error(`
            <b>${this.name}</b>
            <ul>
                ${errors}
            </ul>
        `)
  }
}
