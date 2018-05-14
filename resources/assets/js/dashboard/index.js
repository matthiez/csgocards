import general from "./general"
import myCustomGames from "./my-custom-games"
import overview from "./overview"
import poker from "./poker"

export default (() => {
  general()
  myCustomGames()
  overview()
  poker()
})()