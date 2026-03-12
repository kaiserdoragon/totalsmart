<div class="footer_btn_fixed" id="js_fixed-btn">
  <p class="footer_btn_fixed--tel"><a href="tel:0529325450">電話で<br>予約する</a></p>
  <p class="footer_btn_fixed--mail"><a href="<?php echo esc_url(home_url('/contact_corporate/')); ?>#contact">メールで<br>無料見積り</a></p>
  <!-- <p class="footer_btn_fixed--line"><a href="https://lin.ee/fXrKQyq">LINEで<br>問い合わせ</a></p> -->
</div>

<footer class="footer">
  <div class="container">
    <p class="footer--lead">
      名古屋市を中心に東海エリアで設備工事を依頼するなら、トータルスマート株式会社へ。<br>
      愛知・岐阜・三重・静岡で、エアコン修理・クリーニング、防犯カメラ、LED照明、光回線、OA機器など、オフィス・店舗に必要な設備工事をワンストップで提供しています。<br>
      販売・施工・保守まで一貫対応し、通信環境の整備、防犯強化、省エネ対策を通じて、コスト削減と業務効率化を実現します。
    </p>

    <div class="footer--inner">
      <div class="footer--txt">
        <img
          src="<?php echo esc_url(get_template_directory_uri() . '/img/common/footer_logo.png'); ?>"
          alt="トータルスマート株式会社"
          width="461"
          height="96"
          loading="lazy"
          decoding="async">
        <address>
          〒461-0002<br>愛知県名古屋市東区代官町16-17 アーク代官町ビルディング2F
        </address>
        <p>TEL：052-932-5450 FAX：052-932-5451</p>
      </div>

      <ul role="navigation" aria-label="フッターナビゲーション">
        <li><a href="<?php echo esc_url(home_url('/business/')); ?>">事業内容</a></li>
        <li><a href="<?php echo esc_url(home_url('/service/')); ?>">サービス</a></li>
        <li><a href="<?php echo esc_url(home_url('/introduction/')); ?>">導入実績</a></li>
        <li><a href="<?php echo esc_url(home_url('/company/')); ?>">会社概要</a></li>
        <li><a href="<?php echo esc_url(home_url('/recruit/')); ?>">採用情報</a></li>
        <li><a href="<?php echo esc_url(home_url('/information/')); ?>">お役立ち情報</a></li>
        <li><a href="<?php echo esc_url(home_url('/contact_corporate/')); ?>">お問い合わせ</a></li>
        <li><a href="<?php echo esc_url(home_url('/security/')); ?>">情報セキュリティ方針</a></li>
        <li><a href="<?php echo esc_url(home_url('/privacy/')); ?>">プライバシーポリシー</a></li>
      </ul>
    </div>

    <small>Copyright &copy; Total Smart株式会社 All Rights Reserved.</small>
  </div>
</footer>
</div>

<?php wp_footer(); ?>
</body>

</html>