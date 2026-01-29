// ローディングアニメーション
window.addEventListener('load', function () {
  const loader = document.getElementById('js_loadinganimation');
  const content = document.getElementById('main-content');

  // 1秒後にローディング終了
  setTimeout(function () {
    loader.classList.add('is_load-delete');
    content.classList.add('is_show');

    setTimeout(function () {
      loader.remove();
    }, 870);
  }, 870);
});


