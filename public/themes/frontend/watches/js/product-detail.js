const swiper = new Swiper(".detail-img-slider", {
  loop: true,
  spaceBetween: 8,
  slidesPerView: "auto",
  freeMode: true,
  watchSlidesProgress: true,
  speed: 800,

  breakpoints: {
    768: {
      spaceBetween: 20,
    },
    992: {
      slidesPerView: 5,
      direction: "vertical",
    },
  },
});
const swiper2 = new Swiper(".detail-thumb", {
  loop: true,
  spaceBetween: 10,
  speed: 800,
  navigation: {
    nextEl: ".detail-img-next",
    prevEl: ".detail-img-prev",
  },
  thumbs: {
    swiper: swiper,
  },
});
