import { Swiper } from "swiper";
import { Navigation, Pagination, Autoplay, EffectFade } from "swiper/modules";
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import "swiper/css/autoplay";
import "swiper/css/effect-fade";

export function initSlider() {
  // Hero Slider específico
  const heroSlider = document.querySelector(".hero-swiper");
  if (heroSlider) {
    console.log("🦸 Inicializando Hero Slider");
    new Swiper(heroSlider, {
      modules: [Navigation, Pagination, Autoplay, EffectFade],
      slidesPerView: 1,
      spaceBetween: 0,
      loop: true,
      autoplay: {
        delay: 8000,
        disableOnInteraction: false,
      },
      navigation: {
        nextEl: ".hero-swiper .swiper-button-next",
        prevEl: ".hero-swiper .swiper-button-prev",
      },
      pagination: {
        el: ".hero-swiper .swiper-pagination",
        clickable: true,
      },
      effect: "fade",
      fadeEffect: {
        crossFade: true,
      },
    });
  }

  console.log("Swiper inicializado com sucesso!");
}
