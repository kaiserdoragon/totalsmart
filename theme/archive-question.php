<?php
/*------------------------------------*\
よくある質問一覧ページ
\*------------------------------------*/
?>

<?php get_header(); ?>

<?php
// taxonomyページで get_post_type() が期待通り取れないケースがあるので補正
$post_type = is_tax('question_cat') ? 'question' : get_post_type();

// 設定を配列にまとめる
$type_settings = [
  'question' => ['title' => 'よくある質問', 'img' => 'eyecatch_question.jpg', 'slug' => 'question'],
];

$title    = $type_settings[$post_type]['title'] ?? 'お知らせ';
$img_file  = $type_settings[$post_type]['img'] ?? 'eyecatch_default.jpg';
$slug     = $type_settings[$post_type]['slug'] ?? 'news';

// カテゴリ一覧は「投稿が0件でも」出す
$taxonomy_slug = 'question_cat';
$categories = get_terms([
  'taxonomy' => $taxonomy_slug,
  'orderby'  => 'description',
  'order'    => 'ASC',
]);
$all_url    = home_url('/question/');
$is_all_act = (is_post_type_archive('question') && !is_tax($taxonomy_slug));
?>

<?php
if (have_posts()) {
  $faq_list = [];
  // メインクエリの投稿データをループ（表示用ループには影響しません）
  foreach ($wp_query->posts as $post_obj) {
    // 本文を回答として取得（タグを除去してプレーンテキスト化）
    $answer_text = wp_strip_all_tags($post_obj->post_content);
    // 本文が空でなければリストに追加
    if (!empty($answer_text)) {
      $faq_list[] = [
        "@type" => "Question",
        "name" => get_the_title($post_obj),
        "acceptedAnswer" => [
          "@type" => "Answer",
          "text" => $answer_text
        ]
      ];
    }
  }

  // FAQデータが存在する場合のみ出力
  if (!empty($faq_list)) {
    $faq_schema = [
      "@context" => "https://schema.org",
      "@type" => "FAQPage",
      "mainEntity" => $faq_list
    ];
    echo '<script type="application/ld+json">' . json_encode($faq_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
  }
}
?>

<div class="eyecatch -archive">
  <div><?php echo esc_html($title); ?></div>
  <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/page/<?php echo esc_attr($img_file); ?>" alt="<?php echo esc_attr($title); ?>" width="1920" height="600" loading="lazy" decoding="async">
</div>

<main class="<?php echo esc_attr($slug . '_page'); ?>">

  <div class="breadcrumbs--wrap">
    <?php get_template_part('include/common', 'breadcrumb'); ?>
  </div>

  <section class="archive_page">
    <div class="container">
      <h1 class="ttl">
        <?php echo esc_html($title); ?>
        <span><?php echo esc_html(strtoupper($slug)); ?></span>
      </h1>

      <ul class="category_list">
        <li<?php echo $is_all_act ? ' class="is-active"' : ''; ?>>
          <a href="<?php echo esc_url($all_url); ?>">すべて</a>
          </li>

          <?php if (!empty($categories) && !is_wp_error($categories)) : ?>
            <?php foreach ($categories as $cat) :
              $url       = get_term_link($cat);
              $is_active = is_tax($taxonomy_slug, $cat->term_id);
            ?>
              <li<?php echo $is_active ? ' class="is-active"' : ''; ?>>
                <a href="<?php echo esc_url($url); ?>"><?php echo esc_html($cat->name); ?></a>
                </li>
              <?php endforeach; ?>
            <?php endif; ?>
      </ul>

      <div class="question-search">
        <input type="search" id="js-question-search" placeholder="検索したいキーワードを入力してください" autocomplete="off">
      </div>

      <section class="archive--inner front-news">
        <ul id="js-question-results">
          <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
              <?php
              $terms = get_the_terms(get_the_ID(), $taxonomy_slug);
              ?>
              <li>
                <a href="<?php the_permalink(); ?>">
                  <div class="front-news--info">
                    <?php if (!empty($terms) && !is_wp_error($terms)) : ?>
                      <?php foreach ($terms as $term) : ?>
                        <span class="front-news--cat_label -<?php echo esc_attr($term->slug); ?>">
                          <?php echo esc_html($term->name); ?>
                        </span>
                      <?php endforeach; ?>
                    <?php else : ?>
                      <span class="front-news--cat_label -other">その他</span>
                    <?php endif; ?>
                  </div>
                  <p><?php echo esc_html(get_the_title()); ?></p>
                </a>
              </li>
            <?php endwhile; ?>
          <?php else : ?>
            <li class="no-result">記事が見つかりませんでした。</li>
          <?php endif; ?>
        </ul>
      </section>

      <div class="pagination">
        <?php wp_pagination(); ?>
      </div>
    </div>
    </div>
</main>

<?php get_footer(); ?>