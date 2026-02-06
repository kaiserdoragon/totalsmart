<?php get_header(); ?>
<div class="eyecatch">
  <?php if (has_post_thumbnail()): ?>
    <?php the_post_thumbnail(); ?>
  <?php else: ?>
  <?php endif; ?>
  <h1>お問い合わせありがとうございました</h1>
</div>

<?php $slug_name = $post->post_name; ?>

<main class="<?php echo $slug_name; ?>_page bg_gray">
  <div class="container">
    <div class="breadcrumbs--wrap">
      <?php get_template_part('include/common', 'breadcrumb'); ?>
    </div>

    <section class="contact_corporate sec -sm contact_page" id="thanks">
      <div class="container -md">
        <h2 class="ttl">
          お問い合わせありがとうございます。
          <span>THANKS</span>
        </h2>
        <p>
          お問い合わせありがとうございます。<br>
          <br>
          このたびは、トータルスマート株式会社へお問い合わせ頂き誠にありがとうございます。<br>
          お送り頂きました内容を確認の上、2～3営業日以内に折り返しご連絡させて頂きます。<br>
          また、ご記入頂いたメールアドレスへ、自動返信の確認メールをお送りしております。<br>
          しばらく経ってもメールが届かない場合は、入力頂いたメールアドレスが間違っているか、<br class="is-hidden_sp">
          迷惑メールフォルダに振り分けられている可能性がございます。<br>
          <br>
          なお、お急ぎの場合は電話でもご相談を受け付けております。<br>
          052-932-5450までご遠慮なくご相談ください。
        </p>
        <div class="header--btn">
          <a href="tel:052-932-5450" class="header--tel"> 052-932-5450
            <span>営業時間 9:00～18:00</span>
          </a>
        </div>
        <a class="contact_corporate--totop" href="<?php echo esc_url(home_url('/')); ?>">TOPページにもどる</a>
      </div>
    </section>
  </div>
</main>

<?php get_footer(); ?>