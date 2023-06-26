const hamburger = document.querySelector(".hamburger input");
const nav = document.querySelector("nav .menu");

hamburger.addEventListener("click", function () {
  nav.classList.toggle("slide");
});
