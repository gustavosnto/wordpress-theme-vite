export function initMenu() {
  const menuToggle = document.querySelector(".menu-toggle");
  const mobileMenu = document.querySelector(".mobile-menu");
  const header = document.querySelector(".site-header");

  // Elementos do modal de busca
  const searchToggle = document.querySelector("#search-toggle");
  const searchToggleMobile = document.querySelector("#search-toggle-mobile");
  const searchModal = document.querySelector("#search-modal");
  const searchClose = document.querySelector("#search-close");
  const searchInput = document.querySelector("#search-input");

  // Toggle menu mobile
  if (menuToggle && mobileMenu) {
    menuToggle.addEventListener("click", () => {
      const isOpen = mobileMenu.classList.contains("active");

      if (isOpen) {
        closeMobileMenu();
      } else {
        openMobileMenu();
      }
    });
  }

  // Fecha menu ao clicar nos links
  const mobileLinks = document.querySelectorAll(".mobile-menu a");
  mobileLinks.forEach((link) => {
    link.addEventListener("click", () => {
      closeMobileMenu();
    });
  });

  // Modal de busca - Desktop
  if (searchToggle && searchModal) {
    searchToggle.addEventListener("click", () => {
      openSearchModal();
    });
  }

  // Modal de busca - Mobile
  if (searchToggleMobile && searchModal) {
    searchToggleMobile.addEventListener("click", () => {
      closeMobileMenu();
      setTimeout(() => openSearchModal(), 300); // Aguarda fechar menu mobile
    });
  }

  // Fechar modal de busca
  if (searchClose && searchModal) {
    searchClose.addEventListener("click", () => {
      closeSearchModal();
    });
  }

  // Fechar modal clicando no backdrop
  if (searchModal) {
    searchModal.addEventListener("click", (e) => {
      if (e.target === searchModal) {
        closeSearchModal();
      }
    });
  }

  // Fecha menu e modal com Escape
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
      if (searchModal?.classList.contains("active")) {
        closeSearchModal();
      } else if (mobileMenu?.classList.contains("active")) {
        closeMobileMenu();
      }
    }
  });

  // Scroll header effect
  let lastScrollY = window.scrollY;

  window.addEventListener("scroll", () => {
    const scrollY = window.scrollY;

    // Adiciona classe scrolled quando rolar
    if (scrollY > 50) {
      header?.classList.add("scrolled");
    } else {
      header?.classList.remove("scrolled");
    }

    lastScrollY = scrollY;
  });

  function openMobileMenu() {
    mobileMenu?.classList.add("active");
    menuToggle?.classList.add("active");
    menuToggle?.setAttribute("aria-expanded", "true");
    menuToggle?.setAttribute("aria-label", "Fechar menu");
    document.body.style.overflow = "hidden"; // Previne scroll
  }

  function closeMobileMenu() {
    mobileMenu?.classList.remove("active");
    menuToggle?.classList.remove("active");
    menuToggle?.setAttribute("aria-expanded", "false");
    menuToggle?.setAttribute("aria-label", "Abrir menu");
    document.body.style.overflow = ""; // Restaura scroll
  }

  // Funções do modal de busca
  function openSearchModal() {
    if (searchModal) {
      searchModal.classList.remove("opacity-0", "invisible");
      searchModal.classList.add("opacity-100", "visible", "active");
      searchModal.querySelector(".bg-white").classList.remove("scale-95");
      searchModal.querySelector(".bg-white").classList.add("scale-100");

      document.body.style.overflow = "hidden";

      // Foco no input de busca
      setTimeout(() => {
        searchInput?.focus();
      }, 150);
    }
  }

  function closeSearchModal() {
    if (searchModal) {
      searchModal.classList.add("opacity-0", "invisible");
      searchModal.classList.remove("opacity-100", "visible", "active");
      searchModal.querySelector(".bg-white").classList.add("scale-95");
      searchModal.querySelector(".bg-white").classList.remove("scale-100");

      document.body.style.overflow = "";
      searchInput?.blur();
    }
  }

  // Submenu mobile toggle
  const menuItemsWithChildren = document.querySelectorAll(
    ".mobile-menu .menu-item-has-children > a"
  );

  menuItemsWithChildren.forEach((item) => {
    item.addEventListener("click", (e) => {
      e.preventDefault();
      const submenu = item.nextElementSibling;
      const isOpen = submenu?.classList.contains("open");

      // Fecha todos os outros submenus
      document.querySelectorAll(".mobile-menu .sub-menu").forEach((sub) => {
        sub.classList.remove("open");
      });

      // Toggle do submenu atual
      if (!isOpen && submenu) {
        submenu.classList.add("open");
      }
    });
  });

  // Smooth scroll para âncoras
  const anchorLinks = document.querySelectorAll('a[href^="#"]');

  anchorLinks.forEach((link) => {
    link.addEventListener("click", (e) => {
      const href = link.getAttribute("href");

      if (href === "#") return;

      const target = document.querySelector(href);

      if (target) {
        e.preventDefault();
        closeMobileMenu();

        target.scrollIntoView({
          behavior: "smooth",
          block: "start",
        });
      }
    });
  });
}
