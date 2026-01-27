<?php get_header(); ?>
<div class="eyecatch">
  <?php if (has_post_thumbnail()): // サムネイルを持っているとき 
  ?><?php the_post_thumbnail(); ?><?php else: // サムネイルを持っていない 
                                  ?><?php endif; ?>
  <h1><?php the_title(); ?></h1>
</div>

<?php get_template_part('include/common', 'breadcrumb'); //　Breadcrumb NavXTを使わないときは削除
?>

<?php $slug_name = $post->post_name; ?>
<main class="<?php echo $slug_name; ?>_page">
  <section class="about_lead sec">
    <div class="container">
      <h2 class="ttl">
        事業内容
        <span>ABOUT</span>
      </h2>
      <p>
        賢く、安く、簡単に。コストを最適化し、強い経営へ。<br>
        経費の見直しと業務効率化をワンストップで支援し、日々のムダを可視化して削減します。<br>
        時間も支出もスマートに抑え、組織全体の生産性とパフォーマンスを着実に引き上げます。
      </p>
    </div>
  </section>
</main>

<?php get_footer(); ?>