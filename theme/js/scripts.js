
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

// アンカーリンクのスムーススクロール
const anchors = document.querySelectorAll('a[href*="#"]:not(.is-noscroll)');

anchors.forEach((element) => {
  element.addEventListener("click", (e) => {
    // 【修正】末尾のスラッシュを削除して厳密にパスを比較する
    const targetPath = element.pathname.replace(/\/$/, "");
    const currentPath = window.location.pathname.replace(/\/$/, "");

    if (element.origin !== window.location.origin || targetPath !== currentPath) {
      // 別ページへのリンクならJSを中断
      return;
    }

    const hash = element.hash;
    let target;
    if (hash === "" || hash === "#") {
      target = document.documentElement;
    } else {
      const id = hash.replace("#", "");
      target = document.getElementById(id);
    }

    if (!target) return;

    e.preventDefault();

    const header = document.querySelector(".header");
    const headerHeight = header ? header.offsetHeight : 0;
    const targetPosition = target.getBoundingClientRect().top + window.scrollY;

    window.scrollTo({
      top: targetPosition - headerHeight,
      behavior: "smooth",
    });
  });
});

// 別URLからやってきたときに発火
window.addEventListener("load", () => {
  const hash = window.location.hash;
  if (hash) {
    const id = hash.replace("#", "");
    const target = document.getElementById(id);
    if (target) {
      // 【修正】ここで再度ヘッダーの高さを取得する（未定義エラーの解消）
      const header = document.querySelector(".header");
      const headerHeight = header ? header.offsetHeight : 0;

      // offsetTopだと親要素の配置に依存するため、getBoundingClientRect()を使用
      const targetPosition = target.getBoundingClientRect().top + window.scrollY;

      // ブラウザのデフォルトのハッシュジャンプと競合しないよう、少しだけ遅延させてからスクロールさせる
      setTimeout(() => {
        window.scrollTo({ top: targetPosition - headerHeight, behavior: "smooth" });
      }, 10);
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


// タブ切り替え
document.addEventListener('DOMContentLoaded', () => {
  const tabContainers = document.querySelectorAll('.tab_change');

  // タブコンテナが存在する場合のみ処理を実行する
  if (tabContainers.length > 0) {

    // それぞれのコンテナごとに処理を独立させる
    tabContainers.forEach(container => {
      // コンテナ内のタブメニューとコンテンツを取得
      const tabMenuItems = container.querySelectorAll('ul li');
      const tabContents = container.querySelectorAll('.tab_change--content');

      tabMenuItems.forEach(tabMenuItem => {
        tabMenuItem.addEventListener('click', () => {

          // 1. 選択状態のリセットと付与（このコンテナ内のタブのみ）
          tabMenuItems.forEach(item => {
            item.classList.remove('-selected');
          });
          tabMenuItem.classList.add('-selected');

          // 2. コンテンツの非表示（このコンテナ内のコンテンツのみ）
          tabContents.forEach(tabContent => {
            tabContent.classList.remove('-show');
          });

          // 3. IDで紐付いた対象のコンテンツを表示
          if (tabMenuItem.dataset.id) {
            const targetContent = document.getElementById(tabMenuItem.dataset.id);
            // 対象のコンテンツが確実に存在する場合のみクラスを付与
            if (targetContent) {
              targetContent.classList.add('-show');
            }
          }
        });
      });
    });
  }
});



// (function ($, root, undefined) {
//   // ------------------------------
//   // jqueryはここに記載
//   // ------------------------------
// })(jQuery, this);
