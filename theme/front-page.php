<?php get_header(); ?>
<main>
  <section class="mv">
    <h1>
      <span>賢く安く簡単に最適なコスト削減</span>
      ワンストップで<br class="is-hidden_sp">全部解決！
    </h1>

    <div class="mv_scroll" aria-hidden="true">
      <div class="mv_scroll--inner">
        <div class="mv_scroll--left">
          <p>
            <?php echo str_repeat('Total Smartは経費削減を専門とする会社です。 ', 20); ?>
          </p>
        </div>
        <div class="mv_scroll--right">
          <p>
            <?php echo str_repeat('Total Smartは経費削減を専門とする会社です。 ', 20); ?>
          </p>
        </div>
      </div>
    </div>

    <div class="mv--scroll_down">
      <span>Scroll</span>
    </div>
    <div class="mv_parallax_bg">
      <video
        src="<?php echo get_theme_file_uri('/video/video2.mp4'); ?>"
        poster="<?php echo get_theme_file_uri('/img/top/mv_video.jpg'); ?>"
        playsinline autoplay muted loop
        preload="metadata"
        title="トータルスマート サービス紹介動画">
      </video>
    </div>
  </section>

  <section class="lead_worry bg_white sec">
    <div class="container -md">
      <h2>店舗・オフィス運営の<span class="lead_txt">お悩み</span>を解決します！</h2>
      <ul role="list">
        <li>業務が忙しすぎる…<br>もっと<span class="lead_txt">効率化</span>をしたい！！</li>
        <li>無駄な<br><span class="lead_txt">コスト・費用</span>を削りたい</li>
        <li>情報の<span class="lead_txt">セキュリティ管理</span>を<br>徹底したい！</li>
      </ul>
    </div>
  </section>

  <section class="lead_solution bg_gray">
    <div class="lead_solution--inner container sec">
      <div class="container -sm">
        <div class="lead_solution--ttl">
          <h2>
            <p>これらの<span>悩み</span>は</p>
            <img class="lead_solution--logo" src="<?php echo get_template_directory_uri(); ?>/img/top/solution_logo.png" alt="トータルスマート株式会社" width="353" height="42" loading="lazy" decoding="async">が<span>スマート</span>に解決します！
          </h2>
          <img src="<?php echo get_template_directory_uri(); ?>/img/top/solution_txt.png" alt="トータルスマート株式会社" width="1024" height="213" loading="lazy" decoding="async">
        </div>
        <div class="lead_solution--txt">
          <p class="underline">オフィス関連をトータルにお任せ！</p><br>
          <p class="underline">保守・メンテナンスをスマート解決！</p>
        </div>
        <p class="u-mb30">
          トータルスマート株式会社はオフィスに係ること全てトータルで依頼可能！<br>
          OA機器・インターネット回線・電気ガスはもちろん<br class="is-hidden_sp">
          全て一本化することができコスト削減につながります。
        </p>
        <div class="lead_solution--txt">
          <span>複数の業者に電話して、<br class="is-hidden_pc">たらい回しにあう…</span>
          <p class="underline">もうそんな必要はありません！</p>
        </div>
        <p>一本化により、沢山の業者に連絡する手間を省き</p>
        <strong>一本の電話で全て<span>解決！</span></strong>
        <p>となるトータルサポートを可能にしています。</p>
      </div>
      <img src="<?php echo get_template_directory_uri(); ?>/img/top/solution_catch.png" alt="" width="724" height="489" loading="lazy" decoding="async">
    </div>
  </section>

  <?php
  $page_data = get_page_by_path('attention');
  if ($page_data && !empty($page_data->post_content)) :
  ?>
    <section class="attention sec bg_orange">
      <div class="container">
        <h2 class="ttl">
          注目情報
          <span>PICKUP</span>
        </h2>
        <p class="ttl--lead">
          トータルスマートから最新情報・注目情報をお伝えします。<br>
          情報収集にご活用ください。
        </p>

        <div class="attention--inner">
          <?php
          echo apply_filters('the_content', $page_data->post_content);
          ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <section class="feature bg_white sec">
    <div class="container">
      <h2 class="ttl">
        トータルスマートの主なサービス
        <span>FEATURE</span>
      </h2>
      <p class="ttl--lead">コストを抑えて成果を伸ばす、最適な業務改善をご提案します！！</p>
      <ul>
        <li>
          <img src="<?php echo get_template_directory_uri(); ?>/img/top/feature_catch_01.png" alt="" width="400" height="210" loading="lazy" decoding="async">
          <h3>コスト削減</h3>
          <p>
            オフィスで必須なOA機器やインターネット回線
            ビジネスフォンをトータルスマートに変えて
            お得に経費削減。<br>
            面倒な初期の手続き工事もお任せで安心。
          </p>
          <img src="<?php echo get_template_directory_uri(); ?>/img/top/feature_icon_01.png" alt="" width="246" height="87" loading="lazy" decoding="async">
        </li>
        <li>
          <img src="<?php echo get_template_directory_uri(); ?>/img/top/feature_catch_02.png" alt="" width="400" height="210" loading="lazy" decoding="async">
          <h3>業務効率化</h3>
          <p>
            リモートサポートはブロードバンド回線を
            通じてお客様のパソコン画面を
            技術スタッフのパソコンに表示し、
            画面を確認しながらご対応します。
          </p>
          <img src="<?php echo get_template_directory_uri(); ?>/img/top/feature_icon_02.png" alt="" width="245" height="105" loading="lazy" decoding="async">
        </li>
        <li>
          <img src="<?php echo get_template_directory_uri(); ?>/img/top/feature_catch_03.png" alt="" width="400" height="210" loading="lazy" decoding="async">
          <h3>売上・収益向上</h3>
          <p>
            ITを駆使して、企業の可能性を見極め、
            最適な成長の道筋を設計します。<br>
            データに基づいた継続的な進化を通じて、
            企業の成長や売上増加を支援します。
          </p>
          <img src="<?php echo get_template_directory_uri(); ?>/img/top/feature_icon_03.png" alt="" width="164" height="117" loading="lazy" decoding="async">
        </li>
      </ul>
      <div class="feature--inner">
        <p>OA機器や配線など、オフィスに関わること全て</p>
        <strong class="underline">トータルで依頼可能！</strong><br>
        <strong class="underline">一本の電話ですべて解決する</strong>
        <p>お客様にとってストレスのない業務形態です。</p>
      </div>
      <img src="<?php echo get_template_directory_uri(); ?>/img/top/feature_anima.jpg" alt="" width="800" height="1200" loading="lazy" decoding="async">
      <a class="btn_link" href="<?php echo esc_url(home_url('/company')); ?>" rel="noopener">トータルスマートについて詳しく知る</a>
    </div>
  </section>

  <section class="reason bg_orange">
    <div class="container">
      <h2 class="ttl">
        トータルスマートが選ばれる理由
        <span>REASON</span>
      </h2>
      <p class="reason--lead">
        最新のテクノロジーと革新的なソリューションを融合し、<br class="is-hidden_sp">
        企業の成長を力強く支援するパートナーです。<br>
        市場の変化に柔軟に対応し、企業に最適なシステムとカスタマイズ可能なサービスを提供することで、<br class="is-hidden_sp">
        業務の効率化と持続的な発展を実現します。<br>
        豊富な導入実績と継続的な技術革新に裏打ちされた信頼性が私たちの大きな魅力です。<br>
        未来を切り拓く確かな基盤として、あらゆる企業の成功をサポートします。<br>
      </p>
      <ul>
        <li>
          <img src="<?php echo get_template_directory_uri(); ?>/img/top/reason_02.png" alt="" width="136" height="117" loading="lazy" decoding="async">
          <h3>一括契約の提供</h3>
          <p>
            工事を行った後に発生する保守やメンテナ
            ンスなどのサービスも含めて、<span>一つの契約で
              提供しています。</span><br>
            工事の費用と保守の費用を別々に考える必要
            はありません。
          </p>
        </li>
        <li>
          <img src="<?php echo get_template_directory_uri(); ?>/img/top/reason_03.png" alt="" width="171" height="103" loading="lazy" decoding="async">
          <h3>総合的なサポート</h3>
          <p>
            工事だけでなく、その後の保守や修理、サポー
            トも含めて一括で対応することで、<span>便利で経済
              的な提案をいたします。</span><br>
            別々の業者との契約や交渉をする手間を省くこ
            とができます。
          </p>

        </li>
        <li>
          <img src="<?php echo get_template_directory_uri(); ?>/img/top/reason_01.png" alt="" width="129" height="129" loading="lazy" decoding="async">
          <h3>透明性と予測可能性</h3>
          <p>
            一括契約の場合、費用が明確に提示されるた
            め、将来の費用や予算をより<span>正確に見積もる
              ことができます。</span><br>
            リースと保守金額が一緒になることで、予測
            可能性が高まります。
          </p>
        </li>
      </ul>
    </div>
    <section class="cv_area">
      <div class="cv_area--inner">
        <h2>小さな見直しが<b>大きな成果</b>につながる</h2>
        <p class="cv_area--lead">
          成果を伸ばす最適な業務改善を！<br>
          今の業務に潜む可能性を一緒に探しましょう！
        </p>
        <span>受付時間　平日9：00～18：00</span>
        <div class="cv_area--btns">
          <a class="cv_area--mail" href="" target="_blank">メールで問い合わせ</a>
          <a class="cv_area--tel" href="tel:052-932-5450">お電話で問い合わせ</a>
        </div>
      </div>
    </section>
  </section>


  <?php
  /**
   * サービス一覧
   */
  ?>
  <section class="service bg_white">
    <div class="container">
      <h2 class="ttl">
        サービス一覧
        <span>SERVICE</span>
      </h2>

      <?php
      // 1. タクソノミーの取得
      $terms = get_terms([
        'taxonomy'   => 'service_cat',
        'orderby'    => 'description',
        'order'      => 'ASC',
        'hide_empty' => true,
      ]);

      if (!empty($terms) && !is_wp_error($terms)) :
        $json_ld_services = [];

        // ★ここを -1 にすれば無制限、20 にすれば最大20個まで出ます
        $display_limit = -1;
        $current_count = 0;
      ?>
        <ul class="service--list">
          <?php
          foreach ($terms as $term) :
            // 合計表示数が上限に達したら終了
            if ($display_limit !== -1 && $current_count >= $display_limit) break;

            $args = [
              'post_type'      => 'service',
              'posts_per_page' => ($display_limit === -1) ? -1 : ($display_limit - $current_count),
              'no_found_rows'  => true,
              'tax_query'      => [
                [
                  'taxonomy' => 'service_cat',
                  'field'    => 'term_id',
                  'terms'    => $term->term_id,
                ],
              ],
            ];

            $service_query = new WP_Query($args);

            if ($service_query->have_posts()) :
              while ($service_query->have_posts()) : $service_query->the_post();
                $current_count++;

                $json_ld_services[] = [
                  '@type' => 'ListItem',
                  'position' => $current_count,
                  'name' => get_the_title(),
                  'url' => get_permalink(),
                ];
          ?>
                <li>
                  <article>
                    <a href="<?php the_permalink(); ?>">
                      <figure>
                        <?php if (has_post_thumbnail()) : ?>
                          <?php the_post_thumbnail('service-thumb', [
                            'alt'      => the_title_attribute(['echo' => false]),
                            'loading'  => 'lazy',
                            'decoding' => 'async',
                            'width'    => '212',
                            'height'   => '212',
                          ]); ?>
                        <?php else : ?>
                          <img src="<?php echo esc_url(get_theme_file_uri('/img/top/service.jpg')); ?>" alt="" width="212" height="212" loading="lazy">
                        <?php endif; ?>
                        <figcaption>
                          <h3><?php echo wp_kses_post(get_the_title()); ?></h3>
                        </figcaption>
                      </figure>
                    </a>
                  </article>
                </li>
          <?php
              endwhile;
              wp_reset_postdata();
            endif;
          endforeach;
          ?>
        </ul>
      <?php endif; ?>
      <a class="btn_link" href="<?php echo esc_url(home_url('/service')); ?>" rel="noopener">サービス一覧を見る</a>
    </div>
  </section>



  <?php
  /**
   * 導入実績スライダー
   */
  ?>
  <section class="works bg_white sec">
    <div class="container">
      <h2 class="ttl">
        導入実績
        <span>WORKS</span>
      </h2>
      <p class="works--lead">
        私たちの最新店舗設備を導入いただいた様々なお店の体験談が掲載されています。<br>
        実際にご利用いただいた企業の成功事例や具体的な活用方法、<br class="is-hidden_sp">
        改善された業務効率やお客様満足度の向上など、リアルな声をぜひご覧ください。<br>
        あなたの会社の未来を変えるヒントがここにあります！<br>
      </p>
    </div>

    <div class="works--inner">
      <?php
      $args = array(
        'post_type'              => 'introduction',
        'posts_per_page'         => 13,
        'orderby'                => 'date',
        'order'                  => 'DESC',
        'no_found_rows'          => true,  // ページネーション不要なため計算をスキップ（高速化）
        'update_post_meta_cache' => false, // カスタムフィールドを使わない場合は false
        'update_post_term_cache' => true,  // タクソノミーを使用するため true
      );
      $custom_query = new WP_Query($args);

      if ($custom_query->have_posts()) :
        $post_count = 0; // ループカウンター
      ?>
        <div class="swiper">
          <div class="swiper-wrapper">
            <?php while ($custom_query->have_posts()) : $custom_query->the_post();
              $post_count++;
              $thumb_attr = [
                'alt'      => the_title_attribute(['echo' => false]),
                'loading'  => 'lazy',
                'decoding' => 'async',
                // 表示幅がほぼ決まっているなら付ける（後述）
                'sizes'    => '(max-width: 768px) 90vw, 352px',
              ];
            ?>
              <article class="swiper-slide">
                <a href="<?php echo esc_url(get_permalink()); ?>" target="_blank" rel="noopener">
                  <div class="works--thumbnail">
                    <?php if (has_post_thumbnail()) : ?>
                      <?php
                      the_post_thumbnail('works-thumb', $thumb_attr);
                      ?>
                    <?php else : ?>
                      <img
                        src="<?php echo esc_url(get_template_directory_uri()); ?>/img/top/works.jpg"
                        alt="<?php the_title_attribute(); ?>"
                        width="352"
                        height="308"
                        <?php echo ($post_count <= 3) ? 'loading="eager"' : 'loading="lazy"'; ?>>
                    <?php endif; ?>
                  </div>

                  <div class="works--contents">
                    <div>
                      <time datetime="<?php echo get_the_date('c'); ?>"><?php echo esc_html(get_the_date('Y.m.d')); ?></time>

                      <?php
                      $terms = get_the_terms(get_the_ID(), 'introduction_cat');
                      if ($terms && !is_wp_error($terms)) :
                        // 親カテゴリー取得の最適化
                        $root_term = $terms[0];
                        while ($root_term->parent != 0) {
                          $root_term = get_term($root_term->parent, 'introduction_cat');
                        }
                      ?>
                        <span class="works--cat">
                          <?php echo esc_html($root_term->name); ?>
                        </span>
                      <?php endif; ?>
                    </div>
                    <p><?php the_title(); ?></p>

                    <?php
                    // 子カテゴリー抽出
                    $child_terms = ($terms && !is_wp_error($terms)) ? wp_list_filter($terms, array('parent' => 0), 'NOT') : array();
                    if (!empty($child_terms)) : ?>
                      <div>
                        <?php foreach ($child_terms as $term) : ?>
                          <span class="works--cat_child"><?php echo esc_html($term->name); ?></span>
                        <?php endforeach; ?>
                      </div>
                    <?php endif; ?>
                  </div>
                </a>
              </article>
            <?php endwhile; ?>
          </div>
        </div>
        <?php wp_reset_postdata(); ?>
      <?php else : ?>
        <p>表示する投稿がありません。</p>
      <?php endif; ?>
    </div>
    <a class="btn_link" href="<?php echo esc_url(home_url('/introduction')); ?>" rel="noopener">導入実績一覧を見る</a>
  </section>

  <section class="company bg_white sec">
    <div class="container">
      <h2 class="ttl">
        導入実績
        <span>COMPANY</span>
      </h2>
      <p>
        最新のテクノロジーと革新的なソリューションを駆使し、<br class="is-hidden_sp">
        企業の効率化と安全・快適な環境の実現を目指す企業です。<br>
        お客様の多様なニーズに応えるため、柔軟な導入プランと確かな技術力で、<br class="is-hidden_sp">
        未来を切り拓くパートナーとしての信頼と実績を築いております。
      </p>
      <div class="company--inner">
        <div>
          <ul>
            <li><a href="<?php echo esc_url(home_url('/company/#philosophy')); ?>">企業理念</a></li>
            <li><a href="<?php echo esc_url(home_url('/company/#history')); ?>">沿革</a></li>
            <li><a href="<?php echo esc_url(home_url('/company/#access')); ?>">アクセス</a></li>
          </ul>
          <a class="btn_link" href="<?php echo esc_url(home_url('/company')); ?>" rel="noopener">会社概要の詳細はこちらから</a>
        </div>
        <img src="<?php echo get_template_directory_uri(); ?>/img/top/company.png" alt="" width="415" height="407" loading="lazy" decoding="async">
      </div>
    </div>
  </section>

  <section class="recruit sec">
    <div class="container">
      <h2 class="ttl">
        採用情報
        <span>RECRUIT</span>
      </h2>
      <div class="recruit--inner">
        <div>
          <dl>
            <dt>自由な発想とチームワークを<br>最大限に高める企業風土の創出</dt>
            <dd>ベンチャー企業として日々新事業を展開する弊社では、<br class="is-hidden_sp">
              決められたマニュアルはなく自分なりのルールで行動し、提案ができる社風です。<br>
              その為人間性を重視し、「誰と働くか」ということを大切にしています。<br>
              また働き方や雇用形態には縛られず、リモートワークなどを積極的に取り入れ、<br class="is-hidden_sp">
              成果に対してしっかりと還元をする独自の評価システムを構築することによって<br class="is-hidden_sp">
              チームワークを強化し、お客様はもちろん従業員がよりよい環境で働けることを目指します。
            </dd>
          </dl>
          <a class="btn_link" href="https://recruit.jobcan.jp/totalsmart" target="_blank" rel="noopener">採用情報はこちらから</a>
        </div>
        <img src="<?php echo get_template_directory_uri(); ?>/img/top/recruit_catch.png" alt="" width="477" height="492" loading="lazy" decoding="async">
      </div>
    </div>
  </section>

  <?php
  /**
   * お知らせ一覧
   */
  $paged = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
  $args = array(
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'paged'          => $paged,
  );

  $the_query = new WP_Query($args);

  if ($the_query->have_posts()) : ?>
    <section class="front-news bg_white sec">
      <div class="container">
        <h2 class="ttl">
          <?php esc_html_e('お知らせ', 'text-domain'); ?>
          <span>NEWS</span>
        </h2>
        <ul>
          <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
            <li>
              <a href="<?php the_permalink(); ?>">
                <div class="front-news--info">
                  <time datetime="<?php echo get_the_date('c'); ?>">
                    <?php echo get_the_date('Y.m.d'); ?>
                  </time>
                  <?php
                  $categories = get_the_category();
                  if (!empty($categories)) : ?>
                    <?php foreach ($categories as $category) : ?>
                      <span href="<?php echo esc_url(get_category_link($category->term_id)); ?>"
                        class="front-news--cat_label -<?php echo esc_attr($category->slug); ?>">
                        <?php echo esc_html($category->name); ?>
                      </span>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </div>
                <p><?php the_title(); ?></p>
              </a>
            </li>
          <?php endwhile; ?>
        </ul>
      </div>
      <a class="btn_link" href="<?php echo esc_url(home_url('/news')); ?>" target="_blank">お知らせ一覧はこちらから</a>
    </section>
  <?php
  endif;
  wp_reset_postdata();
  ?>


  <?php
  /**
   * お役立ち情報
   */
  ?>
  <section class="information bg_white sec">
    <div class="container">
      <h2 class="ttl">
        お役立ち情報
        <span>INFORMATION</span>
      </h2>

      <?php
      $args = array(
        'post_type'      => 'information',
        'posts_per_page' => 6,
        'order'          => 'DESC',
        'no_found_rows'  => true, // ページネーション不要な場合はtrueに設定してDB負荷を軽減
      );
      $custom_query = new WP_Query($args);
      if ($custom_query->have_posts()) :
      ?>
        <div class="information--list">
          <?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
            <article> <a href="<?php the_permalink(); ?>" class="information--link">

                <div class="information--image">
                  <?php if (has_post_thumbnail()) : ?>
                    <?php
                    the_post_thumbnail('info-thumb', [
                      'alt'      => the_title_attribute(['echo' => false]),
                      'loading'  => 'lazy',
                      'decoding' => 'async',
                    ]);
                    ?>
                  <?php else : ?>
                    <img
                      src="<?php echo esc_url(get_theme_file_uri('/img/top/information.jpg')); ?>"
                      alt=""
                      width="345"
                      height="220"
                      loading="lazy"
                      decoding="async">
                  <?php endif; ?>
                </div>

                <div class="information--meta">
                  <?php
                  $terms = get_the_terms(get_the_ID(), 'information_cat');
                  if ($terms && !is_wp_error($terms)) :
                    $top_term = $terms[0];
                    while ($top_term->parent != 0) {
                      $top_term = get_term($top_term->parent, 'information_cat');
                    }
                  ?>
                    <span class="information--cat">
                      <?php echo esc_html($top_term->name); ?>
                    </span>
                  <?php endif; ?>

                  <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('Y.m.d'); ?></time>

                </div>
                <h3><?php the_title(); ?></h3>
              </a>
            </article>
          <?php endwhile; ?>
        </div>
        <?php wp_reset_postdata(); ?>
      <?php else : ?>
        <p>現在、お役立ち情報はありません。</p>
      <?php endif; ?>

      <a class="btn_link" href="<?php echo esc_url(home_url('/information')); ?>" rel="noopener">お役立ち情報一覧を見る</a>
    </div>
  </section>

  <section class="flow bg_gray sec">
    <div class="container">
      <h2 class="ttl">
        導入の流れ
        <span>FLOW</span>
      </h2>
      <ul>
        <li>
          <h3>ご提案</h3>
          <p>
            まずは、お客様の現状やお悩みをしっかりとお伺いし、最適なソリューションをご提案いたします。<br>
            最新の製品やシステムの特徴、導入することで得られるメリットを分かりやすくご説明し、<br class="is-hidden_sp">
            お客様のニーズに合ったプランをお届けします。
          </p>
        </li>
        <li>
          <h3>ご商談</h3>
          <p>
            具体的な導入方法やお見積もり、スケジュールなど詳細な条件について商談を進めます。<br>
            お客様との対話を通じて、ご不明な点やご要望を丁寧にお伺いし、双方納得のいくプランを練り上げて<br class="is-hidden_sp">
            まいります。
          </p>
        </li>
        <li>
          <h3>ご契約</h3>
          <p>
            商談内容にご同意いただけましたら、正式な契約手続きに進みます。<br>
            契約書のご説明や必要書類のご案内を通じて、安心してお手続きいただけるようサポートいたします。<br>
            ご契約後も、導入後のフォローアップやアフターサポートをしっかりと行っていきます。
          </p>
        </li>
      </ul>
    </div>
  </section>

  <section class="question sec bg_white">
    <div class="container">
      <h2 class="ttl">
        よくある質問
        <span>QUESTION</span>
      </h2>
      <p>皆様からのご質問を回答させていただいています。</p>
      <dl>
        <dt>法人契約でないと契約は出来ないのですか？</dt>
        <dd>商品サービスによって異なりますが､ご商売をされているお客さまでしたらお申込いただけます｡</dd>
        <dt>料金はいくらですか？</dt>
        <dd>ご利用企業様の利用計画に応じて、さまざまな料金プランをご用意しております。詳しくはお問い合わせください。</dd>
        <dt>導入までにどれくらい時間がかかりますか？</dt>
        <dd>お申し込み後、数日でご利用を開始していただけます。契約後は専任のスタッフにより、開設・ご利用方法をご説明いたします。</dd>
      </dl>
      <a class="btn_link" href="<?php echo esc_url(home_url('/question')); ?>" rel="noopener">よくある質問の一覧を見る</a>
    </div>
  </section>

  <section class="cv_contact sec">
    <div class="container">
      <div class="cv_contact--ttl">
        <h2 class="ttl">
          お問い合わせ
          <span>CONTACT</span>
        </h2>
        <img src="<?php echo get_template_directory_uri(); ?>/img/page/contact_logo.png" alt="トータルスマート株式会社" width="1100" height="117" loading="lazy" decoding="async">
      </div>
      <p>ご不明な点やご質問、または詳細な情報をお求めの場合は、どうぞお気軽にお問い合わせください。<br>
        専門のスタッフが迅速にサポートします。</p>
      <div class="cv_contact--inner">
        <ul>
          <li>
            <a href="">メールで問い合わせ</a>
          </li>
          <li>
            <a href="">LINEで問い合わせ</a>
          </li>
        </ul>
        <a href="tel:052-932-5450" class="cv_contact--btn">
          052-932-5450
          <span>受付時間<br class="is-hidden_sp">平日9:00～18:00</span>
        </a>
      </div>
    </div>
  </section>

</main>
<?php get_footer(); ?>