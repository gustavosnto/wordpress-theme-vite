import { initSlider } from "./modules/slider";

document.addEventListener("DOMContentLoaded", () => {
  console.log("🚀 Tema carregado com SCSS + TailwindCSS + Swiper!");
  initSlider();
});

if (import.meta.hot) {
  import.meta.hot.accept();
}
