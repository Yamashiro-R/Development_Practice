<?php
    include '../includes/login.php';
    include '../includes/function.php';

    //Input_Form編集中に飛んだらreferenceを破棄させて新規にさせる。
    //元々を編集するときは保存済みデータから編集させる!!
    if(isset(($_SESSION['reference']))){
        unset($_SESSION['reference']);
    }

    $_SESSION['ps_val'] = null;
    $_SESSION['page_dvs'] = null;
    $_SESSION['reference'] = null;
    $_SESSION['reference_edit'] = null;
    $_SESSION['Input_3'] = null;
    $_SESSION['back_page'] = null;

    $dsn = 'mysql:host=192.168.1.171;dbname=job_hunt_manage;charset=utf8';
    $user = 'user';
    $password = 'test';
    $status_num = false;

    $num = 10;
    $status = ["未申請"=>"1","申請中"=>"2","承認済"=>"3","却下"=>"4"];

    $notice_shou = 0;
    $notice_kyakka = 0;

    if(isset($_GET['page'])){
        $page = $_GET['page'];
        $_SESSION['page_dv'] = $_GET['page']; 
        header('Location: dataView.php#table_erea');
    }else if(isset($_SESSION['page_dv'])){
        $page = $_SESSION['page_dv'];
    } else{
        $page = 1;
    }

    if(empty($_POST['ap_status']) && isset($_SESSION['ap_status'])){
        $_POST['ap_status'] = $_SESSION['ap_status'];
    }
    if(isset($_POST['ap_status'])){

        if($_POST['ap_status'] == "全データ"){
            $status_num = false;
        }else{
            $status_num = $status[$_POST['ap_status']];
        }
        
        $_SESSION['ap_status'] = $_POST['ap_status'];


    }else{
        $status_num = false;
    }
        

    $param_p = json_encode($status_num);


    try{
        $db = new PDO($dsn, $user, $password);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        //プリペアドステートメントを作成

        $select = "SELECT * FROM ac_comp_data_tb join apply_status_tb
                            on ac_comp_data_tb.as_number = apply_status_tb.as_number
                            where act_id = :ID";
        if($status_num){
            $select .= " and ac_comp_data_tb.as_number = ". $status_num;
        }

        $select .= " ORDER by application_Date DESC LIMIT :page,:num;";

        $stmt = $db->prepare($select);

        //パラメータ割り当て 
        $stmt->bindParam(':ID', $_SESSION['ID'], PDO::PARAM_STR);
        $limit = ($page-1) * $num;
        $stmt->bindParam(':page', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':num', $num, PDO::PARAM_INT);

        //クエリの実行
        $stmt->execute();

        // print_r($row = $stmt->fetchAll());
        $row = $stmt->fetchAll();

        $confirmation =  array_column($row,'confirmation');
        $as_number = array_column($row,'as_number');

        for($i = 0; $i < count($row); $i++){
    
            if($confirmation[$i] == false && $as_number[$i] == 3){
                $notice_shou++;
            }
        }
        for($i = 0; $i < count($row); $i++){
            if($confirmation[$i] == 0 && $as_number[$i] == 4){
                $notice_kyakka++;
            }
        }


    }catch (PDOException $e) {
        exit('エラー：' . $e->getMessage());
    }


    try{
        $stmt = $db->prepare("SELECT * FROM ac_comp_data_tb,apply_status_tb
                            Where ac_comp_data_tb.as_number = apply_status_tb.as_number
                            and act_id = :ID
                            ORDER by application_Date ");
    
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
            <link rel="stylesheet" href="../cssfiles/style.css">
            <link rel="stylesheet" href="cssfiles/style_dv_dvS.css">
            <title>保存データ一覧</title>
        </head>
        <?php include 'header.php' ?>

        <body class="view_back-color">
                <div class="return">
                    <a href="home.php"><img src="../images/innu.jpeg"></a>
                </div>
            <div>
                <div id="main_title"> 
                    <h1>保存データ一覧</h1>
                </div>
                <div>
                    <form id="dv_search" action="dataView.php#table_erea" method="POST">
                        <label><input  type="submit" name="ap_status" value="全データ" hidden><span class="input-hover" id="dv_s_inp">全データ</span></label>
                        <label><input  type="submit" name="ap_status" value="未申請" hidden><span class="input-hover" id="dv_s_inp1">未申請</span></label>
                        <label><input  type="submit" name="ap_status" value="申請中" hidden><span class="input-hover" id="dv_s_inp2">申請中</span></label>
                        <br class="br-sp">
                        <label><input  type="submit" name="ap_status" value="承認済" hidden><span class="input-hover" id="dv_s_inp3">承認済
                            <?PHP 
                                if($notice_shou > 0){
                                    echo '<span class="bic">!</span>';
                                }
                            ?>
                        </span></label>
                        <label><input  type="submit" name="ap_status" value="却下" hidden><span class="input-hover" id="dv_s_inp4">却下
                            <?PHP 
                                if($notice_kyakka > 0){
                                    echo '<span class="bic">!</span>';
                                }
                            ?>
                        </span></label>
                    </form>
                    <table class="dvtable" id="table_erea">
                        <thead>
                            <tr>
                                <th scope="col">申請日</th>
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
                    <?php create_btn_chg($page,$records) ?>   
                </div>

            </div>

        </body>
        <script>
            var  param_j = JSON.parse('<?php echo $param_p; ?>') ;
            ap_status_check(param_j);

            function ap_status_check(status){

                if(status){
                    var idName = "dv_s_inp"+ status;
                    document.getElementById(idName).style.fontSize= '40px';                    
                    document.getElementById(idName).style.color = 'blue';                    
                    document.getElementById(idName).style.fontWeight = 'bolder';                    
                    document.getElementById(idName).style.backgroundColor = 'rgb(27, 255, 130)';

                }else{
                    document.getElementById('dv_s_inp').style.fontSize = '40px';
                    document.getElementById('dv_s_inp').style.color = 'blue';
                    document.getElementById('dv_s_inp').style.fontWeight = 'bolder';
                    document.getElementById('dv_s_inp').style.backgroundColor = 'rgb(27, 255, 130)';
                }
            }

        </script>
        <script type="text/javascript" src="\DEVELOPMENT_PRACTICE/JS_files/methot.js"></script>
    </html>

</html>