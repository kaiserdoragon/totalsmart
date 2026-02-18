  <div class="footer_btn_fixed" id="js_fixed-btn">
    <p class="footer_btn_fixed--tel"><a href="tel:052-932-5450">電話で<br>予約する</a></p>
    <p class="footer_btn_fixed--mail"><a href="<?php echo esc_url(home_url('/contact_corporate')); ?>">メールで<br>無料見積り</a></p>
    <p class="footer_btn_fixed--line"><a href="https://lin.ee/fXrKQyq">LINEで<br>問い合わせ</a></p>
  </div>

  <footer class="footer">
    <div class="container">
      <p class="footer--lead">
        トータルスマート株式会社は、名古屋市を中心に愛知・岐阜・三重・静岡など東海エリアでエアコン修理・クリーニング、防犯カメラ、LED照明、光回線、OA機器などオフィス・店舗・住宅の設備工事を一括対応する総合設備会社です。<br>
        通信工事、防犯設備、省エネ機器の販売・施工・保守をワンストップで行い、経費削減と業務効率化を実現します。
      </p>
      <div class="footer--inner">
        <div class="footer--txt">
          <img src="<?php echo get_template_directory_uri(); ?>/img/common/footer_logo.png" alt="Total Smart" width="461" height="96" loading="lazy" decoding="async">
          <address>
            〒461-0002<br>愛知県名古屋市東区代官町16-17 アーク代官町ビルディング2F
          </address>
          <p>TEL：052-932-5450 FAX：052-932-5451</p>
        </div>
        <ul>
          <li><a href="<?php echo esc_url(home_url('/business')); ?>">事業内容</a></li>
          <li><a href="<?php echo esc_url(home_url('/service')); ?>">サービス</a></li>
          <li><a href="<?php echo esc_url(home_url('/introduction')); ?>">導入実績</a></li>
          <li><a href="<?php echo esc_url(home_url('/company')); ?>">会社概要</a></li>
          <li><a href="https://recruit.jobcan.jp/totalsmart">採用情報</a></li>
          <li><a href="<?php echo esc_url(home_url('/information')); ?>">お役立ち情報</a></li>
          <li><a href="<?php echo esc_url(home_url('/contact_corporate')); ?>">お問い合わせ</a></li>
          <li><a href="<?php echo esc_url(home_url('/security')); ?>">情報セキュリティ方針</a></li>
          <li><a href="<?php echo esc_url(home_url('/privacy')); ?>">プライバシーポリシー</a></li>
        </ul>
      </div>
      <small>Copyright © Total Smart株式会社 All Rights Reserved.</small>
    </div>
  </footer>
  </div>

  <?php if (!is_page('company')): ?>
    <script type="application/ld+json">
      {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "トータルスマート株式会社",
        "image": "<?php echo get_template_directory_uri(); ?>/img/common/logo.png",
        "telephone": "052-932-5450",
        "address": {
          "@type": "PostalAddress",
          "streetAddress": "代官町16-17 アーク代官町ビルディング2F",
          "addressLocality": "名古屋市東区",
          "addressRegion": "愛知県",
          "postalCode": "461-0002",
          "addressCountry": "JP"
        },
        "url": "<?php echo esc_url(home_url('/')); ?>"
      }
    </script>
  <?php endif; ?>

  <?php wp_footer(); ?>
  </body>

  </html>