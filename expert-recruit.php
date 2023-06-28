<?php
// データベース接続情報
$host = 'localhost';
$dbname = 'enterprise';
$username = 'root';
$password = 'root';

// データベース接続
try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}

// 集計クエリ実行
$query = "SELECT option_name, COUNT(*) AS count FROM votes
          INNER JOIN options ON votes.option_id = options.id
          GROUP BY option_name
          ORDER BY count DESC";
$stmt = $db->prepare($query);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// IPアドレスの取得
$ipAddress = $_SERVER['REMOTE_ADDR'];

// 同一IPアドレスでの重複投票チェック
$query = "SELECT COUNT(*) FROM votes WHERE ip_address = :ipAddress";
$stmt = $db->prepare($query);
$stmt->bindValue(':ipAddress', $ipAddress);
$stmt->execute();
$voteCount = $stmt->fetchColumn();

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
    <meta name="description" content="株式会社MIST solution - トップページ 株式会社ミストソリューションは、異なった業界との接点を持つことで化学反応を起こし、
    幅広いニーズにより的確にお応えできる、常に進化しているIT企業です。">
    <meta name="keywords" content="株式会社ミストソリューション,ミストソリューション,MISTsolution,ミスト" />
    <meta name="copyright" content="© 1997, 2023 mistsolution. All Rights Reserved.">
    <meta name="format-detection" content="telephone=no">
    <!-- OGP -->
    <meta property="og:url" content="https://www.mistnet.co.jp">
    <meta property="og:title" content="株式会社MIST solution | WEBサイト" />
    <meta property="og:site_name" content="株式会社MIST solution | WEBサイト">
    <meta name="og:description" content="株式会社MIST solution - トップページ 株式会社ミストソリューションは、異なった業界との接点を持つことで化学反応を起こし、
    幅広いニーズにより的確にお応えできる、常に進化しているIT企業です。">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="ja-JP">
    <meta property="og:image" content="assets/images/mist-ogp.jpg">
    <meta name="twitter:card" content="summary" />
    <!-- 各々変更 -->
    <title>ベテラン向け</title>
    <!-- jQuery -->

    <!-- css,js -->
    <link rel="stylesheet" href="css/reset.css" type="text/css">
    <link rel="stylesheet" href="css/common.css" type="text/css">
    <link rel="stylesheet" href="css/expert.css" type="text/css">
    <script type="text/javascript" src="js/header.js"></script>
    <script type="text/javascript" src="js/common.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- favicon -->
    <link rel="icon" href="img/favicon.ico">

</head>

