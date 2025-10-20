export function initMenu() {
  const menuToggle = document.querySelector(".menu-toggle");
  const menu = document.querySelector(".main-navigation");

  if (menuToggle && menu) {
    menuToggle.addEventListener("click", () => {
      menu.classList.toggle("active");
      menuToggle.classList.toggle("active");
    });
  }
}
