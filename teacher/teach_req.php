<?php
    include '../includes/login.php';
    include '../includes/function.php';


    $dsn = 'mysql:host=192.168.1.171;dbname=job_hunt_manage;charset=utf8';
    $user = 'user';
    $password = 'test';

    try{
        $db = new PDO($dsn, $user, $password);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        //プリペアドステートメントを作成
        $stmt = $db->prepare("SELECT * FROM ac_comp_data_tb,account_tb
                                WHERE ac_comp_data_tb.act_id = account_tb.act_id and ac_comp_data_tb.as_number = 2");
        
        //クエリの実行
        $stmt->execute();
        $row = $stmt->fetchAll();

    }catch (PDOException $e) {
        exit('エラー：' . $e->getMessage());
    }

?>


<!DOCTYPE html>
    <html lang="ja">
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="\DEVELOPMENT_PRACTICE/cssfiles/style.css">
            <link rel="stylesheet" href="cssfiles/teach_request.css">
            <!-- <link rel="stylesheet" href="cssfiles/style_flexible.css"> -->
            <title>新規依頼画面</title>   
        </head>
        <header class="site-header">
            <div class="wrapper site-header__wrapper">
                <div class="site-header__start">
                    <p class="brand">就職活動管理Webアプリ</p>
                </div>
                <div class="site-header__middle">
                    <nav class="nav">
                    <button class="nav__toggle" aria-expanded="false" type="button">
                    menu
                    </button>
                    <ul class="nav__wrapper">
                        <li class="nav__item" title="ID:1224">👤情報太郎</li>
                        <li class="nav__item">
                            <div class="dropdown">
                                <input id="tg" class="dropInput" type="checkbox">
                                <label for="tg" class="dropLabel">PageList▼</label>
                                <ul class="menu animation">
                                    <li><a class="item" href="#">ホーム</a></li>
                                    <li><a class="item" href="#">閲覧検索</a></li>
                                    <li><a class="item" href="#">報告書新規作成</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                    </nav>
                </div>
                <div class="site-header__end">
                    <a class="out-button" href="#">ログアウト</a>
                </div>
                <div class="hamburger-menu" >
                    <input type="checkbox" id="menu-btn-check">
                    <label for="menu-btn-check" class="menu-btn"><span></span></label>
                    <div class="menu-content">
                        <ul>
                            <li>
                                <a href="#">ホーム</a>
                            </li>
                            <li>
                                <a href="#">閲覧検索</a>
                            </li>
                            <li>
                                <a href="#">報告書新規作成</a>
                            </li>
                            <li>
                                <a href="#">ログアウト</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <body class="body">
            <div>
                <div id="main_title"> 
                    <h1>就職活動報告</h1>
                </div>
                <div class="title_req">
                    <h3 id="newreq-title" style="color: red;">新規依頼</h3>
                    <p id="now-req">現在<strong style="color: blue;"><?php echo count($row) ?>件</strong>の依頼が来ています。</p>
                </div>
                <div class="test">
                    <?php teach_func($row) ?>
                </div>
        </body>
        <script type="text/javascript" src="\DEVELOPMENT_PRACTICE/JS_files/methot.js"></script>
    </html>


</html>