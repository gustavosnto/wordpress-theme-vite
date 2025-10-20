import "../scss/style.scss";
import { initMenu } from "./modules/menu";
import { initSlider } from "./modules/slider";

document.addEventListener("DOMContentLoaded", () => {
  console.log("🚀 Tema carregado com SCSS + TailwindCSS + Swiper!");

  initMenu();
  initSlider();
});

if (import.meta.hot) {
  import.meta.hot.accept();
}
