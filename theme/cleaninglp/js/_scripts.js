"use strict";

// console.log("エアコンクリーニング");

window.addEventListener("DOMContentLoaded", function () {
  new ScrollHint(".js-scrollable", {
    scrollHintIconAppendClass: "scroll-hint-icon-white",
    suggestiveShadow: true,
    i18n: {
      scrollable: "スクロールできます",
    },
  });
});

// SP(<=767px)のときだけフッター追従ボタンを有効化
(() => {
  const btn = document.getElementById("js_fixed-btn");
  if (!btn) return;

  const THRESHOLD = 100;
  const mql = window.matchMedia("(max-width: 767px)");
  let controller = null;

  const update = () => {
    btn.classList.toggle("is-active", window.scrollY >= THRESHOLD);
  };

  const enable = () => {
    if (controller) return; // すでに有効
    controller = new AbortController();
    const opts = { passive: true, signal: controller.signal };

    // 初期反映
    if (document.readyState === "loading") {
      document.addEventListener("DOMContentLoaded", update, { once: true });
    } else {
      update();
    }

    // スクロール/リサイズで状態更新（SP時のみ有効）
    window.addEventListener("scroll", update, opts);
    window.addEventListener("resize", update, opts);
  };

  const disable = () => {
    if (!controller) return;
    controller.abort(); // まとめてリスナー解除
    controller = null;
    btn.classList.remove("is-active"); // デスクトップへ戻ったら非表示に
  };

  // 初期判定
  mql.matches ? enable() : disable();

  // 767pxをまたいだら有効/無効を切り替え
  mql.addEventListener("change", (e) => (e.matches ? enable() : disable()));
})();

// ヘッダーのスクロール位置を取得 /////////////////////////////////////////////
// headerの高さ分スクロールしたら、-fixedクラスをつける。
const Header = document.getElementById("js-header");
if (Header) {
  const options = {
    root: null,
    rootMargin: `${Header.offsetHeight}px 0px ${document.body.clientHeight}px 0px`,
    threshold: 1,
  };

  const observer = new IntersectionObserver(change_header, options);
  observer.observe(document.body);
  function change_header(entries) {
    if (!entries[0].isIntersecting) {
      Header.classList.add("-fixed");
    } else {
      Header.classList.remove("-fixed");
    }
  }
}

// SP(<=767px)のときだけヘッダーのフェードで消去
// const header = document.querySelector(".header");
// const mediaQuery = window.matchMedia("(max-width: 767px)");
// let lastScrollY = window.scrollY;

// if (header) {
//   window.addEventListener(
//     "scroll",
//     () => {
//       const currentScrollY = window.scrollY;

//       // スマホ幅以外では発動しない
//       if (!mediaQuery.matches) {
//         header.classList.remove("is-hide");
//         lastScrollY = currentScrollY;
//         return;
//       }

//       if (currentScrollY > 100 && currentScrollY > lastScrollY) {
//         // 下スクロール
//         header.classList.add("is-hide");
//       } else {
//         // 上スクロール、またはページ上部
//         header.classList.remove("is-hide");
//       }

//       lastScrollY = currentScrollY;
//     },
//     { passive: true }
//   );

//   mediaQuery.addEventListener("change", () => {
//     if (!mediaQuery.matches) {
//       header.classList.remove("is-hide");
//     }

//     lastScrollY = window.scrollY;
//   });
// }

// グローバルナビゲーション //////////////////////////////////////////////////////
const Gnav_btn = document.getElementById("js-gnav_btn");
const Gnav = document.getElementById("js-gnav");
if (Gnav_btn) {
  Gnav_btn.addEventListener("click", (e) => {
    e.currentTarget.classList.toggle("is-open");
    Gnav.classList.toggle("is-open");
  });

  // メニューのどこかが押されたら閉じる
  Gnav.addEventListener("click", (e) => {
    Gnav_btn.classList.remove("is-open");
    Gnav.classList.remove("is-open");
  });
}

// ページトップへ移動するボタン(クリックでページトップへスクロール) ///////////////////////////
const Totop = document.getElementById("js-totop");
if (Totop) {
  Totop.addEventListener("click", () => {
    window.scrollTo({ top: 0, behavior: "smooth" });
  });
}

// ページ内リンクはブラウザ標準の移動とCSSのscroll-margin-topで調整する。
// PCのヘッダー高は、画像・フォントの読み込みや折り返し後も追従させる。
(() => {
  const header = document.querySelector(".header");
  if (!header) return;

  const updateHeaderHeight = () => {
    document.documentElement.style.setProperty(
      "--lp-header-height",
      `${header.getBoundingClientRect().height}px`
    );
  };

  updateHeaderHeight();
  const observer = new ResizeObserver(updateHeaderHeight);
  observer.observe(header);
})();
