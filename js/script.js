// Toggle class active
const navbarNav = document.querySelector(".navbar-nav");
const wrapper = document.querySelector(".wrapper");

// Ketika hamburger menu diklik
document.querySelector("#hamburger-menu");
onclick = () => {
  navbarNav.classList.toggle("active");
  wrapper.classList.toggle("aktif");
};

// Klik diluar sidebar untuk menghilangkan nav
document.addEventListener("click", function (e) {
  if (navbarNav.contains(e.target)) {
    navbarNav.classList.remove("active");
  }
  if (wrapper.contains(e.target)) {
    wrapper.classList.remove("aktif");
  }
});