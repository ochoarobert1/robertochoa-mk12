/* CUSTOM ON LOAD FUNCTIONS */
function robertochoaCustomLoad() {
  "use strict";
  console.log(
    "%c J.A.R.V.I.S Protocol Activated",
    "font-size: 12px; background: #BD121C; color: #FFF; padding: 3px 10px;"
  );
  window.addEventListener("scroll", (e) => {
    var currHeaderHeight = document.getElementById("mainHeader").clientHeight;
    if (window.pageYOffset > 105) {
      document.getElementById("mainHeader").classList.add("main-header-fixed");
      document
        .getElementById("mainRow")
        .setAttribute("style", "padding-top: " + currHeaderHeight + "px;");
    } else {
      document
        .getElementById("mainHeader")
        .classList.remove("main-header-fixed");
      document
        .getElementById("mainRow")
        .setAttribute("style", "padding-top: 0px;");
    }
  });

  const swiper = new Swiper(".swiper-success", {
    slidesPerView: 4,
    initialSlide: 4,
    direction: "horizontal",
    spaceBetween: 5,
    speed: 5000,
    loop: true,
    loopedSlidesLimit: false,
    autoplay: {
      delay: 0,
      waitForTransition: true,
      disableOnInteraction: false,
      pauseOnMouseEnter: false,
    },
  });
}

document.addEventListener("DOMContentLoaded", robertochoaCustomLoad, false);

document.getElementById("hamburger").addEventListener("click", (e) => {
  e.preventDefault();
  document.getElementById("hamburger").classList.toggle("open");
  document.getElementById("menu-main-menu").classList.toggle("open-menu");
});
