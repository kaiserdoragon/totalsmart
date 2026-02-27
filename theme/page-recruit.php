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

  <section class="recruit_requirements sec">
    <div class="container">
      <h2 class="page_ttl">募集要項</h2>
      <div class="tab_change">
        <ul class="tab_change--list">
          <li class="tab_change--item -selected" data-id="tab-1">電気工事スタッフ</li>
          <li class="tab_change--item" data-id="tab-2">保守点検スタッフ</li>
          <!-- <li class="tab_change--item" data-id="tab-3">募集求人</li> -->
        </ul>
        <div class="tab_change--content -show" id="tab-1">
          <table>
            <tr>
              <th>募集職種</th>
              <td>電気工事スタッフ</td>
            </tr>
            <tr>
              <th>仕事内容</th>
              <td>
                <p class="u-mb15">オフィスや店舗などの「業務用エアコン」「LED照明」の設置・交換・修理や「通信工事」をお任せします。</p>
                <ul class="u-mb15">
                  <li>・古いエアコンや照明器具などの取り外し、新しい機器への交換</li>
                  <li>・新店舗・オフィスの開設に伴う新設・増設工事</li>
                  <li>・LED照明の設置作業</li>
                  <li>・オフィスネットワーク工事など</li>
                </ul>
                <p class="u-mb30">補助業務など、できることからお任せします！</p>
                <dl class="u-mb30">
                  <dt>【入社後の流れ】</dt>
                  <dd class="u-mb15">
                    <p>■1カ月～3カ月　OJT研修</p>
                    補助作業からスタート！<br>
                    先輩が横にいるので、わからないことはすぐに確認できます。<br>
                    個々のペースに合わせて研修を行うので焦らず成長してください。
                  </dd>
                  <dd>
                    <p>■3カ月を目安に独り立ち（※経験者は1カ月が目安）</p>
                    独り立ちまでの期間は目安なので、個々のペースで大丈夫です。<br>
                    独り立ち後もしっかりサポートします！<br>
                    現場でわからないことがあったら、いつでも電話で相談できます。
                  </dd>
                </dl>
                <dl class="u-mb30">
                  <dt>【チーム／組織構成】</dt>
                  <dd>
                    「未経験で長く続くかな…」そんな不安をお持ちの方も多いと思います。<br>
                    当社では、未経験で入社された方の95%以上が3年以上継続して働いています。<br>
                    この数字が示すのは、単なる「人手不足だから採用する」のではなく、本当に働きやすい環境を整えているということです。<br>
                    私たちは、入社していただく方を単なる「労働力」ではなく、会社の未来を一緒に築いていく大切なパートナーだと考えています。<br>
                    だからこそ、技術習得のためのサポートはもちろん、長く安心して働ける環境づくりに全力で取り組んでいます。<br>
                    未経験からのスタートでも、必ず一人前の技術者になれる。<br>
                    そして長く活躍できる。<br>
                    そんな確信を持って、あなたをお迎えします。
                  </dd>
                </dl>
                <p>★未経験入社の定着率95%以上！</p>
              </td>
            </tr>
            <tr>
              <th>対象となる方</th>
              <td>
                <p class="u-mb15">【未経験歓迎／学歴不問】経験よりも人柄とやる気を重視した採用を行います！</p>
                <ul class="u-mb15">
                  <li>・業界未経験歓迎</li>
                  <li>・職種未経験歓迎</li>
                  <li>・学歴不問</li>
                  <li>・第二新卒歓迎</li>
                  <li>・社会人経験10年以上歓迎</li>
                </ul>
                <p class="u-mb30">
                  必須条件はありません！<br>
                  少しでも興味を持っていただけたらぜひご応募ください。
                </p>
                <dl class="u-mb30">
                  <dt>【歓迎条件】</dt>
                  <dd class="u-mb15">
                    <ul>
                      <li>第二種電気工事士の資格をお持ちの方（優遇）</li>
                      <li>LED工事、エアコン工事、電気工事の経験がある方</li>
                      <li>光回線工事、防犯カメラ工事、内装工事などの経験がある方</li>
                    </ul>
                  </dd>
                </dl>
                <dl class="u-mb30">
                  <dt>【こんな方にピッタリ】</dt>
                  <dd>
                    <ul>
                      <li>・手に職をつけたい方</li>
                      <li>・電気関係の仕事に興味がある方</li>
                      <li>・働きやすい環境で仕事がしたい方</li>
                      <li>・資格を取ってスキルアップしたい方</li>
                      <li>・頑張りをきちんと評価されたい方</li>
                      <li>・プライベートも大切にしたい方</li>
                    </ul>
                  </dd>
                </dl>
                <p>★未経験入社の定着率95%以上！</p>
              </td>
            </tr>
            <tr>
              <th>勤務地</th>
              <td>
                <p class="u-mb15">
                  愛知県・岐阜県・静岡県・三重県の担当エリア<br>（エリアは希望を考慮可能）
                </p>
                <p class="u-mb15">【本社】愛知県名古屋市東区代官町16-17 代官町ビルディング2F</p>
                <ul>
                  <li>・転勤なし</li>
                  <li>・直行直帰OK！</li>
                </ul>
              </td>
            </tr>
            <tr>
              <th>勤務時間</th>
              <td>
                <p class="u-mb15">
                  9:00～18:00（所定労働時間8時間／休憩60分）
                </p>
                <p class="u-mb15">
                  ※現場が遠くなったり、朝早く出勤となった場合はその分早く帰宅できます<br>
                  ※勤務時間は、現場に合わせて変動するので負担は少なめ♪
                </p>
                <ul class="u-mb15">
                  <li>★基本直行直帰なのでプライベートも充実！</li>
                  <li>★残業はほぼありません！</li>
                </ul>
                <p>※平均残業時間5時間</p>
              </td>
            </tr>
            <tr>
              <th>雇用形態</th>
              <td>
                <p class="u-mb15">
                  正社員<br>
                  ※試用期間0カ月～3カ月あり<br>
                  （試用期間中の給与月給23万円・待遇に変動なし）
                </p>
                <p>期間は個々の経験・能力に応じて変動します。</p>
              </td>
            </tr>
            <tr>
              <th>給与</th>
              <td>
                <p class="u-mb15">
                  ■未経験<br>
                  月給25万円～<br>
                  ※残業代全額支給
                </p>
                <p class="u-mb15">
                  ■経験者<br>
                  月給30万円～50万円<br>
                  ※経験者の方は前職の給与を考慮して決定します<br>
                  ※残業代全額支給
                </p>
                <ul class="u-mb15">
                  <li>・給与にプラスしてもらえる手当・インセンティブ</li>
                  <li>・資格手当（上限2万円）</li>
                  <li>・駐車場代支給</li>
                  <li>・休日手当あり（1万円～）<br>※現場によって＋変動あり</li>
                </ul>
                <dl class="u-mb15">
                  <dt>・歩合給あり</dt>
                  <dd>
                    個人成績により、5％のインセンティブが発生します！<br>
                    給与＋15万円のインセンティブを獲得した社員もいます！
                  </dd>
                </dl>
                <dl class="u-mb15">
                  <dt>・入社時の想定年収</dt>
                  <dd>
                    年収300万円～500万円
                  </dd>
                </dl>
                <dl class="u-mb15">
                  <dt>・社員の年収例</dt>
                  <dd>
                    年収350万円（入社1年目／未経験入社）<br>
                    年収400万円～500万円（入社1年目／経験者入社）
                  </dd>
                </dl>
              </td>
            </tr>
            <tr>
              <th>休日・休暇</th>
              <td>
                <dl class="u-mb15">
                  <dt>【年間休日】</dt>
                  <dd>
                    120日以上
                  </dd>
                </dl>
                <dl class="u-mb15">
                  <dt>【休日・休暇】</dt>
                  <dd>
                    <ul>
                      <li>・完全週休2日制（土・日）</li>
                      <li>・祝日休み</li>
                      <li>・年末年始休暇　</li>
                      <li>・GW休暇</li>
                      <li>・夏季休暇</li>
                      <li>・有給休暇（入社6カ月に10日付与）</li>
                      <li>・基本的には土日祝休みですが、希望があれば休日出勤も可能です！（1万円～の休日手当あり）</li>
                      <li>・お子様の行事、急な発熱などもご相談ください。</li>
                      <li>・有給休暇取得を推奨しています。</li>
                    </ul>
                  </dd>
                </dl>
              </td>
            </tr>
          </table>
        </div>
        <div class="tab_change--content" id="tab-2">
          <table>
            <tr>
              <th>募集職種</th>
              <td>保守点検スタッフ</td>
            </tr>
            <tr>
              <th>仕事内容</th>
              <td>
                <p class="u-mb15">既存顧客先に訪問して、フォーマットに沿ってヒアリングを行うお仕事</p>
                <dl class="u-mb30">
                  <dt>【具体的な仕事内容】</dt>
                  <dd class="u-mb15">
                    当社は顧客サポートに特化した会社です。<br>
                    1万社以上の法人のお客様に対して、訪問サポートを中心に行っています。<br>
                    営業ではなく、お客様の「困った」を解決することに専念できるポジションです。
                  </dd>
                </dl>
                <ul class="u-mb15">
                  <li>・既存のお客様を訪問し、状況やお困りごとをヒアリング</li>
                  <li>・内容に応じて「新規営業部」「営業部」「工事部」など各部署へ連携</li>
                  <li>・必要に応じたフォロー対応</li>
                  <li>※営業業務はありません！</li>
                </ul>
                <p class="u-mb30">「人と話すのが好き」「営業はちょっと苦手…」という方も大歓迎です。</p>
                <dl class="u-mb30">
                  <dt>【入社後の流れ】</dt>
                  <dd class="u-mb15">
                    最初は先輩と同行しながら、挨拶まわりや基本業務を学びます。<br>
                    約1カ月程度で基本業務を習得できるので、未経験でも安心。<br>
                    独り立ち後も常にフォロー体制あり。<br>
                    わからないことはすぐに相談できます。
                  </dd>
                </dl>
                <dl class="u-mb30">
                  <dt>【キャリアの広がり】</dt>
                  <dd class="u-mb15">
                    仕事を覚えるうちに、<br>
                    「営業も挑戦してみたい」<br>
                    「もっと幅広い業務を経験したい」<br>
                    といった希望があればキャリアチェンジも可能です。
                  </dd>
                </dl>
                <dl class="u-mb30">
                  <dt>【チーム／組織構成】</dt>
                  <dd>
                    「未経験で長く続くかな…」そんな不安をお持ちの方も多いと思います。<br>
                    当社では、未経験で入社された方の95%以上が3年以上継続して働いています。<br>
                    この数字が示すのは、単なる「人手不足だから採用する」のではなく、本当に働きやすい環境を整えているということです。<br>
                    私たちは、入社していただく方を単なる「労働力」ではなく、会社の未来を一緒に築いていく大切なパートナーだと考えています。<br>
                    だからこそ、技術習得のためのサポートはもちろん、長く安心して働ける環境づくりに全力で取り組んでいます。<br>
                    未経験からのスタートでも、必ず一人前の技術者になれる。<br>
                    そして長く活躍できる。<br>
                    そんな確信を持って、あなたをお迎えします。
                  </dd>
                </dl>
                <p>★未経験入社の定着率95%以上！</p>
              </td>
            </tr>
            <tr>
              <th>対象となる方</th>
              <td>
                <p class="u-mb15">【未経験歓迎／学歴不問】経験よりも人柄とやる気を重視した採用を行います！</p>
                <ul class="u-mb15">
                  <li>・業界未経験歓迎</li>
                  <li>・職種未経験歓迎</li>
                  <li>・学歴不問</li>
                  <li>・第二新卒歓迎</li>
                  <li>・社会人経験10年以上歓迎</li>
                </ul>
                <p class="u-mb30">
                  必須条件はありません！<br>
                  少しでも興味を持っていただけたらぜひご応募ください。
                </p>
                <dl class="u-mb30">
                  <dt>【歓迎条件】</dt>
                  <dd class="u-mb15">
                    <ul>
                      <li>何らかの営業経験をお持ちの方（業界、経験年数不問）</li>
                      <li>LED工事、エアコン工事、電気工事の経験がある方</li>
                      <li>光回線工事、防犯カメラ工事、内装工事などの経験がある方</li>
                    </ul>
                  </dd>
                </dl>
                <dl class="u-mb30">
                  <dt>【こんな方にピッタリ】</dt>
                  <dd>
                    <ul>
                      <li>手に職をつけたい方</li>
                      <li>電気関係の仕事に興味がある方</li>
                      <li>働きやすい環境で仕事がしたい方</li>
                      <li>資格を取ってスキルアップしたい方</li>
                      <li>頑張りをきちんと評価されたい方</li>
                      <li>プライベートも大切にしたい方</li>
                    </ul>
                  </dd>
                </dl>
                <p>★未経験入社の定着率95%以上！</p>
              </td>
            </tr>
            <tr>
              <th>勤務地</th>
              <td>
                <p class="u-mb15">
                  愛知県・岐阜県・静岡県・三重県の担当エリア<br>（エリアは希望を考慮可能）
                </p>
                <p class="u-mb15">【本社】愛知県名古屋市東区代官町16-17 代官町ビルディング2F</p>
                <ul>
                  <li>・転勤なし</li>
                  <li>・直行直帰OK！</li>
                </ul>
              </td>
            </tr>
            <tr>
              <th>勤務時間</th>
              <td>
                <p class="u-mb15">
                  9:00～18:00（所定労働時間8時間／休憩60分）
                </p>
                <p class="u-mb15">
                  ※現場が遠くなったり、朝早く出勤となった場合はその分早く帰宅できます<br>
                  ※勤務時間は、現場に合わせて変動するので負担は少なめ♪
                </p>
                <ul class="u-mb15">
                  <li>★基本直行直帰なのでプライベートも充実！</li>
                  <li>★残業はほぼありません！</li>
                </ul>
                <p>※平均残業時間5時間</p>
              </td>
            </tr>
            <tr>
              <th>雇用形態</th>
              <td>
                <p class="u-mb15">
                  正社員<br>
                  ※試用期間0カ月～3カ月あり<br>
                  （試用期間中の給与月給23万円・待遇に変動なし）
                </p>
                <p>期間は個々の経験・能力に応じて変動します。</p>
              </td>
            </tr>
            <tr>
              <th>給与</th>
              <td>
                <p class="u-mb15">
                  月給25万円～<br>
                  ※経験者の方は前職の給与を考慮して決定します<br>
                  ※残業代全額支給
                </p>
                <dl class="u-mb15">
                  <dt>・自家用車を利用する方は手当有（月2万円）</dt>
                  <dd>ほとんどの社員が上記手当を取得しているため月給合計27万円～となっています！</dd>
                </dl>
                <ul class="u-mb15">
                  <li>・給与にプラスしてもらえる手当・インセンティブ</li>
                  <li>・自家用車を利用する方は手当有（月2万円）</li>
                  <li>・資格手当（上限2万円）</li>
                  <li>・駐車場代支給</li>
                  <li>・休日手当あり（1万円～）※現場によって＋変動あり</li>
                  <li>・歩合給あり</li>
                </ul>
                <p>
                  個人成績により、5％のインセンティブが発生します！<br>
                  給与＋15万円のインセンティブを獲得した社員もいます！
                </p>
                <dl>
                  <dt>■入社時の想定年収</dt>
                  <dd>年収300万円～400万円</dd>
                </dl>
                <dl>
                  <dt>■社員の年収例</dt>
                  <dd>年収350万円～400万円（入社1年目／未経験入社）</dd>
                </dl>
            </tr>
            <tr>
              <th>休日・休暇</th>
              <td>
                <dl class="u-mb15">
                  <dt>【年間休日】</dt>
                  <dd>
                    120日以上
                  </dd>
                </dl>
                <dl class="u-mb15">
                  <dt>【休日・休暇】</dt>
                  <dd>
                    <ul>
                      <li>・完全週休2日制（土・日）</li>
                      <li>・祝日休み</li>
                      <li>・年末年始休暇　</li>
                      <li>・GW休暇</li>
                      <li>・夏季休暇</li>
                      <li>・有給休暇（入社6カ月に10日付与）</li>
                      <li>・基本的には土日祝休みですが、希望があれば休日出勤も可能です！（1万円～の休日手当あり）</li>
                      <li>・お子様の行事、急な発熱などもご相談ください。</li>
                      <li>・有給休暇取得を推奨しています。</li>
                    </ul>
                  </dd>
                </dl>
              </td>
            </tr>
          </table>
        </div>
        <!-- <div class="tab_change--content" id="tab-3">
          募集求人のコンテンツ
        </div> -->
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>