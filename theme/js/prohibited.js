
// ==UserScript==
// @name         DevTools系ショートカットの強力ブロック（F12 / Ctrl+Shift+I等）
// @namespace    https://tonahazana.com/
// @version      1.0.0
// @description  F12, Ctrl+Shift+I/J/C/K/E, Ctrl+U（macは⌘+⌥+I/J/C/K/E/U）を極力ブロック。右クリックも任意で無効化（※完全防止は不可）。
// @author       どんぱっぱ＠となはざな
// @match        *://*/*
// @run-at       document-start
// @all-frames   true
// @grant        none
// ==/UserScript==

(function () {
  'use strict';

  // === 設定（必要に応じて変更） ===
  const BLOCK_CONTEXT_MENU = true; // 右クリック全体を無効化する（=「検証」を出させない）
  // 入力欄だけ右クリックを許可したい場合は、上を false にして、
  // 下の addEventListener のコメントを外して用途に合わせて調整してください。

  const block = (e) => {
    // 既定動作と伝播を確実に止める
    e.preventDefault();
    e.stopImmediatePropagation?.();
    e.stopPropagation();
    return false;
  };

  const shouldBlock = (e) => {
    const key = (e.key || '').toLowerCase();
    const code = e.code || '';

    // F12
    if (key === 'f12' || code === 'F12' || e.keyCode === 123) return true;

    // Windows/Linux: Ctrl+Shift+I/J/C/K/E, Ctrl+U（view-source）
    if (e.ctrlKey) {
      if (e.shiftKey && ['i', 'j', 'c', 'k', 'e'].includes(key)) return true;
      if (!e.shiftKey && key === 'u') return true;
    }

    // macOS: ⌘+⌥+I/J/C/K/E/U
    if (e.metaKey && e.altKey && ['i', 'j', 'c', 'k', 'e', 'u'].includes(key)) return true;

    return false;
  };

  const onKeyDown = (e) => {
    if (shouldBlock(e)) block(e);
  };

  // 可能な限り早いフェーズでフック（キャプチャリング）
  window.addEventListener('keydown', onKeyDown, { capture: true });
  document.addEventListener('keydown', onKeyDown, { capture: true });
  // 後段で上書きされても効くようにフォールバックも設定
  document.onkeydown = (e) => (shouldBlock(e) ? block(e) : void 0);

  // 右クリック無効化（任意）
  if (BLOCK_CONTEXT_MENU) {
    window.addEventListener('contextmenu', (e) => block(e), { capture: true });
    document.addEventListener('contextmenu', (e) => block(e), { capture: true });
    // 入力欄では許可したい場合の例（必要なら有効化）
    // document.addEventListener('contextmenu', (e) => {
    //   const t = e.target;
    //   if (t && (t.isContentEditable || ['INPUT','TEXTAREA'].includes(t.tagName))) return;
    //   block(e);
    // }, { capture: true });
  }
})();
