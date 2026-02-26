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





const recruitslider = new Swiper(".recruit_lead .swiper", {
  loop: true, // ループ有効
  slidesPerView: 6, // 一度に表示する枚数
  speed: 6000, // ループの時間
  allowTouchMove: false, // スワイプ無効
  autoplay: {
    delay: 0, // 途切れなくループ
  },
});