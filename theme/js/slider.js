const swiper = new Swiper(".works .swiper", {
  centeredSlides: true,
  loop: true,
  speed: 1000,

  // 480px以下
  slidesPerView: 1.8,
  spaceBetween: 5,

  autoplay: {
    delay: 3000,
    disableOnInteraction: false,
  },

  breakpoints: {
    // 481px以上
    481: {
      slidesPerView: 3,
    },
    // 1025px以上
    1025: {
      slidesPerView: 5,
      slidesPerView: 1.8,
    },
    // 1481px以上
    1481: {
      slidesPerView: 7,
    },
  },
});
