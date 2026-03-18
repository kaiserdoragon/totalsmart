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
    },
    // 1481px以上
    1481: {
      slidesPerView: 7,
    },
  },
});





const recruitslider = new Swiper(".recruit_lead .swiper", {
  loop: true,
  slidesPerView: 2.5,
  speed: 6000,
  allowTouchMove: false,
  autoplay: {
    delay: 0,
  },
  breakpoints: {
    // 481px以上
    481: {
      slidesPerView: 3,
    },
    // 1025px以上
    1025: {
      slidesPerView: 6,
    },
  },
});