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
                                WHERE ac_comp_data_tb.act_id = account_tb.act_id and ac_comp_data_tb.as_number = 2
                                ORDER by application_Date");
        
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
            <link rel="stylesheet" href="../cssfiles/style.css">
            <link rel="stylesheet" href="cssfiles/teach_request.css">
            <!-- <link rel="stylesheet" href="cssfiles/style_flexible.css"> -->
            <title>就職活動報告申請依頼</title>   
        </head>
        <?php include 'header.php' ?>

        <div class="return">    <!-- 犬の画像用戻るボタン -->
            <a href="home_2.php"><img src="../images/innu.jpeg"></a>
        </div>

        <body class="body">
            <div>
                <div id="main_title"> 
                    <h1>就職活動報告<br>申請依頼</h1>
                </div>
                <div class="title_req">
                    <h3 id="newreq-title" style="color: red;">新規依頼</h3>
                    <p id="now-req">現在<strong style="color: red;"><?php echo count($row) ?>件</strong>の依頼が来ています。</p>
                </div>
                <div class="test">
                    <?php teach_func($row) ?>
                </div>
        </body>
        <script type="text/javascript" src="\DEVELOPMENT_PRACTICE/JS_files/methot.js"></script>
    </html>


</html>