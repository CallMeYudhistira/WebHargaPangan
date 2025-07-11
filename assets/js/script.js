MicroModal.init();

function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.querySelectorAll('input[type="text"]').forEach(function (input) {
            input.value = '';
        });
    }

    MicroModal.show(modalId);
}

const SIDEBAR_APP = document.querySelector(".sidebar-app");
const HAMBURGER_MENU = document.querySelector(".menu-mobile");
const SIDEBAR_CLOSE_BUTTON = document.getElementById("close-sidebar");

HAMBURGER_MENU.addEventListener("click", () => {
  SIDEBAR_APP.classList.add("visible");
});

SIDEBAR_CLOSE_BUTTON.addEventListener("click", () => {
  SIDEBAR_APP.classList.remove("visible");
});

const onSearch = (event) => {
  if (event.key === 'Enter') {
    const value = event.target.value;
    const url = new URL(window.location);
    url.searchParams.set('search', value);
    window.location.href = url;
  }
};

const onSearchLoad = () => {
  const params = new URLSearchParams(window.location.search);
  const search = params.get('search');
  if (search) {
    const input = document.querySelector('.search-input');
    if (input) input.value = search;
  }
};

document.body.onload = onSearchLoad();