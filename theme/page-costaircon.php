<?php get_header(); ?>
<div class="eyecatch -cost">
  <?php if (has_post_thumbnail()): ?>
    <?php the_post_thumbnail(); ?>
  <?php endif; ?>
  <h1>業務用エアコン<br>経費削減</h1>
</div>

<?php $slug_name = $post->post_name; ?>
<main class="<?php echo $slug_name; ?>_page">
  <div class="breadcrumbs--wrap">
    <?php get_template_part('include/common', 'breadcrumb'); ?>
  </div>

  <section class="sec">
    <div class="container">
      <span>30秒で概算をチェック</span>
      <h2 class="ttl">
        業務用エアコンの電気代<br class="is-hidden_sp">
        交換・取り換えでどれくらい下がるか
      </h2>
      <p>
        現在お使いの業務用エアコンの馬力・年式・稼働時間を入力すると、<br class="is-hidden_sp">新しい業務用エアコンへ交換した場合の電気代削減目安を確認できます。
      </p>
      <ul>
        <li>無料・登録不要</li>
        <li>店舗・オフィス・工場対応</li>
        <li>複数台にも対応</li>
      </ul>
      <section class="card" aria-label="業務用エアコン電気代削減シミュレーター">
        <div class="card-head">
          <div>
            <h2>業務用エアコン電気代削減シミュレーション</h2>
            <p>馬力・年式・稼働時間をもとに、現在の推定電気代と更新後の推定電気代を比較します。</p>
          </div>
          <div class="card-badge">削減額をその場で表示</div>
        </div>

        <div class="card-body">
          <p class="section-title">わかる範囲で入力してください</p>
          <div class="unit-list" id="unitList"></div>

          <div class="actions">
            <button class="secondary-btn" type="button" id="addUnitBtn">＋ もう1台追加</button>
          </div>

          <div class="option-row">
            <div class="field">
              <label for="electricityUnit">電気代単価</label>
              <input id="electricityUnit" type="number" inputmode="decimal" min="1" step="0.1" value="30">
              <div class="help">分からない場合は初期値の30円/kWhのままで計算できます。</div>
              <button class="unit-calc-toggle" type="button" id="unitCalcToggle" aria-expanded="false" aria-controls="unitCalcPanel">＋ 電気料金明細から単価を計算する</button>
              <div class="unit-calc-panel" id="unitCalcPanel">
                <div class="help">電気料金明細がある方は、請求金額と使用量から目安単価を計算できます。</div>
                <div class="unit-calc-grid">
                  <div class="field">
                    <label for="billAmount">請求金額（税込）</label>
                    <input id="billAmount" type="number" inputmode="numeric" min="0" step="100" placeholder="例：40000">
                  </div>
                  <div class="field">
                    <label for="billKwh">使用量（kWh）</label>
                    <input id="billKwh" type="number" inputmode="decimal" min="0" step="1" placeholder="例：1200">
                  </div>
                </div>
                <div class="unit-calc-formula">目安単価 ＝ 請求金額 ÷ 使用量（kWh）</div>
                <div class="unit-calc-actions">
                  <button class="unit-calc-btn" type="button" id="applyUnitPriceBtn">この単価を使う</button>
                  <span class="unit-calc-result" id="unitCalcResult"></span>
                </div>
                <div class="unit-calc-note">請求金額から算出する単価は目安です。実際の削減額は契約内容により変動します。</div>
              </div>
            </div>
            <div class="field">
              <label for="makerName">メーカー名（任意）</label>
              <input id="makerName" type="text" placeholder="例：ダイキン、三菱、日立など">
              <div class="help">計算には使用しません。確認用の任意項目です。</div>
            </div>
            <div class="field">
              <label for="currentBill">現在の月額電気代（任意）</label>
              <input id="currentBill" type="number" inputmode="decimal" min="0" step="0.1" placeholder="例：40000">
              <div class="help">小数点を含む金額も入力できます。入力欄から離れた時に自動的に四捨五入します。</div>
            </div>
          </div>

          <div class="actions">
            <span class="help">入力内容を変更すると、下のシミュレーション結果が自動で更新されます。</span>
            <button class="secondary-btn" type="button" id="resetBtn">入力をリセット</button>
          </div>

          <div class="error" id="errorBox" role="alert" aria-live="assertive"></div>

          <div class="notice">
            馬力が分からない場合は、本体ラベルや型番をご確認ください。初期版では型番の自動判定は行わず、選択された馬力をもとに計算します。
          </div>

          <section class="results" id="results" aria-live="polite">
            <span class="result-kicker">SIMULATION RESULT</span>
            <p class="section-title">シミュレーション結果</p>
            <p class="result-lead">入力内容をもとにした概算です。実際の削減額は、設置環境や電気料金プランにより変動します。</p>
            <div class="result-error-state" id="resultErrorState">入力内容にエラーがあります。上の赤い警告を確認し、エラーを修正してください。修正後に自動で再計算します。</div>

            <div class="savings-hero">
              <div class="savings-hero-content">
                <div>
                  <div class="savings-label">月あたりの削減目安</div>
                  <div class="savings-value" id="monthlySavings">¥0</div>
                  <div class="savings-caption">現在の推定電気代と、新型業務用エアコン相当へ更新した場合の推定電気代を比較しています。</div>
                </div>
                <div class="savings-side">
                  <div class="savings-mini">
                    <div class="savings-mini-label">年間削減の目安</div>
                    <div class="savings-mini-value" id="annualSavings">¥0</div>
                  </div>
                  <div class="savings-mini">
                    <div class="savings-mini-label">10年間の削減目安</div>
                    <div class="savings-mini-value" id="tenYearSavings">¥0</div>
                  </div>
                </div>
              </div>
            </div>

            <div class="result-grid">
              <div class="metric">
                <div class="metric-label">現在の推定電気代</div>
                <div class="metric-value" id="currentAnnual">¥0</div>
                <div class="metric-sub">現状推定kWから算出</div>
              </div>
              <div class="metric">
                <div class="metric-label">更新後の推定電気代</div>
                <div class="metric-value" id="newAnnual">¥0</div>
                <div class="metric-sub">新型相当kWから算出</div>
              </div>
              <div class="metric">
                <div class="metric-label">削減率の目安</div>
                <div class="metric-value" id="savingRate">0%</div>
                <div class="metric-sub">現在の推定年間電気代に対する比率</div>
              </div>
              <div class="metric">
                <div class="metric-label">年間稼働時間</div>
                <div class="metric-value" id="annualHoursTotal">0h</div>
                <div class="metric-sub">全台分の合計稼働時間</div>
              </div>
            </div>

            <div class="chart-card">
              <p class="chart-title">現在と更新後の電気代比較</p>
              <div class="bar-row">
                <div class="bar-label">現在</div>
                <div class="bar-track">
                  <div class="bar-fill-current" id="currentBar"></div>
                </div>
                <div class="bar-value" id="currentBarValue">¥0</div>
              </div>
              <div class="bar-row">
                <div class="bar-label">更新後</div>
                <div class="bar-track">
                  <div class="bar-fill-new" id="newBar"></div>
                </div>
                <div class="bar-value" id="newBarValue">¥0</div>
              </div>
            </div>

            <div class="result-grid">
              <div class="metric">
                <div class="metric-label">入力台数</div>
                <div class="metric-value" id="unitCount">1台</div>
                <div class="metric-sub">今回の計算対象</div>
              </div>
              <div class="metric is-reference is-hidden" id="currentBillMetric">
                <div class="metric-label">現在の月額電気代（参考）</div>
                <div class="metric-value" id="currentBillRounded">¥0</div>
                <div class="metric-sub" id="currentBillImpact">入力された金額は、入力欄から離れた時に自動的に四捨五入されます。</div>
              </div>
            </div>

            <details class="details">
              <summary>計算の内訳を見る</summary>
              <div class="details-body">
                <div>現状年間電気代 ＝ 現状推定消費電力 × 年間稼働時間 × 電気代単価</div>
                <div>更新後年間電気代 ＝ 新型相当消費電力 × 年間稼働時間 × 電気代単価</div>
                <table class="calc-table">
                  <thead>
                    <tr>
                      <th>対象</th>
                      <th>現状推定kW</th>
                      <th>更新後推定kW</th>
                      <th>年間稼働時間</th>
                      <th>年間削減目安</th>
                    </tr>
                  </thead>
                  <tbody id="detailRows"></tbody>
                </table>
              </div>
            </details>

            <div class="disclaimer">
              本シミュレーション結果は、入力内容および当社算定基準による概算です。実際の削減額は、設置環境・使用状況・電気料金プラン・機種仕様により変動します。表示金額は電気代削減の目安であり、機器代・工事費・リース料等は含みません。
            </div>
          </section>
          <div class="placeholder-cta" id="contactCta">
            <div>
              <strong>もう少し詳しく確認したい方へ</strong>
              <span>正式な診断では、型番・設置環境・電気料金プランなどを確認したうえで試算します。</span>
            </div>
            <div class="cta-buttons" aria-label="無料相談の方法">
              <a class="cta-button cta-button-mail" href="<?php echo esc_url(home_url('/contact_corporate/')); ?>">メールで無料相談する</a>
              <a class="cta-button cta-button-phone" href="tel:0529325450">電話で無料相談する</a>
            </div>
          </div>

        </div>
      </section>
    </div>
  </section>


</main>

<?php get_footer(); ?>