<body>

    <!-- header -->
    <header class="header flex-box">
        <h1 class="site-title">
            <a href="#!">
                <img src="img/グループ 1315.png" alt="ロゴ">
            </a>
        </h1>
        <a href="#!"><img class="header-instagram" src="img/グループ 790.png" alt="Instagram"></a>
        <a href="#!"><img class="header-twitter" src="img/white background.png" alt="Twitter"></a>
        <a href="#!" class="header-entry">エントリー</a>
        <nav class="header-nav">
            <ul class="nav-list">
                <li class="nav-item"><a href="#!">Service</a></li>
                <li class="nav-item"><a href="#!">About</a></li>
                <li class="nav-item"><a href="#!">News</a></li>
                <li class="nav-item"><a href="#!">Conetact</a></li>
                <li class="nav-item"><a href="#!">Recruit</a></li>
            </ul>
        </nav>
        <button class="burger-btn">
            <span class="bars">
                <span class="bar bar_top"></span>
                <span class="bar bar_mid"></span>
                <span class="bar bar_bottom"></span>
            </span>
        </button>
        <span class="burger-musk"></span>
    </header>

    <!-- トップ画像 -->
    <div><img src="img/expert-TOP.png" class="top-img" alt=""></div>

    <!-- 隙間 -->
    <div class="gap-control-probram"></div>
    <div class="gap-control-probram"></div>

    <!-- Question -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <p class="font-style-title text-center">質問</p>
                <hr class="border-line">
            </div>
        </div>
    </div>
    <!--  -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <p class="font-style-words text-center">「キャリアアップで選ぶポイントは何ですか？」</p>
            </div>
        </div>
    </div>

    <!-- エンジニアが選ぶ企業のポイント　ランキング -->
    <div class="wrapper">
        <canvas id="barChart"></canvas>

        <script>
            // データの準備
            const labels = [];
            const data = [];

            <?php foreach ($results as $result) : ?>
                labels.push('<?php echo $result['option_name']; ?>');
                data.push(<?php echo $result['count']; ?>);
            <?php endforeach; ?>

            // チャートの描画
            const ctx = document.getElementById('barChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: '投票数',
                        data: data,
                        backgroundColor: 'transparent', // 棒グラフの背景色
                        borderColor: '#FF2D2D', // 棒グラフの枠線の色
                        borderWidth: 2 // 棒グラフの枠線の太さ
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: Math.max(...data) + 2, // 最大値 + 2 を設定
                            title: {
                                display: false,
                                text: '投票数'
                            }
                        },
                        x: {
                            title: {
                                display: false,
                                text: '項目'
                            }
                        }
                    }
                }
            });
        </script>

        <!-- 隙間 -->
        <div class="gap-control-probram"></div>
        <div class="gap-control-probram"></div>

        <!-- 投稿フォーム -->

        <form method="post">
            <p class="post-title font-style-comments2">キャリアアップで転職をされる際に、重要視されるポイントを下記よりお選びください。<br>※複数選択可能</p>
            <?php if ($voteCount === 0) : ?>
                <!-- 隙間 -->
                <div class="gap-control-probram"></div>
                <div class="gap-control-probram"></div>

                <div class="flex-posts">
                    <div class="column">
                        <input type="checkbox" name="vote[]" value="1" class="flex-post"> 事業内容<br>
                        <input type="checkbox" name="vote[]" value="2" class="flex-post"> 技術力<br>
                        <input type="checkbox" name="vote[]" value="3" class="flex-post"> ネームバリュー<br>
                    </div>
                    <div class="column">
                        <input type="checkbox" name="vote[]" value="4" class="flex-post"> 職場環境<br>
                        <input type="checkbox" name="vote[]" value="5" class="flex-post"> 年収<br>
                        <input type="checkbox" name="vote[]" value="6" class="flex-post"> 勤務地<br>
                    </div>
                    <div class="column">
                        <input type="checkbox" name="vote[]" value="7" class="flex-post"> 会社の成長<br>
                        <input type="checkbox" name="vote[]" value="8" class="flex-post"> 福利厚生<br>
                        <input type="checkbox" name="vote[]" value="9" class="flex-post"> 雰囲気<br>
                    </div>
                    <div class="column">
                        <input type="checkbox" name="vote[]" value="10" class="flex-post"> その他<br>
                    </div>
                </div>

                <input class="post-btn" type="submit" value="投票">
        </form>
    <?php else : ?>
        <p class='vote-message'>※既に投票済みです。</p>
    <?php endif; ?>
    </div>

    <!-- コメント -->
    <div class="container-fluid">
        <div class="row">
            <div class="wrapper">
                <p class="font-style-comments2 txt">皆さんは、転職先を選ぶ時に何を最も重視しますか？
                    たとえば…職場環境、雰囲気、年収、<br>業務内容、技術力、ネームバリューなど、
                    エンジニアに転職をするなら実際自分が使ったことのあ<br>るサービスを
                    開発している企業や、なじみのあるサービスに少しでも携われるのは魅力的だと
                    思わ<br>れたりもします。しかし、就活時と実際にエンジニアとして
                    働いたあとでは企業選びは変わります。<br>ステージでごとに柔軟な対応で
                    エンジニアとの相乗効果を図ります。</p>
            </div>
        </div>
    </div>

    <!-- 隙間 -->
    <div class="gap-control-probram"></div>
    <div class="gap-control-probram"></div>
    <div class="gap-control-probram"></div>
    <div class="gap-control-probram"></div>
    <div class="gap-control-probram"></div>

    <!-- タイトル -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <p class="font-style-title text-center">重要な役割</p>
                <hr class="border-line">
            </div>
        </div>
    </div>

    <!-- 括弧ワード（ボルドー） -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <p class="font-style-words text-center">「熟練エンジニアの需要」</p>
            </div>
        </div>
    </div>

    <!-- 隙間 -->
    <div class="gap-control-probram"></div>
    <div class="gap-control-probram"></div>

    <!-- コメント -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <p class="font-style-comments text-center">豊富な経験が求められる時代に</p>
            </div>
        </div>
    </div>

    <!-- 隙間 -->
    <div class="gap-control-probram"></div>
    <div class="gap-control-probram"></div>
    <div class="gap-control-probram"></div>
    <div class="gap-control-probram"></div>

    <!-- 写真・コメント -->
    <div class="wrapper">
        <section class="case">
            <article class="case__list">
              <div class="case__item">
                <p class="case__item__text">私たちは、技術者派遣に受託及びチーム派遣も含め、<br>企業の社員負担の大幅削減させ、
                一丸となってソフト<br>ウェア開発業務に専念できるような環境をつくり社会<br>に貢献し続けることを志し、
                その同志と共に歩んできま<br>した。</p>
                <img class="case__item__img" src="img/blank.png" alt="画像1">
              </div>
              <div class="case__item">
                <p class="case__item__text">労働力人口の減少の中で技術者不足は市場全体の課題<br>です。エンジニアが働き続けられる環境の現実を
                重要<br>ミッションの一つと捉えています。熟練を求められる<br>技術職種において、20年以上の経験を有するエンジニ<br>アの最重要課題。
                特にハードウェア分野における豊富<br>な経験を持つエンジニアの活用度が高く、時には技術<br>伝承における重要な役割を担っています。<br><br>
                ライフイベントを機に職を離れざるを得なかったエン<br>ジニアの、ブランクからの復帰や
                時短勤務のニーズに<br>応えることで、貴重なスキルを活かしながら生産性高<br>く活躍されています。</p>
                <img class="case__item__img" src="img/sample1.png" alt="画像2">
              </div>
            </article>
          </section>
        </div>


    <!-- 隙間 -->
    <div class="gap-control-probram"></div>
    <div class="gap-control-probram"></div>
    <div class="gap-control-probram"></div>
    <div class="gap-control-probram"></div>
    <div class="gap-control-probram"></div>

    <!-- タイトル -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <p class="font-style-title text-center">職場の事例</p>
                <hr class="border-line">
            </div>
        </div>
    </div>

    <!--  -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <p class="font-style-words text-center">「実際の業務内容」</p>
            </div>
        </div>
    </div>

    <!-- 隙間 -->
    <div class="gap-control-probram"></div>
    <div class="gap-control-probram"></div>

    <!-- コメント -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <p class="font-style-comments text-center">探していた環境と案件があります</p>
            </div>
        </div>
    </div>

    <!-- 隙間 -->
    <div class="gap-control-probram"></div>
    <div class="gap-control-probram"></div>

    <!-- コメント -->
    <div class="container-fluid">
        <div class="row">
            <div class="wrapper">
                <p class="font-style-comments2 txt">エンジニアのスキルにあった現場や受託業務で活躍しています。
                    相談も連携も取り易い環境に加え、<br>業務後に帰社しコミュニケーションやPJに携わっている
                    社員もおります。自分の求める環境で仕<br>事とプライベートと両立できます。
                    先ずは、実際の業務内容をご紹介いたします。
                </p>
            </div>
        </div>
    </div>

    <!-- 隙間 -->
    <div class="gap-control-probram"></div>
    <div class="gap-control-probram"></div>
    <div class="gap-control-probram"></div>
    <div class="gap-control-probram"></div>
    <div class="gap-control-probram"></div>


    <!-- 業務内容（アプリ開発） -->
    <div>
        <p class="font-bordeaux text-center">分野</p>
    </div>
    <div class="cercle">アプリ開発</div>
    <!-- 隙間 -->
    <div class="gap-control-probram"></div>
    <div class="gap-control-probram"></div>

    <div class="flex-title">
        <div>案件概要</div>
        <div>技術要素</div>
    </div>

    <div class="flex">
        <div>リスク管理システムパッケージ新規開発</div>
        <div>Java<br>GWT<br>Hibernate<br>Jasper Studio<br>JP1<br>SQL Server<br><br></div>
    </div>

    <div class="flex">
        <div>与信管理システム保守開発（クレジット会社向け）</div>
        <div>Java<br>SQL<br>JP1<br>Oracle<br><br></div>
    </div>

    <div class="flex">
        <div>給与計算システム（メーカー向け）</div>
        <div>C<br>SHELL<br>PL<br>SQL<br>Oracle<br><br></div>
    </div>


    <!-- 隙間 -->
    <div class="gap-control-probram"></div>
    <div class="gap-control-probram"></div>
    <div class="gap-control-probram"></div>

    <!-- 業務内容（インフラエンジニア） -->
    <div>
        <p class="font-bordeaux text-center">分野</p>
    </div>
    <div class="cercle">インフラエンジニア</div>
    <!-- 隙間 -->
    <div class="gap-control-probram"></div>
    <div class="gap-control-probram"></div>

    <div class="flex-title">
        <div>案件概要</div>
        <div>技術要素</div>
    </div>

    <div class="flex">
        <div>オンプレLinuxサーバ（RHEL）からクラウド移行に伴う基盤移行<br>及びOS、ミドルウェアバージョンアップ</div>
        <div>IBM MQ<br>IBM Tivoli Monitoring<br>Netbackup<br>NetWorker<br>VMware vSphere<br><br></div>
    </div>

    <div class="flex">
        <div>物理SolarisサーバからLinuxサーバ（RHEL）への移行<br>及びミドルウェアバージョンアップ</div>
        <div>NetWorker<br>IBM MQ<br>IBM Tivoli Monitoring<br>Oracle<br>Systemwalker<br>Storabe Cruiser<br>ServerView<br><br></div>
    </div>

    <div class="flex">
        <div>保険システムにおける基盤構築支援</div>
        <div>Lotus Notes<br>TeraTerm<br>Db2V10.1<br>WebSphereApplicationServerV8.5<br>SVF for PD<br><br></div>
    </div>

    <!-- 隙間 -->
    <div class="gap-control-probram"></div>
    <div class="gap-control-probram"></div>
    <div class="gap-control-probram"></div>

    <div class="entry">
        <P class="font-style-comments entry-space">まずはあなたのキャリアプランを聞かせてください。</P>
        <button onclick="location.href='#!'" class="entry-button">　エントリー</button>
        <p class="entry-red">入社からプロジェクト着任までのフローが知りたい方はこちら ></p>
    </div>
    <div class="flex-link">
        <img class="link-img" src="img/グループ 1824.png">
        <img class="link-img" src="img/グループ 1826.png">
    </div>
    <div class="flex-link">
        <img class="link-img" src="img/グループ 1827.png">
        <img class="link-img" src="img/グループ 1828.png">
    </div>
    <img class="instagram" src="img/グループ 1098.png" alt="画像">
    <div class="flex-link">
        <img class="silver" src="img/長方形 54.png" alt="画像">
        <img class="silver" src="img/長方形 54.png" alt="画像">
        <img class="silver" src="img/長方形 54.png" alt="画像">
    </div>
    <div class="flex-link">
        <img class="silver" src="img/長方形 54.png" alt="画像">
        <img class="silver" src="img/長方形 54.png" alt="画像">
        <img class="silver" src="img/長方形 54.png" alt="画像">
    </div>
    <p class="look">もっと見る</p>
    </div>
    <!-- footer -->
    <footer class="footer">
        <small>&copy; 1997,2023 mistsolution.All Rights Reserved.</small>
    </footer>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="js/header.js"></script>
</body>

</html>