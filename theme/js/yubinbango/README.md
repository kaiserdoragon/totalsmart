# YubinBango（郵便番号から住所を自動入力）

外部サイト（yubinbango.github.io）からのJS読み込みをやめるため、ライブラリと住所データをテーマ内に置いている。
読み込みは `functions.php` の `ts_enqueue_yubinbango()` で行う。

| ファイル | 取得元 | 取得時点 |
|---|---|---|
| `yubinbango.js` | https://github.com/yubinbango/yubinbango | コミット 4e3880c（MITライセンス、`LICENSE` 参照） |
| `data/*.js` | https://github.com/yubinbango/yubinbango-data | コミット 7f3060c（2026-10-08更新分） |

## 元のファイルからの変更点

`yubinbango.js` の住所データの読み込み先を、外部URLから `window.tsYubinbangoDataUrl` に変更している。
この値は `ts_enqueue_yubinbango()` がテーマ内の `data/` のURLを設定する。

```
変更前: this.URL="https://yubinbango.github.io/yubinbango-data/data"
変更後: this.URL=window.tsYubinbangoDataUrl
```

## 住所データの更新手順

郵便番号の新設・変更に追従するため、年に数回を目安に `data/` を入れ替える。

1. https://github.com/yubinbango/yubinbango-data の `data/` フォルダを取得する
2. このフォルダの `data/` を丸ごと置き換える
3. 上の表の「取得時点」を更新する
4. お問い合わせフォームで郵便番号を入力し、住所が自動入力されることを確認する
