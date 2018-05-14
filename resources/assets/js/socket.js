import io from "socket.io-client"
import cfg from "./config"

const port = cfg.io.port

export const main = io(":" + port)

export const bank = io(":" + port + "/bank")

export default {
  main,
  bank
}