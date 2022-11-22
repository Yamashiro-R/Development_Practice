<?php
    include 'includes/login.php';
    include 'function.php';

    $reference_number = $_POST['no'];

    $dsn = 'mysql:host=192.168.2.136;dbname=job_hunt_manage;charset=utf8';
    $user = 'user';
    $password = 'test';

    try{
        $db = new PDO($dsn, $user, $password);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        //プリペアドステートメントを作成
        $stmt_ac_comp = $db->prepare("SELECT * FROM ac_comp_data_tb,apply_status_tb,account_tb,family_name_tb
                             where  ac_comp_data_tb.as_number = apply_status_tb.as_number and
                             ac_comp_data_tb.act_id = account_tb.act_id and
                             account_tb.fn_number = family_name_tb.fn_number and
                             ac_comp_data_tb.reference_number = :ref_num");
                             

        $stmt_day = $db->prepare("SELECT * FROM tests_tb
                                 where reference_number = :num1
                                 ORDER BY td_status,date_data");

        $stmt_detalis = $db->prepare("SELECT * FROM test_detalis_tb,select_process_tb
                                where test_detalis_tb.sp_number = select_process_tb.sp_number and
                                reference_number = :num2
                                ORDER BY td_status");

//パラメータ割り当て
        $stmt_ac_comp->bindParam(':ref_num',$reference_number, PDO::PARAM_STR);
        $stmt_day->bindParam(':num1',$reference_number, PDO::PARAM_STR);
        $stmt_detalis->bindParam(':num2',$reference_number, PDO::PARAM_STR);
        //クエリの実行
        $stmt_ac_comp->execute();
        $stmt_day->execute();
        $stmt_detalis->execute();

        $row = $stmt_ac_comp->fetch();
        $row_day = $stmt_day->fetchAll();
        $row_detalis = $stmt_detalis->fetchAll();
        //データの切り分け
        //  print_r($row_detalis);
        $family_name = $row['family_name']; //科名
        $account_name = $_SESSION['name']; //アカウント名
        $attend_number = attend_number($row['act_id']); //出席番号
        $no_appli = $row['no_appli']; //応募件数
        $how_to_apply = $row['how_to_apply']; //応募方法
        $docmt_screening = $row['docmt_screening']; //書類選考
        $comp_name = $row['comp_name']; //企業名
        $comp_address = $row['comp_address']; //企業所在地
        $docmt_submit = $row['docmt_submit']; //提出書類
        $job = $row['job']; //職種
        $person_charge_name = $row['person_charge_name']; //担当者名
        $impressions =$row['impressions'];
        $future_activities = $row['future_activities'];


    }catch (PDOException $e) {
        exit('エラー：' . $e->getMessage());
    }

?>

<!DOCTYPE html>
    <html lang="ja">
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="cssfiles/style.css">
            <link rel="stylesheet" href="cssfiles/style_pastdata.css">
            <title>就職活動過去データ</title>
        </head>
        <body>
            <div class="return">    <!-- 犬の画像用戻るボタン -->
                <a href="dvSearch.php"><img src="images/innu.jpeg"></a>
            </div>
            <div id="main_title">   <!-- 共通のタイトル部分 -->
                <h1>就職活動<br class="br-sp">過去データ</h1>
            </div>
            <div class="big-div">
                <div class="div-info">
                    <div class="divdiv">
                        <p class="p-info">科名：</p><p class="p-view"><?php check_null($family_name) ?></p>
                    </div>
                    <div class="divdiv">
                        <p class="p-info">応募方法：</p><p class="p-view"><?php check_null(change_format($how_to_apply))?></p>
                    </div>
                    <div class="divdiv">
                        <p class="p-info">書類選考：</p><p class="p-view"><?php check_null( $docmt_screening) ?></p>
                    </div>
                    <div class="divdiv">
                        <p class="p-info">応募先企業：</p><p class="p-view"><?php check_null( $comp_name )?></p>
                    </div>
                    <div class="divdiv">
                        <p class="p-info">企業所在地：</p><p class="p-view"><?php address_check( $comp_address) ?></p>
                    </div>
                    <div class="divdiv">
                        <p class="p-info">提出書類：</p><p class="p-view"><?php check_null(change_format($docmt_submit))?></p>
                    </div>
                    <div class="divdiv">
                        <p class="p-info">職種：</p><p class="p-view"><?php check_null( $job )?></p>
                    </div>
                    <div class="divdiv">
                        <p class="p-info">担当者名：</p><p class="p-view"><?php check_null( $person_charge_name) ?></p>
                    </div>
                </div>
                <div class="div-detail">
                    <?php print_data($row_day,$row_detalis) ?>
                    
                    <div class="test">
                        <div>
                            <p class="p-info">感想、反省点：</p><p class="p-view">表示</p>
                        </div>
                    </div>
                    <div class="test">
                        <div>
                            <p class="p-info">今後の活動予定：</p><p class="p-view">表示</p>
                        </div>
                    </div>
                </div>
                <div class="page-top">
                    <a href="#"><img src="images/pagetop 1.png" alt="page-top"></a>
                </div>
            </div>

        </body>
    
    </html>


</html>