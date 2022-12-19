<?php
    include '../includes/login.php';
    include '../includes/function.php';


    $_SESSION['reference_edit'] = null;
    $_SESSION['back_page'] = null;

    if(isset($_POST['no'])){
        $reference_number = $_POST['no'];
        $_SESSION['s_no'] = $_POST['no'];
    }else if(isset($_SESSION['s_no'])){
        $reference_number = $_SESSION['s_no'];
    }else{
        header('Location: dataView.php');
        exit();
    }

    if(isset($_POST['CONFIRM'])){
        if($_POST['CONFIRM'] == 1){
            delete_data($reference_number);
        }
    }

    if(isset($_POST['REQUEST'])){
        if($_POST['REQUEST'] == 1 || $_POST['REQUEST'] == 4){
            request_data($reference_number);
        }
    }


    if(isset($_POST['EDIT'])){
        $_SESSION['reference_edit'] = $reference_number;
        $_SESSION['back_page'] = 'save';
        header('Location: edit_Form_1.php');
    }


    $dsn = 'mysql:host=192.168.1.171;dbname=job_hunt_manage;charset=utf8';
    $user = 'user';
    $password = 'test';

    try{
        $db = new PDO($dsn, $user, $password);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        //プリペアドステートメントを作成
        $stmt_ac_comp = $db->prepare("SELECT * FROM ac_comp_data_tb,apply_status_tb,account_tb,family_name_tb
                             where ac_comp_data_tb.act_id = :ID and 
                             ac_comp_data_tb.as_number = apply_status_tb.as_number and
                             ac_comp_data_tb.act_id = account_tb.act_id and
                             account_tb.fn_number = family_name_tb.fn_number and
                            reference_number = $reference_number");

        $stmt_day = $db->prepare("SELECT * FROM tests_tb
                                 where reference_number = :num1
                                 ORDER BY td_status,date_data");

        $stmt_detalis = $db->prepare("SELECT * FROM test_details_tb,select_process_tb
                                where test_details_tb.sp_number = select_process_tb.sp_number and
                                reference_number = :num2
                                ORDER BY td_status");

//パラメータ割り当て
        $stmt_ac_comp->bindParam(':ID', $_SESSION['ID'], PDO::PARAM_STR);
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
        $status = $row['as_number'];
        $as_name = $row['apply_status'];
        $remarks = $row['remarks'];

        $confirmation =  $row['confirmation'];



        $param_p = json_encode($status);


    }catch (PDOException $e) {
        exit('エラー：' . $e->getMessage());
    }


    if($confirmation == false && ($status == 3 || $status == 4)){
        $db = new PDO($dsn, $user, $password);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        $stmt = $db->prepare("UPDATE ac_comp_data_tb SET confirmation = 1 WHERE reference_number = :num");
        $stmt->bindParam(':num', $reference_number, PDO::PARAM_STR);
        $stmt->execute();

    }

?>






<!DOCTYPE html>
    <html lang="ja">
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="../cssfiles/style.css">
            <link rel="stylesheet" href="cssfiles/style_svdata.css">
            <title>保存データ</title>
        </head>
        <?php include 'header.php' ?>

        <body>
            <div class="return">    <!-- 犬の画像用戻るボタン -->
                <a href="dataView.php#table_erea"><img src="../images/innu.jpeg"></a>
            </div>
            <div id="main_title">   <!-- 共通のタイトル部分 -->
                <h1>就職活動<br class="br-sp">保存データ</h1>
            </div>
            <div class="big-div">
                <div class="div-info">
                    <div class="divdiv">
                        <p class="p-info">科名：</p><p class="p-view"><?php check_null($family_name) ?></p>
                    </div>
                    <div class="divdiv">
                        <p class="p-info">氏名：</p><p class="p-view"><?php check_null( $account_name) ?></p>
                    </div>
                    <div class="divdiv">
                        <p class="p-info">番号：</p><p class="p-view"><?php check_null( $attend_number) ?></p>
                    </div>
                    <div class="divdiv">
                        <p class="p-info">応募方法：</p><p class="p-view"><?php check_null(change_format($how_to_apply))?></p>
                    </div>
                    <div class="divdiv">
                        <p class="p-info">書類選考：</p><p class="p-view"><?php check_null( $docmt_screening) ?></p>
                    </div>
                    <div class="divdiv">
                        <p class="p-info">応募件数：</p><p class="p-view"><?php check_null( $no_appli) ?> </p>
                    </div>
                    <div class="divdiv">
                        <p class="p-info">応募先企業：</p><p class="p-view"><?php check_null( $comp_name )?></p>
                    </div>
                    <div class="divdiv">
                        <p class="p-info" title="<?php check_null($comp_address)?>">応募先住所：</p><p class="p-view" title="<?php check_null($comp_address)?>"><?php address_check( $comp_address)  ?></p>
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
                            <p class="p-info">感想、反省点：</p><p class="p-view" id="imp"><?php check_null( $impressions )?></p>
                        </div>
                    </div>
                    <div class="test">
                        <div>
                            <p class="p-info">今後の活動予定：</p><p class="p-view" id="fut"><?php check_null( $future_activities) ?></p>
                        </div>
                    </div>
                    <div class="test">
                        <div>
                            <p class="p-info">備考：</p><p class="p-view"><?php check_null($remarks) ?></p>
                        </div>
                    </div>
                </div>

                <p class="as_status">申請状況：<strong><span><?php check_null($as_name) ?></span></strong></p>

                <div class="button_d">
                    <form method="POST" action="savedata.php" onsubmit="delete_btn();">
                        <input type="submit" class="button-delete" value="削除" id="delete">
                        <input type="hidden" name="CONFIRM" value="" >
                    </form>

                    <form action="savedata.php" method="POST">
                        <input type="submit" name="EDIT" value="編集" id="edit">
                    </form>
                </div>
                <div class="button_d">
                    <form method="POST" action="" onsubmit="request_btn();" >
                        <input type="submit" value="申請" id="request" disabled>
                        <input type="hidden" name="REQUEST" value="" >
                    </form>
                </div>
                <div class="page-top">
                    <a href="#"><img class="pg-top" src="../images/pagetop 1.png" alt="page-top"></a>
                </div>
            </div>



            <script type="text/javascript">
            function delete_btn(){
                if(confirm("本当に削除してもよろしいですか？")){
                document.forms[0].CONFIRM.value=1;//ＯＫの場合
                }else{
                document.forms[0].CONFIRM.value=0;//キャンセルの場合
                }
            }

            function request_btn(){
                if(confirm("本当に申請してもよろしいですか？")){
                    document.forms[2].REQUEST.value=1;//ＯＫの場合
                    alert("申請しました。")
                }else{
                    document.forms[2].REQUEST.value=0;//キャンセルの場合
                    alert("申請をキャンセルしました。")
                }
            }



            var  param_j = JSON.parse('<?php echo $param_p; ?>') ;

            if(param_j == 2 || param_j == 3){
                document.getElementById('delete').style.display = 'none';
                document.getElementById('edit').style.display = 'none';
                document.getElementById('request').style.display = 'none';
            }


            var hantei1 = document.getElementById('imp').textContent;
            var hantei2 = document.getElementById('fut').textContent;
                if(!(hantei1 == '無回答' || hantei2 == "無回答")){
                    document.getElementById('request').disabled = false;        
                }
        </script>
        <script type="text/javascript" src="\DEVELOPMENT_PRACTICE/JS_files/methot.js"></script>

        </body>
    </html>


</html>