import { initMenu } from "./modules/menu";
import { initSlider } from "./modules/slider";
import initFooter from "./modules/footer";

document.addEventListener("DOMContentLoaded", () => {
  console.log("🚀 Tema carregado com SCSS + TailwindCSS + Swiper!");
  initMenu();
  initSlider();
  initFooter();
});

if (import.meta.hot) {
  import.meta.hot.accept();
}
