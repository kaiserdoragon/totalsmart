const swiper = new Swiper(".swiper", {
  centeredSlides: true,
  loop: true,
  speed: 700,
  slidesPerView: 7,
  autoplay: {
    delay: 3500,
    disableOnInteraction: false,
  },


  // ページネーション
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  }
});
