<?php get_header(); ?>
<div class="eyecatch">
  <h1>お知らせカスタム投稿</h1>
</div>
<?php get_template_part('include/common', 'breadcrumb'); //　Breadcrumb NavXTを使わないときは削除
?>
<div class="has_sidebar news_page">
  <main>
    <div>
      <?php
      // 現在のページ番号を取得（デフォルトは1）
      $paged = max(1, get_query_var('paged', 1));

      // クエリの引数を設定
      $args = array(
        'post_type'      => 'sports', // カスタム投稿タイプを指定
        'tax_query'      => array(    // タクソノミークエリを設定
          array(
            'taxonomy'         => 'sportscat', // タクソノミーを指定
            'field'            => 'slug',      // 'slug'を基準に検索
            'terms'            => 'soccer',  // 対象タームを指定
            'include_children' => false,       // 子タームを含めない
            // 'operator'         => 'EXISTS',    // 'sportscat' に属する全ての記事を対象とする(「タクソノミー」のみの出力の時だけ使う。それ以外はコメントアウト)
          ),
        ),
        'posts_per_page' => 3,          // 1ページあたりの表示件数
        'paged'          => $paged,     // 現在のページ番号を渡す
        'post_status'    => 'publish',  // 公開済みの投稿のみを対象とする
      );

      // クエリを実行
      $the_query = new WP_Query($args);

      // ページネーションのために全ページ数を設定（ループによっては適宜コメントアウトする）
      $wp_query->max_num_pages = $the_query->max_num_pages;
      ?>


      <?php if ($the_query->have_posts()) : ?><?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
      <div class="archive_news--contents">
        <figure><a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail($post->ID, 'medium'); ?></a></figure>
        <div class="archive_news--txt">
          <ul class="archive_news--cat"><?php categories_label() ?></ul>
          <p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
          <p class="archive_news--date"><time class="post_meta--date" datetime="<?php the_time('Y-m-j'); ?>"><?php the_time('Y.m.j'); ?></time></p>
        </div>
      </div>
      <?php endwhile; ?><?php endif; ?>
      <?php wp_reset_postdata(); ?>
    </div>

    <?php wp_pagination(); //ページネーション
    ?>
  </main>
  <!-- <?php get_sidebar(); ?> -->
</div>
<!-- <?php get_footer(); ?> -->