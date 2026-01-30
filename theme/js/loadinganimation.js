// ローディングアニメーション
window.addEventListener("load", function () {
  const loader = document.getElementById("js_loadinganimation");
  const content = document.getElementById("main-content");

  // 1. 読み込み完了後、すぐにクラスを付与してアニメーション開始
  loader.classList.add("is_load-delete");

  if (content) {
    content.classList.add("is_show");
  }

  setTimeout(function () {
    loader.remove();
  });
});
