// ローディングアニメーション
// 超派手なローディングアニメーション
window.addEventListener('load', function () {
  // const loader = document.getElementById('js_loadinganimation');
  const content = document.getElementById('main-content');
  const status = document.getElementById('status');

  // ランダムなバイナリコードを生成
  function generateBinaryCode() {
    let binary = '';
    for (let i = 0; i < 8; i++) {
      binary += Math.random() > 0.5 ? '1' : '0';
    }
    return binary;
  }

  // データストリームを更新
  const streams = document.querySelectorAll('.loadinganimation--stream');
  const streamInterval = setInterval(function () {
    streams.forEach(function (stream) {
      stream.innerText = generateBinaryCode();
    });
  }, 150);


  // 段階的なステータス更新（より詳細に）
  setTimeout(function () {
    status.innerText = "INITIALIZING QUANTUM CORE...";
  }, 600);

  setTimeout(function () {
    status.innerText = "LOADING NEURAL NETWORK...";
  }, 1200);

  setTimeout(function () {
    status.innerText = "SYNCHRONIZING DATA STREAMS...";
  }, 1800);

  setTimeout(function () {
    status.innerText = "ACTIVATING HOLOGRAPHIC INTERFACE...";
  }, 2400);

  setTimeout(function () {
    status.innerText = "ACCESS GRANTED";
    clearInterval(hexInterval);
    clearInterval(streamInterval);

    // 最後のデータストリームを停止
    streams.forEach(function (stream) {
      stream.innerText = "11111111";
    });
  }, 3000);

  // 3.8秒後にローディング終了
  setTimeout(function () {
    loader.classList.add('is_load-delete');
    content.classList.add('is_show');

    setTimeout(function () {
      loader.remove();
    }, 1000);
  }, 3800);
});
