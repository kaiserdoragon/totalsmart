

// ---------------------------------------------
//  汎用グローバルナビゲーション
// ---------------------------------------------

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



// ---------------------------------------------
//  サービス（service）詳細のハンバーガーメニュー
// ---------------------------------------------
function servicegnav() {
  const service_nav = document.getElementById("service_nav");
  const service_nav_btn = document.getElementById("service_nav_btn");

  //両方の要素が存在する場合のみ実行する（エラー防止）
  if (service_nav && service_nav_btn) {
    service_nav.classList.toggle("service_nav--active");
    service_nav_btn.classList.toggle("service_nav_btn--open");
  }
}

// HTMLの読み込みが完了してから実行する
document.addEventListener("DOMContentLoaded", function () {
  const service_nav_btn = document.getElementById("service_nav_btn");

  if (service_nav_btn) {
    service_nav_btn.addEventListener("click", function () {
      servicegnav();
    });

    document.addEventListener('click', (e) => {
      // クリックした場所から一番近い「aタグ」を探す
      const link = e.target.closest('a');

      // id="service_nav" の中にあるかをチェック
      if (link && link.closest('#service_nav')) {

        // リンクが「別ページへの移動」なら preventDefault は消す
        // e.preventDefault(); 

        servicegnav();
      }
    });
  }
});





// ---------------------------------------------
//  アンカーリンクのスムーススクロール
// ---------------------------------------------

const anchors = document.querySelectorAll('a[href*="#"]:not(.is-noscroll)');

anchors.forEach((element) => {
  element.addEventListener("click", function (e) {
    // リンク先のURLと現在のURLを取得（ハッシュ部分を除外して比較）
    const currentUrl = window.location.origin + window.location.pathname;
    const linkUrl = this.origin + this.pathname;

    // 別ページへのリンクならJSの処理を中断し、通常のページ遷移に任せる
    if (currentUrl !== linkUrl) {
      return;
    }

    // ページ内リンク（同じURL）と判断された場合、ここから下の処理を実行
    const hash = this.hash; // 例: "#about"

    // ハッシュが空、もしくは "#" のみならページトップをターゲットに
    let target = null;
    if (hash === "" || hash === "#") {
      target = document.documentElement;
    } else {
      target = document.querySelector(hash);
    }

    // ターゲットが存在しなければ終了
    if (!target) return;

    // 【重要】ブラウザのデフォルト動作（一瞬でジャンプする挙動）を確実に防ぐ
    e.preventDefault();

    // ヘッダーの高さを取得（固定ヘッダーの場合は必須）
    const header = document.querySelector(".header");
    const headerHeight = header ? header.offsetHeight : 0;

    // スクロール先の正確な位置を計算
    const targetPosition = target.getBoundingClientRect().top + window.scrollY;

    // スムーススクロールの実行
    window.scrollTo({
      top: targetPosition - headerHeight,
      behavior: "smooth",
    });

    // 必要であれば、URLの末尾にハッシュを追加（履歴に残す場合）
    // history.pushState(null, null, hash);
  });
});


// ---------------------------------------------
//  別URL（別ページ）からハッシュ付きで遷移してきた時の処理
// ---------------------------------------------

window.addEventListener("load", () => {
  const hash = window.location.hash;
  if (hash) {
    const target = document.querySelector(hash);
    if (target) {
      const header = document.querySelector(".header");
      const headerHeight = header ? header.offsetHeight : 0;

      // 最初から少しだけ遅延させることで、ブラウザの初期ジャンプを上書きする
      setTimeout(() => {
        const targetPosition = target.getBoundingClientRect().top + window.scrollY;
        window.scrollTo({ top: targetPosition - headerHeight, behavior: "smooth" });
      }, 50); // 10ms → 50msに変更し、より確実に発火させます
    }
  }
});


// ---------------------------------------------
//  SPの時にテーブルを横スクロール
// ---------------------------------------------

new ScrollHint(".js-scrollable", {
  suggestiveShadow: true, //スクロール可能な要素右端に影を付ける
  i18n: {
    scrollable: "横スクロール可能です", //表示するテキスト
  },
});


// ---------------------------------------------
//  SP(<=767px)のときだけフッター追従ボタンを有効化
// ---------------------------------------------

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



// ---------------------------------------------
//  タブ切り替え（採用情報）
// ---------------------------------------------

document.addEventListener("DOMContentLoaded", () => {
  const tabContainers = document.querySelectorAll(".tab_change");

  // タブコンテナが存在する場合のみ処理を実行する
  if (tabContainers.length > 0) {
    // それぞれのコンテナごとに処理を独立させる
    tabContainers.forEach((container) => {
      // コンテナ内のタブメニューとコンテンツを取得
      const tabMenuItems = container.querySelectorAll("ul li");
      const tabContents = container.querySelectorAll(".tab_change--content");

      tabMenuItems.forEach((tabMenuItem) => {
        tabMenuItem.addEventListener("click", () => {
          // 1. 選択状態のリセットと付与（このコンテナ内のタブのみ）
          tabMenuItems.forEach((item) => {
            item.classList.remove("-selected");
          });
          tabMenuItem.classList.add("-selected");

          // 2. コンテンツの非表示（このコンテナ内のコンテンツのみ）
          tabContents.forEach((tabContent) => {
            tabContent.classList.remove("-show");
          });

          // 3. IDで紐付いた対象のコンテンツを表示
          if (tabMenuItem.dataset.id) {
            const targetContent = document.getElementById(tabMenuItem.dataset.id);
            // 対象のコンテンツが確実に存在する場合のみクラスを付与
            if (targetContent) {
              targetContent.classList.add("-show");
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
