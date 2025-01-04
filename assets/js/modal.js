const modal = document.querySelector(".modal");
const overlay = document.querySelector(".overlay");
const btnCloseModal = document.querySelector(".btn--close-modal");

///////////////////////////////////////
// Modal window
console.log(modal);

const openModal = function () {
  overlay.classList.remove("hidden");
};

const closeModal = function () {
  overlay.classList.add("hidden");
};
document.addEventListener("click", function (e) {
  if (e.target.classList.contains("btn--show-modal")) {
    openModal();
  }
});

btnCloseModal.addEventListener("click", closeModal);
overlay.addEventListener("click", closeModal);

document.addEventListener("keydown", function (e) {
  if (e.key === "Escape" && !modal.classList.contains("hidden")) {
    closeModal();
  }
});
