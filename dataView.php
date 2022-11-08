<?php
    include 'includes/login.php';
    include 'function.php';

    $dsn = 'mysql:host=localhost;dbname=job_hunt_manage;charset=utf8';
    $user = 'root';
    $password = '';

    try{
        $db = new PDO($dsn, $user, $password);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        //プリペアドステートメントを作成
        $stmt = $db->prepare("SELECT * FROM ac_comp_data_tb join apply_status_tb
                            on ac_comp_data_tb.as_number = apply_status_tb.as_number
                            where act_id = :ID");
        
        //パラメータ割り当て
        $stmt->bindParam(':ID', $_SESSION['ID'], PDO::PARAM_STR);
        //クエリの実行
        $stmt->execute();

        // print_r($row = $stmt->fetchAll());
        $row = $stmt->fetchAll();

    }catch (PDOException $e) {
        exit('エラー：' . $e->getMessage());
    }


    

?>

<!DOCTYPE html>
    <html lang="ja">
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="cssfiles/style.css">
            <link rel="stylesheet" href="cssfiles/style_dv_dvS.css">
            <title>データ一覧</title>
        </head>
        <body>
            <div>
                <div class="return">
                    <a href="./houkoku.php"><img class="return" src="images/innu.jpeg"></a>
                </div>
                <div id="main_title"> 
                    <h1>データ一覧</h1>
                </div>
                <div>
                    <table class="dvtable">
                        <thead>
                            <tr>
                                <th scope="col">最終<br class="br-sp">更新日</th>
                                <th scope="col">企業名</th>
                                <th scope="col">所在地</th>
                                <th scope="col">職種</th>
                                <th scope="col">申請<br class="br-sp">状況</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php create_tbody($row);?>
                        </tbody>
                    </table>
                </div>

                <div class="change">
                        <button onclick="location.href='#!'">← 前</button><!-- <span class="dvspan">1</span>-->  <button onclick="location.href='#!'">次 →</button>
                </div>

            </div>

        </body>
    
    </html>

</html>