import { Swiper } from "swiper";
import { Navigation, Pagination, Autoplay, EffectFade } from "swiper/modules";
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import "swiper/css/autoplay";
import "swiper/css/effect-fade";

export function initSlider() {
  // Configuração padrão do Swiper
  const swiperElements = document.querySelectorAll(".swiper");

  if (swiperElements.length === 0) {
    console.log("Nenhum elemento .swiper encontrado");
    return;
  }

  swiperElements.forEach((element) => {
    new Swiper(element, {
      modules: [Navigation, Pagination, Autoplay, EffectFade],

      // Configurações básicas
      slidesPerView: 1,
      spaceBetween: 30,
      loop: true,

      // Autoplay
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },

      // Navegação
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },

      // Paginação
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },

      // Responsive breakpoints
      breakpoints: {
        640: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 2,
          spaceBetween: 30,
        },
        1024: {
          slidesPerView: 3,
          spaceBetween: 40,
        },
      },
    });
  });

  console.log("Swiper inicializado com sucesso!");
}
