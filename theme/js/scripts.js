function add_script(url) {
  let script = document.createElement("script");
  script.src = url;
  document.body.appendChild(script);
}
// 追加でjsファイルを読み込む場合は、ファイルパスを記述
// add_script("./js/animation.min.js");　// アニメーション用js

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

// アンカーリンクのスムーススクロール //////////////////////////////////////////////
// iOSでスムーススクロールをするためには「<script src=" https://polyfill.io/v3/polyfill.min.js?features=smoothscroll"></script>」を読み込む必要がある。
const headerHeight = ((load) => {
  return load ? document.getElementsByClassName("header")[0].offsetHeight : 0;
})(true); // ※ヘッダー高さをロード時にはかりたいときは、ここをtrueにする

const anchor = document.querySelectorAll("a[href*='#']:not(.is-noscroll)"); // 発火しない場合は「.is-noscroll」
[...anchor].forEach((element) => {
  const target = ((hash) => {
    return hash
      ? document.querySelector(element.hash)
      : console.error(`リンクが空です。 ${element.outerHTML}`);
  })(element.hash);

  if (target) {
    element.addEventListener("click", (e) => {
      e.preventDefault();
      window.scrollTo({
        top: target.offsetTop - headerHeight,
        behavior: "smooth",
      });
    });
  }
});

//別URLからやってきたときに発火
window.addEventListener("load", () => {
  const url = window.location.href;
  if (url.indexOf("#") !== -1) {
    const id = url.split("#");
    const target = document.getElementById(id[id.length - 1]);
    if (target) {
      window.scroll({ top: 0 });
      window.scroll({ top: target.offsetTop - headerHeight, behavior: "smooth" });
    }
  }
});

//SPの時にテーブルを横スクロール
new ScrollHint(".js-scrollable", {
  suggestiveShadow: true, //スクロール可能な要素右端に影を付ける
  i18n: {
    scrollable: "横スクロール可能です", //表示するテキスト
  },
});

// SP(<=767px)のときだけフッター追従ボタンを有効化
(() => {
  const btn = document.getElementById("js_fixed-btn");
  if (!btn) return;

  const THRESHOLD = 500;
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

// (function ($, root, undefined) {
//   // ------------------------------
//   // jqueryはここに記載
//   // ------------------------------
// })(jQuery, this);
