/**
 * 導入実績スライダーの初期化関数
 */
function initWorksSwiper() {
  // 1. スライダーの要素を取得
  const swiperElement = document.querySelector(".swiper");

  // 2. 要素が存在しない場合は、ここで処理を終了（エラー防止）
  if (!swiperElement) {
    return;
  }

  // 3. Swiperを初期化
  const swiper = new Swiper(swiperElement, {
    // 基本設定
    centeredSlides: true,
    loop: true,
    speed: 700,
    slidesPerView: 1.5, // モバイルのデフォルト枚数
    spaceBetween: 5, // スライド間の余白

    // 自動再生の設定
    autoplay: {
      delay: 3500,
      disableOnInteraction: false,
      pauseOnMouseEnter: true, // マウスを乗せたら一時停止
    },

    // 表示パフォーマンスの最適化
    watchSlidesProgress: true,

    // レスポンシブ（画面幅による切り替え）
    breakpoints: {
      // 500px以上（大きめのスマホなど）
      500: {
        slidesPerView: 1.8,
        spaceBetween: 5,
      },
      // 768px以上（タブレット）
      768: {
        slidesPerView: 3.5,
        spaceBetween: 10,
      },
      // 1025px以上（PC）
      1025: {
        slidesPerView: 5.5,
        spaceBetween: 10,
      },
    },

    // アクセシビリティ（読み上げ対応）
    a11y: {
      prevSlideMessage: "前のスライドへ",
      nextSlideMessage: "次のスライドへ",
      paginationBulletMessage: "{{index}}枚目のスライドへ",
    },
  });
}

/**
 * 画面の読み込みが終わったら実行
 */
document.addEventListener("DOMContentLoaded", initWorksSwiper);
