"use strict";
const menu = document.querySelector(".menu");
const items = document.querySelector(".items");
const links = document.querySelector(".links");
const navIcons = document.querySelector("nav .icons");
console.log(menu);
function toggleMenu() {
  items.classList.toggle("show");
  links.classList.toggle("show");
  navIcons.classList.toggle("show");
}
menu.addEventListener("click", toggleMenu);

// Slider
// const slider = function () {
//   const slides = document.querySelectorAll(".card-deck");
//   const btnLeft = document.querySelector(".card-btn--left");
//   const btnRight = document.querySelector(".card-btn--right");

//   let curSlide = 0;
//   const maxSlide = slides.length;

//   // Functions
//   const goToSlide = function (slide) {
//     slides.forEach(
//       (s, i) => (s.style.transform = `translateX(${100 * (i - slide)}%)`)
//     );
//   };

//   const nextSlide = function () {
//     if (curSlide === maxSlide - 1) {
//       curSlide = 0;
//     } else {
//       curSlide++;
//     }

//     goToSlide(curSlide);
//     activateDot(curSlide);
//   };

//   const prevSlide = function () {
//     if (curSlide === 0) {
//       curSlide = maxSlide - 1;
//     } else {
//       curSlide--;
//     }
//     goToSlide(curSlide);
//     activateDot(curSlide);
//   };

//   const init = function () {
//     goToSlide(0);
//   };
//   init();

//   // Event handlers
//   btnRight.addEventListener("click", nextSlide);
//   btnLeft.addEventListener("click", prevSlide);

//   document.addEventListener("keydown", function (e) {
//     if (e.key === "ArrowLeft") prevSlide();
//     e.key === "ArrowRight" && nextSlide();
//   });
// };
// slider();
