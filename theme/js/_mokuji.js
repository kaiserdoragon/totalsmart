document.addEventListener("DOMContentLoaded", function () {
  const contentArea = document.querySelector(".detail_page--content");
  if (!contentArea) return;

  const headings = contentArea.querySelectorAll("h2, h3");
  // 見出しがない場合は終了（CSSで .toc-container は display:none なので表示されません）
  if (headings.length === 0) return;

  const tocContainer = document.getElementById("toc-container");
  const tocList = document.getElementById("toc-list");

  headings.forEach((heading, index) => {
    if (!heading.id) {
      heading.id = "section-" + index;
    }

    // リストアイテム作成（クラスを付与）
    const li = document.createElement("li");
    li.classList.add("toc-item");

    // タグ名に応じてクラスを使い分け
    if (heading.tagName.toLowerCase() === "h3") {
      li.classList.add("toc-h3");
    } else {
      li.classList.add("toc-h2");
    }

    // リンク作成
    const a = document.createElement("a");
    a.href = "#" + heading.id;
    a.textContent = heading.textContent;
    a.classList.add("toc-link");

    // ▼▼▼ クリック時のスクロール制御（固定ヘッダー対応） ▼▼▼
    a.addEventListener("click", function (e) {
      e.preventDefault();

      const targetId = this.getAttribute("href").substring(1);
      const targetElement = document.getElementById(targetId);

      if (targetElement) {
        const header = document.querySelector("header");
        const headerHeight = header ? header.offsetHeight : 0;
        const buffer = 20;

        const elementPosition = targetElement.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - headerHeight - buffer;

        window.scrollTo({
          top: offsetPosition,
          behavior: "smooth",
        });
      }
    });
    // ▲▲▲ スクロール制御ここまで ▲▲▲

    li.appendChild(a);
    tocList.appendChild(li);
  });

  // 目次を表示するクラスを追加
  tocContainer.classList.add("is-active");
});
