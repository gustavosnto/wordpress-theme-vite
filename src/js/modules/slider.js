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

  // Features Slider específico
  const featuresSlider = document.querySelector(".features-swiper");
  if (featuresSlider) {
    console.log("✨ Inicializando Features Slider");
    new Swiper(featuresSlider, {
      modules: [Navigation, Pagination, Autoplay],
      slidesPerView: 1,
      spaceBetween: 30,
      loop: true,
      autoplay: {
        delay: 4000,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".features-swiper .swiper-pagination",
        clickable: true,
      },
      breakpoints: {
        640: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        1024: {
          slidesPerView: 3,
          spaceBetween: 30,
        },
      },
    });
  }

  // Configuração padrão do Swiper para outros elementos
  const swiperElements = document.querySelectorAll(
    ".swiper:not(.hero-swiper):not(.features-swiper)"
  );

  console.log(
    "🔍 Elementos .swiper genéricos encontrados:",
    swiperElements.length
  );

  if (swiperElements.length === 0) {
    console.log("Nenhum elemento .swiper genérico encontrado");
  } else {
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
  }

  console.log("Swiper inicializado com sucesso!");
}
