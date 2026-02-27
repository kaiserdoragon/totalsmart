<?php get_header(); ?>

<script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "GeneralContractor",
    "name": "トータルスマート株式会社",
    "alternateName": "Total Smart Co., Ltd.",
    "url": "<?php echo esc_url(home_url('/')); ?>",
    "logo": "<?php echo get_template_directory_uri(); ?>/img/common/logo.png",
    "image": "<?php echo get_template_directory_uri(); ?>/img/top/recruit.png",
    "description": "名古屋市を中心に愛知・岐阜・三重・静岡でエアコン修理・クリーニング、防犯カメラ、LED照明、光回線、OA機器などオフィス・店舗・住宅の設備工事を一括対応する総合設備会社。",
    "foundingDate": "2014",
    "address": {
      "@type": "PostalAddress",
      "postalCode": "461-0002",
      "addressRegion": "愛知県",
      "addressLocality": "名古屋市東区",
      "streetAddress": "代官町16-17 アーク代官町ビルディング2F",
      "addressCountry": "JP"
    },
    "geo": {
      "@type": "GeoCoordinates",
      "latitude": "35.1763",
      "longitude": "136.9205"
    },
    "telephone": "052-932-5450",
    "faxNumber": "052-932-5451",
    "contactPoint": {
      "@type": "ContactPoint",
      "telephone": "052-932-5450",
      "contactType": "customer service",
      "areaServed": ["JP", "愛知県", "岐阜県", "三重県", "静岡県"],
      "availableLanguage": "Japanese"
    },
    "employee": {
      "@type": "Person",
      "name": "京田 貴志",
      "jobTitle": "代表取締役"
    },
    "priceRange": "$$"
  }
</script>
<div class="eyecatch">
  <?php if (has_post_thumbnail()): ?>
    <?php the_post_thumbnail(); ?>
  <?php else: ?>
  <?php endif; ?>
  <h1><?php the_title(); ?></h1>
</div>

<div class="breadcrumbs--wrap">
  <?php get_template_part('include/common', 'breadcrumb'); ?>
