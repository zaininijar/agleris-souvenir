const navbar = document.querySelector(".navbar");
function navbarScrollInit() {
  if (window.scrollY > 1) {
    navbar.classList.add("navbar-scroll");
  } else {
    navbar.classList.remove("navbar-scroll");
  }
}

document.addEventListener("scroll", () => {
  navbarScrollInit();
});
