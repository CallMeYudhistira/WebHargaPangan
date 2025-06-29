const SIDEBAR_APP = document.querySelector(".sidebar-app");
const HAMBURGER_MENU = document.querySelector(".menu-mobile");
const SIDEBAR_CLOSE_BUTTON = document.getElementById("close-sidebar");

HAMBURGER_MENU.addEventListener("click", () => {
  SIDEBAR_APP.classList.add("visible");
});

SIDEBAR_CLOSE_BUTTON.addEventListener("click", () => {
  SIDEBAR_APP.classList.remove("visible");
});