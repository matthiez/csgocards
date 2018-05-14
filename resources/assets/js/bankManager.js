class BankManager {
  constructor(items = [], itemsValue = 0, loadInventoryFrom = "") {
    this.items = items
    this.itemsValue = itemsValue
    this.loadInventoryFrom = loadInventoryFrom
  }

  addItem(assetid, value) {
    if (this.items.includes(assetid)) {
      this.items.splice(this.items.indexOf(assetid), 1)
      this.itemsValue -= parseInt(value)
    }
    else {
      this.items.push(assetid)
      this.itemsValue += parseInt(value)
    }
  }

  reset() {
    this.items = []
    this.itemsValue = 0
  }
}

export default new BankManager()