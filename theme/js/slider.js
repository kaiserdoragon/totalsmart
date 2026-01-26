function initWorksSwiperOnView() {
  const swiperElement = document.querySelector(".works .swiper");
  if (!swiperElement) return;

  let swiper;

  const buildOptions = () => {
    const prefersReducedMotion = window.matchMedia?.("(prefers-reduced-motion: reduce)")?.matches;
    return {
      centeredSlides: true,
      loop: true,
      speed: 700,
      slidesPerView: 1.5,
      spaceBetween: 5,
      autoplay: prefersReducedMotion
        ? false
        : {
            delay: 3500,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
          },
      // 使っていないなら false 推奨（後述）
      watchSlidesProgress: false,
      breakpoints: {
        500: { slidesPerView: 1.8, spaceBetween: 5 },
        768: { slidesPerView: 3.5, spaceBetween: 10 },
        1025: { slidesPerView: 5.5, spaceBetween: 10 },
      },
      a11y: {
        prevSlideMessage: "前のスライドへ",
        nextSlideMessage: "次のスライドへ",
        paginationBulletMessage: "{{index}}枚目のスライドへ",
      },
    };
  };

  const init = () => {
    if (swiper) return;
    swiper = new Swiper(swiperElement, buildOptions());
  };

  // IntersectionObserver がなければ従来どおり初期化
  if (!("IntersectionObserver" in window)) {
    init();
    return;
  }

  // 200px 手前で初期化（スクロールでカクつきにくい）
  const io = new IntersectionObserver(
    (entries) => {
      if (!entries[0].isIntersecting) return;
      init();
      io.disconnect();
    },
    { rootMargin: "200px 0px" }
  );

  io.observe(swiperElement);
}

document.addEventListener("DOMContentLoaded", initWorksSwiperOnView);
