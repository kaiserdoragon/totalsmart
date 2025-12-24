// code from https://github.com/yend724/sample-auto-set-img-size/blob/main/script.js
// 出てきたファイルは多少崩れているので整形する

import { readFileSync, existsSync, writeFile } from "fs";
import path from "path";
import { fileURLToPath } from "url";
import { JSDOM } from "jsdom";
import sizeOf from "image-size";
const __dirname = path.dirname(fileURLToPath(import.meta.url));

// targetのファイル名
const target_name = "index.html";

// 画像の書き出し倍率
const magnification = 2;

// プロジェクトのパス
// const root = path.join(__dirname, "/");
const root = path.join(__dirname, "/wp-content/themes/theme/");
const srcRoot = path.join(root, "/");

// fsでtarget_fileを取得
const html = existsSync(path.join(srcRoot, target_name))
  ? readFileSync(`${path.join(srcRoot, target_name)}`, "utf-8")
  : console.log("ファイルが存在しません。");

// // jsdomでDOM操作できるように
// const { JSDOM } = jsdom;
const dom = new JSDOM(html);
const doc = dom.window.document;

// picture > source と img を取得
const sources = doc.querySelectorAll("picture > source");
const imgs = doc.querySelectorAll("img");

function addSize(src, dimensions, target) {
  if (src.match(/\S+\.(svg)/g)) {
    // svgの場合は等倍で付与
    target.setAttribute("width", Math.floor(dimensions.width));
    target.setAttribute("height", Math.floor(dimensions.height));
  } else {
    target.setAttribute("width", Math.floor(dimensions.width / magnification));
    target.setAttribute("height", Math.floor(dimensions.height / magnification));
  }
}

// 画像のパスを取得する正規表現
const regexp = /\S+\.(jpg|png|gif|webp)/g;
sources.forEach((source) => {
  // srcsetから画像のパスだけ取得する
  // 例えば
  // srcset="./assets/img/960-540.png, ./assets/img/1920-1080.png 2x"
  // から
  // "./assets/img/960-540.png"と"./assets/img/1920-1080.png"
  // を抽出する
  const srcset = source.getAttribute("srcset");
  if (!srcset) {
    return;
  }
  const matches = [...srcset.matchAll(regexp)];

  if (matches.length > 0) {
    // srcsetの1つ目の画像のパスが対象
    // 例えば
    // srcset="./assets/img/960-540.png, ./assets/img/1920-1080.png 2x"
    // なら
    // "./assets/img/960-540.png"
    // が対象となる
    const src = matches[0][0];
    // image-sizeを使用して画像のサイズを取得
    const dimensions = sizeOf(path.join(srcRoot, src));
    addSize(src, dimensions, source);
  }
});

imgs.forEach((img) => {
  const src = img.getAttribute("src");
  if (!src || src.startsWith("http")) {
    return;
  }
  // image-sizeを使用して画像のサイズを取得
  const dimensions = sizeOf(path.join(srcRoot, src));
  addSize(src, dimensions, img);
});

// 同じファイル名でwidth/heightを付与したファイルを吐き出す
writeFile(`${root}${target_name}`, dom.serialize(), (error) => {
  if (error) throw error;
});