</div>
<?php $slug_name = $post->post_name; ?>
<main class="<?php echo $slug_name; ?>_page">
  <section class="recruit_lead">
    <div class="container">
      <h2 class="ttl">
        採用情報
        <span>RECRUIT</span>
      </h2>
      <dl>
        <dt>自由な発想とチームワークを最大限に高める企業風土の創出</dt>
        <dd>
          弊社では決められたマニュアルはなく自分なりのルールで行動し、提案ができる社風です。<br>
          その為人間性を重視し、「誰と働くか」ということを大切にしています。<br>
          また働き方や雇用形態には縛られず、リモートワークなどを積極的に取り入れ、<br class="is-hidden_sp">
          成果に対してしっかりと還元をする独自の評価システムを構築することによってチームワークを強化し、<br class="is-hidden_sp">
          お客様はもちろん従業員がよりよい環境で働けることを目指します。
        </dd>
      </dl>
    </div>
    <div class="swiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/slide_01.jpg" alt="" width="320" height="270" loading="lazy" decoding="async">
        </div>
        <div class="swiper-slide">
          <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/slide_02.jpg" alt="" width="320" height="270" loading="lazy" decoding="async">
        </div>
        <div class="swiper-slide">
          <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/slide_03.jpg" alt="" width="320" height="270" loading="lazy" decoding="async">
        </div>
        <div class="swiper-slide">
          <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/slide_04.jpg" alt="" width="320" height="270" loading="lazy" decoding="async">
        </div>
        <div class="swiper-slide">
          <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/slide_05.jpg" alt="" width="320" height="270" loading="lazy" decoding="async">
        </div>
        <div class="swiper-slide">
          <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/slide_06.jpg" alt="" width="320" height="270" loading="lazy" decoding="async">
        </div>
        <div class="swiper-slide">
          <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/slide_07.jpg" alt="" width="320" height="270" loading="lazy" decoding="async">
        </div>
        <div class="swiper-slide">
          <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/slide_01.jpg" alt="" width="320" height="270" loading="lazy" decoding="async">
        </div>
        <div class="swiper-slide">
          <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/slide_02.jpg" alt="" width="320" height="270" loading="lazy" decoding="async">
        </div>
        <div class="swiper-slide">
          <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/slide_03.jpg" alt="" width="320" height="270" loading="lazy" decoding="async">
        </div>
        <div class="swiper-slide">
          <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/slide_04.jpg" alt="" width="320" height="270" loading="lazy" decoding="async">
        </div>
        <div class="swiper-slide">
          <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/slide_05.jpg" alt="" width="320" height="270" loading="lazy" decoding="async">
        </div>
        <div class="swiper-slide">
          <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/slide_06.jpg" alt="" width="320" height="270" loading="lazy" decoding="async">
        </div>
        <div class="swiper-slide">
          <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/slide_07.jpg" alt="" width="320" height="270" loading="lazy" decoding="async">
        </div>
      </div>
    </div>
  </section>

  <section class="recruit_about">
    <div class="container">
      <h2 class="page_ttl">トータルスマートとは</h2>
      <dl>
        <dt>成長し、提案し、邁進する　期待されるパートナーに。</dt>
        <dd>
          トータルスマート株式会社は愛知県名古屋市東区にオフィスを構え、<br class="is-hidden_sp">
          東海4県の企業の皆様へ、経費削減や業務効率化を行っている会社です。<br>
          <br>
          2014年に創業し、今年でおかげさまで13年目を迎えました。<br>
          メンバーの働き方はさらに多様化しています。<br>
          社員、パート、業務委託、完全在宅など、<br class="is-hidden_sp">
          一人ひとりのライフステージや適性に合わせた「フリースタイル」な働き方が定着しています。<br>
          <br>
          ワークライフバランスを大切にしつつ、同時に物事の合理性や生産効率も追及しています。<br>
          社内は非常に風通しがよく、上下関係なく意見を言いやすい風土です。<br>
          <br>
          良い意見であれば真剣に受け止め、即座に取り入れる環境が整っています。<br>
          企業、社員、会社にかかわるすべての人が気持ちよく働けるように。<br>
          <br>
          それが創業以来変わらない、トータルスマートの在り方です。
        </dd>
      </dl>
    </div>
  </section>

  <section class="recruit_work">
    <div class="container">
      <h2 class="page_ttl">私たちの働き方</h2>
      <ul>
        <li>
          <dl>
            <dt data-number="01">フラットな組織</dt>
            <dd>
              それぞれの考えや意見を大切にし、
              提案などがあれば積極的に発言
              できる環境です。
            </dd>
          </dl>
        </li>
        <li>
          <dl>
            <dt data-number="02">誰もが平等</dt>
            <dd>
              細かな役職はもうけていないので、
              一人一人が大きな裁量権を持って
              働けます。自分で考えて行動したい方
              にぴったりです。
            </dd>
          </dl>
        </li>
        <li>
          <dl>
            <dt data-number="03">ミーティングは月に数回</dt>
            <dd>
              コロナ前からリモートワークどの
              新しい働き方を積極的に取り入れて
              おり、ミーティングも月1回の定例会
              以外は必要に応じてのみWEBで
              行っています。
            </dd>
          </dl>
        </li>
        <li>
          <dl>
            <dt data-number="04">開放的な人間関係</dt>
            <dd>
              社長含め上下関係にとらわれない開放的な人間関係が弊社の特徴です。
            </dd>
          </dl>
        </li>
        <li>
          <dl>
            <dt data-number="05">ワークライフバランス</dt>
            <dd>
              ベンチャー企業と聞くと働きやすさは二の次になっていると感じられる方もいるのではないでしょうか？
              私たちはワークライフバランスを大切にしています。
              一人ひとりに合った働き方を選択できます。
            </dd>
          </dl>
        </li>
        <li>
          <dl>
            <dt data-number="06">失敗を恐れない</dt>
            <dd>
              失敗しても全く怒られません。
              失敗は会社の財産です。
              反省＆改善でサービス強化に繋がります。
              逆に、チャレンジ、トライアルしないと社内評価は下がります。
            </dd>
          </dl>
        </li>
      </ul>
    </div>
  </section>

  <section class="bg_gray sec">
    <div class="container">
      <h2 class="page_ttl">社員の声</h2>
      <div class="recruit_voice">
        <div class="recruit_voice--image">
          <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/voice_01.jpg" alt="" width="447" height="322" loading="lazy" decoding="async">
          <p>2019年<span>営業職</span></p>
        </div>
        <div class="recruit_voice--txt">
          <dl>
            <dt>Q.入社した経緯は何ですか。</dt>
            <dd>
              前職で営業をやっていたこともあり、その当時からトータルスマート
              のことを知っていました。<br>
              自由な社風と頑張ればその分稼げるということにとても魅力を感じ入社しました。
            </dd>
            <dt>Q.現在の業務内容をおしえてください。</dt>
            <dd>
              法人向けの通信回線の提案が主なものになります。<br>
              飛び込み営業はなく、在宅アポインターさんが獲得して下さったアポイント先に訪問し営業をする流れになっています。
            </dd>
            <dt>Q.仕事をするうえで大切にしていることは何ですか？</dt>
            <dd>
              お客様から契約を頂いて終わりではないので、その後のサポートで
              もお客様に満足して頂けるよう心掛けています。<br>
              その為には、メーカーや他部署との連携がとても大切であり、スムーズに事が運ぶようチームプレーを大事にしています。
            </dd>
            <dt>Q.ほぼ在宅での働き方についてどう感じていますか。</dt>
            <dd>
              今まで働いてきた会社では朝と夜は必ず事務所に行っていました。
              現在はとても楽になり、月2回事務所に行くだけになっています。
              そのため会社に帰ることを考えずに仕事のスケジュールを立てることもできますし、会社に寄らない分早く家に帰ることができ、その分プライベート時間に充てられるので、公私ともに充実した生活を送れていると思います。
            </dd>
            <dt>Q.これからの目標や展望をおしえてください。</dt>
            <dd>
              この会社は厳しいノルマなどはありませんが、頑張ったらその分給料に反映して頂けるので、やりがいがあると思います！<br>
              会社に貢献するため、また自分のためにも今後も頑張りたいと思っています！！
            </dd>
          </dl>
        </div>
      </div>
      <div class="recruit_voice">
        <div class="recruit_voice--image">
          <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/voice_02.jpg" alt="" width="447" height="322" loading="lazy" decoding="async">
          <p>2019年<span>営業職</span></p>
        </div>
        <div class="recruit_voice--txt">
          <dl>
            <dt>Q.入社した経緯は何ですか。</dt>
            <dd>
              もともと営業に興味があったのですが、子育てとの両立が難しい業種だと思い諦めかけていた時にトータルスマート求人を見つけました。
              常にたくさんのことを学べて自分のスキルアップにつながる仕事がしたい…という条件と一致したのがこの職場でした。<br>
              シングルマザーでも快く受け入れていただけたところも入社を決めた大きな決め手でした。
            </dd>
            <dt>Q.現在の業務内容をおしえてください。</dt>
            <dd>
              新規ユーザーの獲得や既存のお客さまの保守及びよりよい環境にしていく提案営業をしています。
            </dd>
            <dt>Q.仕事をするうえで大切にしていることは何ですか？</dt>
            <dd>
              まずはお客様の気持ち考え、ひとりひとりに合った提案をできるように心がけています。<br>
              不安やお困りごとがあったときに1番に頭に浮かんで、頼っていただける担当者になれるような関係性を築いていくことも大切にしています。
            </dd>
            <dt>Q.ほぼ在宅での働き方についてどう感じていますか。</dt>
            <dd>
              ほぼ出社がなく、事務作業は在宅が基本です。<br>
              通勤などの時間をお客さまとの時間にあてられるので、その分信頼関係を深めたり急な連絡にも臨機応変に対応できるところにメリットを感じています。
            </dd>
            <dt>Q.これからの目標や展望をおしえてください。</dt>
            <dd>
              標は扱っている商材ひとつひとつの知識を増やしていき、常に進化し続けながらも初心を忘れず…これからもお客さまに寄り添い、頼られる営業員になっていくことです。
            </dd>
          </dl>
        </div>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>