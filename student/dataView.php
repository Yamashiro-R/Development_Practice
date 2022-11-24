<?php
    include 'includes/login.php';
    include 'function.php';

    $dsn = 'mysql:host=192.168.1.171;dbname=job_hunt_manage;charset=utf8';
    $user = 'user';
    $password = 'test';

    $num = 5;
    if(isset($_GET['page'])){
        $page = $_GET['page'];
        $_SESSION['page'] = $_GET['page']; 
        header('Location: dvSearch.php#table_erea');
    }else if(isset($_SESSION['page'])){
        $page = $_SESSION['page'];
    } else{
        $page = 1;
    }

    try{
        $db = new PDO($dsn, $user, $password);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        //プリペアドステートメントを作成
        $stmt = $db->prepare("SELECT * FROM ac_comp_data_tb join apply_status_tb
                            on ac_comp_data_tb.as_number = apply_status_tb.as_number

                             where act_id = :ID
                             ORDER by modified 
                             LIMIT :page,:num ");
        
        //パラメータ割り当て
        $stmt->bindParam(':ID', $_SESSION['ID'], PDO::PARAM_STR);
        $limit = ($page-1) * $num;
        $stmt->bindParam(':page', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':num', $num, PDO::PARAM_INT);

        //クエリの実行
        $stmt->execute();

        // print_r($row = $stmt->fetchAll());
        $row = $stmt->fetchAll();

    }catch (PDOException $e) {
        exit('エラー：' . $e->getMessage());
    }


    try{
        $stmt = $db->prepare("SELECT * FROM ac_comp_data_tb join apply_status_tb
                            on ac_comp_data_tb.as_number = apply_status_tb.as_number
                             where act_id = :ID
                             ORDER by modified ");
    
        //パラメータ割り当て
        $stmt->bindParam(':ID', $_SESSION['ID'], PDO::PARAM_STR);

        $stmt->execute();


       $data = $stmt->fetchAll();
       $records = count($data);

   }catch (PDOException $e){
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
        <body class="view_back-color">
            <div>
                <div class="return">
                    <a href="./home_2.php"><img class="return" src="images/innu.jpeg"></a>
                </div>
                <div id="main_title"> 
                    <h1>データ一覧</h1>
                </div>
                <div>
                    <table class="dvtable" id="table_erea">
                        <thead>
                            <tr>
                                <th scope="col">最終<br class="br-sp">更新日</th>
                                <th scope="col">企業名</th>
                                <th scope="col">所在地</th>
                                <th scope="col">職種</th>
                                <th scope="col">詳細<br class="br-sp">閲覧</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php create_tbody($row,'save');?>
                        </tbody>
                    </table>
                </div>

                <div class="change_save">
                    <?php create_btn_chg($page,$records,'save') ?>   
                </div>

            </div>

        </body>
    
    </html>

</html>