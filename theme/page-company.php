<?php get_header(); ?>
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
  <section class="company_about sec">
    <div class="container -md">
      <h2 class="ttl">
        会社概要
        <span>COMPANY</span>
      </h2>
      <p>
        創業以来、当社は常に革新と成長を追求し、最新技術の導入を積極的に進めてまいりました。<br>
        市場の変化に柔軟に対応するため、数々の先進ソリューションを開発・提供し、業界内での信頼と実績を築いております。<br>
        これまでの歩みは、社員一人ひとりの努力とお客様・パートナー様との強固な連携の賜物です。<br>
        今後も新たな挑戦を続け、未来を切り拓いていきます。
      </p>
      <table>
        <tr>
          <th>法人名</th>
          <td>トータルスマート株式会社</td>
        </tr>
        <tr>
          <th>代表者</th>
          <td>京田 貴志</td>
        </tr>
        <tr>
          <th>所在地</th>
          <td>愛知県名古屋市東区代官町16-17 アーク代官町ビルディング2F</td>
        </tr>
        <tr>
          <th>電話番号</th>
          <td>052-932-5450</td>
        </tr>
        <tr>
          <th>FAX</th>
          <td>052-932-5451</td>
        </tr>
        <tr>
          <th>設立</th>
          <td>2014年（平成26年） 09月</td>
        </tr>
        <tr>
          <th>資本金</th>
          <td>1,000万円</td>
        </tr>
        <tr>
          <th>事業内容</th>
          <td>
            通信回線販売<br>
            工事スタッフ（サービスエンジニア）<br>
            情報通信OA機器の販売・工事・保守<br>
            防犯セキュリティシステムの販売・工事・保守<br>
            エコ関連商品の販売・工事・保守<br>
            WEBマーケティング<br>
            代理店コンサルティング
          </td>
        </tr>
        <tr>
          <th>グループ会社</th>
          <td>
            アットソリューション株式会社　AT Solution Ltd
          </td>
        </tr>
      </table>
      <img src="<?php echo get_template_directory_uri(); ?>/img/company/exterior.jpg" alt="" width="900" height="500" loading="lazy" decoding="async">
    </div>
  </section>

  <section class="company_access sec -md bg_gray" id="access">
    <div class="company_access--inner">
      <h2 class="page_ttl">アクセス</h2>
      <a href="https://maps.app.goo.gl/Dh57s5aHyVMs9oi68">愛知県名古屋市東区代官町16-17 アーク代官町ビルディング2F</a>
      <div class="company_access--info">
        <dl>
          <dt>電車の場合</dt>
          <dd>
            <ul>
              <li>
                地下鉄 桜通線「高岳」駅（2番出口）から徒歩約11分。<br>
                大通り（国道19号）沿いに「代官町」交差点方面へ進むと、<br class="is-hidden_sp">
                ガラス面の多い白い外観の高層ビルが見えてきます。
              </li>
              <li>
                地下鉄 東山線「新栄町」駅から徒歩約13分。<br>
                国道19号線沿いに進むと到着します。
              </li>
            </ul>
          </dd>
          <dt>バスの場合</dt>
          <dd>
            <ul>
              <li>
                市バス「飯田町」停から徒歩約5分。（建物最寄りの停留所の一つです。）<br>
                ※市バス「代官町」停（東巡回系統 ほか）も周辺にあります。
              </li>
            </ul>
          </dd>
        </dl>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3261.121082038919!2d136.91922377576543!3d35.17853457275365!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x600370ba32995555%3A0x8d9204a4268d7036!2z44OI44O844K_44Or44K544Oe44O844OI5qCq5byP5Lya56S-!5e0!3m2!1sja!2sjp!4v1770079692557!5m2!1sja!2sjp" width="100%" height="auto" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
  </section>

  <section class="company_date sec -top" id="philosophy">
    <div class="container -sm">
      <h2 class="page_ttl">企業理念</h2>
      <img src="<?php echo get_template_directory_uri(); ?>/img/company/philosophy.png" alt="" width="261" height="200" loading="lazy" decoding="async">
      <p>
        お得・快適・安心を軸に、お客様の生涯に寄り添う“信頼されるパートナー”となる。<br>
        最適なコスト削減と効率化を提案し、進化するサービスを磨いて提供。全国展開で多様な課題に応え、<br class="is-hidden_sp">
        個性を活かした提案力で期待を超えていきます。
      </p>
      <ul class="company_date--list">
        <li>
          地域密着企業として、お客様に満足・喜び・感動を与える商品とサービスを提供いたします。
        </li>
        <li>
          社員一人一人が自主性・主体性をもち、考え・行動・協力できる社員を育成します。
        </li>
        <li>
          今に感謝し、明るく前向きに素直な心で日々勉強をし、昨日の自分より成長します。
        </li>
      </ul>
    </div>
  </section>

  <section class="company_date sec -top" id="history">
    <div class="container -sm">
      <h2 class="page_ttl">沿革</h2>
      <img src="<?php echo get_template_directory_uri(); ?>/img/company/history.png" alt="" width="307" height="200" loading="lazy" decoding="async">
      <p>
        創業以来、当社は常に革新と成長を追求し、最新技術の導入を積極的に進めてまいりました。<br>
        市場の変化に柔軟に対応するため、数々の先進ソリューションを提供し業界内での信頼と実績を築いております。<br>
        これまでの歩みは、社員一人ひとりの努力とお客様・パートナー様との強固な連携の賜物です。<br>
        今後も新たな挑戦を続け、未来を切り拓いていきます。
      </p>
    </div>
  </section>

  <section class="company_date sec -bottom">
    <div class="container -sm">
      <h2 class="page_ttl">お取引先様</h2>
      <img src="<?php echo get_template_directory_uri(); ?>/img/company/transaction.png" alt="" width="263" height="155" loading="lazy" decoding="async">
      <p>
        弊社は、優れた仕入先および提供パートナーとの強固な連携を基盤に、<br class="is-hidden_sp">
        高品質な製品とサービスの供給体制を構築しております。<br>
        大手メーカーや専門ベンダーをはじめとする信頼性の高いパートナーと協業し、<br class="is-hidden_sp">
        最新技術を駆使した革新的なソリューションの提供に努めています。<br>
        これにより、常に市場の多様なニーズに柔軟かつ迅速に対応し、お客様に安心と満足をお届けしています。<br>
        今後もパートナーシップを一層強化し、さらなる品質向上とサービス充実を目指してまいります。
      </p>
      <ul class="company_date--partners">
        <li>
          <img src="<?php echo get_template_directory_uri(); ?>/img/company/logo_01.png" alt="" width="232" height="39" loading="lazy" decoding="async">
          <p>株式会社日立製作所様</p>
        </li>
        <li>
          <img src="<?php echo get_template_directory_uri(); ?>/img/company/logo_02.png" alt="" width="212" height="46" loading="lazy" decoding="async">
          <p>ダイキン工業株式会社様</p>
        </li>
        <li>
          <img src="<?php echo get_template_directory_uri(); ?>/img/company/logo_03.png" alt="" width="239" height="66" loading="lazy" decoding="async">
          <p>株式会社日立製作所様</p>
        </li>
        <li>
          <img src="<?php echo get_template_directory_uri(); ?>/img/company/logo_04.png" alt="" width="228" height="40" loading="lazy" decoding="async">
          <p>株式会社USEN様</p>
        </li>
      </ul>
    </div>
  </section>

  <section class="company_message sec -bottom">
    <div class="container">
      <h2 class="ttl">
        代表挨拶
        <span>MESSAGE</span>
      </h2>
      <img class="company_message--logo" src="<?php echo get_theme_file_uri('/img/common/logo.png'); ?>" alt="トータルスマート株式会社" width="325" height="68" fetchpriority="high" decoding="async" />
      <p>
        自由でみずみずしい発想を原動力に。<br>個人の想像力とチームワークの強みを最大限に高める企業風土をつくる。
      </p>

      <dl>
        <dt class="page_ttl">名前の由来</dt>
        <dd>
          経費節減がメインの会社ななので、全ての経費を（トータルに）節減（スマートに）するお手伝いをする会社です。
        </dd>
      </dl>

      <dl>
        <dt class="page_ttl">代表挨拶</dt>
        <dd>
          現在のオフィスを取り巻く環境は、新しいシステムや技術がとても早いスピードで変化しており、導入コストが上がっている状況になります。<br>
          その中でも特にコスト削減や業務の効率化は重要視されているのではないかと思います。<br>
          常にお客様目線で、その企業様にあった削減方法や業務の効率化を提案していきたいと思っております。<br>
          また導入後のアフターフォローが1番大事だと思っておりますので、自社工事やコールセンターを活用して、お客様の問題点をいち早く解決していける体制を取っております。<br>
          企業様のお困り事に寄り添える企業として、縁の下の力持ちのような存在を目指しております。
        </dd>
      </dl>
      <img class="company_message--illust" src="<?php echo get_theme_file_uri('/img/company/illust.jpg'); ?>" alt="トータルスマート株式会社" width="800" height="1200" fetchpriority="high" decoding="async" />
    </div>
  </section>

</main>

<?php get_footer(); ?>