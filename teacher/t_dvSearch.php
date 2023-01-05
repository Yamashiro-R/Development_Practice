<?php
    include '../includes/login.php';
    include '../includes/function.php';


    $dsn = 'mysql:host=192.168.1.171;dbname=job_hunt_manage;charset=utf8';
    $user = 'user';
    $password = 'test';

    $num = 10;
    $option_st = array(4);
    for ($i = 0; $i < 4; $i++) {
        $option_st[$i] = "";
    }
    
    $option_docmt = array(5);
    for ($i = 0; $i < 5; $i++) {
        $option_docmt[$i] = "";
    }

    
    if(isset($_GET['page'])){
        $page = $_GET['page'];
        $_SESSION['page'] = $_GET['page']; 
        header('Location: t_dvSearch.php#table_erea');
    }else if(isset($_SESSION['page']) != 0){
        $page = $_SESSION['page'];
    } else{
        $page = 1;
    }
    
    if(isset($_POST['reset'])){
        unset($_SESSION['ps_val']);
        $_POST = null;
        $page = 1;

        header('Location: t_dvSearch.php#dvS_contentu');
    }


    //検索が押されたかの判定と処理
    if($_POST){
        if(!isset($_POST['reset'])) {

            $comp_name = $_POST['comp_name'];
            $student_name = $_POST['student_name'];
            $status = $_POST['status'];
            $student_id = $_POST['student_id'];
            $docmt = $_POST['docmt'];
            $year = $_POST['year'];
            $fn_number = $_POST['gakka'];


            $_SESSION['ps_val'] = $_POST;
            $page = 1;
            $_SESSION['page'] = $page;
            $boole = true;

        }
    }else if(!$_POST && (isset($_SESSION['ps_val']))){
        $_POST = $_SESSION['ps_val'];

        $comp_name = $_POST['comp_name'];
        $student_name = $_POST['student_name'];
        $status = $_POST['status'];
        $student_id = $_POST['student_id'];
        $docmt = $_POST['docmt'];
        $year = $_POST['year'];
        $fn_number = $_POST['gakka'];


        $boole = true;
    } else{
        $comp_name = false;
        $student_name = false;
        $status = false;
        $student_id = false;
        $docmt = false;
        $year = false;
        $fn_number = false;



        $boole = false;
    }



    $select = 'SELECT * FROM ac_comp_data_tb,apply_status_tb,account_tb 
                where ac_comp_data_tb.as_number = apply_status_tb.as_number and
                ac_comp_data_tb.act_id = account_tb.act_id';

    if($comp_name){
        $select .=  " and comp_name LIKE '%". $comp_name . "%'" ; 
    }

    if($student_name){
        $select .=  " and  account_name LIKE '%". $student_name . "%'" ; 
    }

    if($fn_number){
        if($fn_number != 'defa'){
            $select .=  " and fn_number = ". $fn_number; 
        }else {
            $fn_number = false;
        }
    }

    if($status){
        if($status != 5){
            $select .=  " and apply_status_tb.as_number = ". $status; 
        }
    }


    if($student_id){
        $select .=  " and account_tb.act_id = ". $student_id; 
    }

    if($year){
        if($year != 'defa'){
        $select .=  " and account_tb.act_id Like '__". $year % 1000 ."__'"; 
        }
    }

    if($docmt){
        if($docmt != 6 ){
            $docmts = array("本校の紹介","職安の紹介","縁故者の紹介","求人情報誌","その他");
            $select .=  " and how_to_apply LIKE '%". $docmts[$docmt-1] . "%'" ; 
        }
    }


    $select_limit = $select; 
    $select_limit .= '  ORDER by application_Date DESC LIMIT :page , :num';


    try{
        $db = new PDO($dsn, $user, $password);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        //プリペアドステートメントを作成
        $stmt = $db->prepare("SELECT * FROM ac_comp_data_tb,apply_status_tb,account_tb 
                            where ac_comp_data_tb.as_number = apply_status_tb.as_number and
                            ac_comp_data_tb.act_id = account_tb.act_id
                            ORDER by application_Date DESC 
                            LIMIT :page,:num ");

        if($boole){
            $stmt = $db->prepare($select_limit);
        }
        
        

       
        //パラメータ割り当て
        $limit = ($page - 1) * $num;
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
         $stmt = $db->prepare("SELECT * FROM ac_comp_data_tb,apply_status_tb,account_tb 
                                where ac_comp_data_tb.as_number = apply_status_tb.as_number and
                                ac_comp_data_tb.act_id = account_tb.act_id
                                ORDER by application_Date DESC ");
        
        if($boole){
            $stmt = $db->prepare($select);
        }

    
        $stmt->execute();


        $data = $stmt->fetchAll();
        $records = count($data);

    }catch (PDOException $e){
        exit('エラー：' . $e->getMessage());
    }



    if($status){
        if($status != 5){
            $option_st[$status-1] = 'selected';
        }
    }

    if($docmt){
        if($docmt != 6){
            $option_docmt[$docmt-1] = 'selected';
        }
    }
?>

<!DOCTYPE html>
    <html lang="ja">
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="../cssfiles/style.css">
            <link rel="stylesheet" href="cssfiles/style_t_dv_dvS.css">
            <title>就職活動データ検索</title>
        </head>
        <?php include 'header.php' ?>
        
        <body class="serch_back-color">
            <div>
                <div class="return">
                    <a href="home_2.php"><img src="../images/innu.jpeg"></a>
                </div>
                <div id="main_title"> 
                    <h1>報告書📄<br class="br-sp">全データ検索</h1>
                </div>

                <div class="dvSearch">
                    <div class="dvS_title">
                        <h3>検索欄</h3>
                    </div>
                        <!-- <div class="dvStop">
                            <div class="dvSname"> -->
                    <form class="dvSform" action="t_dvSearch.php#table_erea" method="POST">
                        <div id="dvS_contentu" style="display: block;">
                            <div class="main_div">
                                <p class="p_input">
                                    <label>企業名<br><input type="search" name="comp_name" maxlength="15" value="<?php echo $comp_name ?>"></label>
                                </p>
                                <p class="p_input">
                                    <label>生徒名<br><input type="search" name="student_name" maxlength="15" value="<?php echo $student_name ?>"> </label>
                                </p>
                                <p class="p_input">
                                    <label>生徒ID<br><input type="search" name="student_id" maxlength="6" placeholder="6桁の数字で入力" pattern="^[0-9]+$" value="<?php echo $student_id ?>"> </label>
                                </p>
                                <p class="p_select">
                                    <label>学科名<br>
                                        <select name="gakka" class="pull-down">
                                            <option value="defa">全学科</option>
                                            <?php
                                                $gakka = array("造園ガーデニング科","電気システム科","自動車整備科","オフィスビジネス科","メディア・アート科","情報システム科","総合実務科");
                                                for($i = 0  ; $i < count($gakka); $i++){
                                                    echo '<option value="', $i + 1 ,'"';    
                                                    if($i + 1 == $fn_number){
                                                        echo 'selected';
                                                    }
                                                    echo '>', $gakka[$i] ,'</option>';
                                                }
                                            ?>
                                        </select>
                                    </label>
                                </p>
                                <p class="p_select">
                                    <label>入校年度(過去10年分)<br>
                                        <select name="year" class="pull-down">
                                            <option value="defa">全年度</option>
                                            <?php
                                                $j = 0;
                                                $y = date('Y');
                                                for($i = $y  ; $i > $y - 10; $i--,$j++){
                                                    echo '<option value="', $i ,'"';    
                                                    if($i == $year){
                                                        echo 'selected';
                                                    }
                                                    echo '>', $y - $j ,'年度</option>';
                                                }
                                            ?>
                                        </select>
                                    </label>
                                </p>
                                <p class="p_select">
                                    <label>申請状況<br>
                                        <select name="status" class="pull-down">
                                            <option value="5">全て</option>
                                            <option value="1" <?php echo $option_st[0] ?>>未申請</option>
                                            <option value="2" <?php echo $option_st[1] ?>>申請中</option>
                                            <option value="3" <?php echo $option_st[2] ?>>承認済</option>
                                            <option value="4" <?php echo $option_st[3] ?>>却下</option>
                                        </select>
                                    </label>
                                </p>
                                <p class="p_select">
                                    <label>応募方法<br>
                                        <select name="docmt" class="pull-down">
                                            <option value="6">全て</option>
                                            <option value="1" <?php echo $option_docmt[0] ?>>本校の紹介</option>
                                            <option value="2" <?php echo $option_docmt[1] ?>>職安の紹介</option>
                                            <option value="3" <?php echo $option_docmt[2] ?>>縁故者の紹介</option>
                                            <option value="4" <?php echo $option_docmt[3] ?>>求人情報誌等</option>
                                            <option value="5" <?php echo $option_docmt[4] ?>>その他</option>
                                        </select>
                                    </label>
                                </p>
                            </div>
                            <div class="t_dvSerach_btn">
                                <div class="button_re"><input class="reset_d" type="submit" name="reset" value="リセット"></div>
                                <div class="button_d"><input class="search_d" type="submit" value="🔍検索"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div>
                    <p class="kensu">全部で<?php echo $records ?>件のデータがあります。</p>
                    <table class="dvtable" id="table_erea">
                        <thead>
                            <tr>
                                <th scope="col">申請日</th>
                                <th scope="col">企業名</th>
                                <th scope="col">生徒名</th>
                                <th scope="col">申請<br class="br-sp">状況</th>
                                <th scope="col">詳細<br class="br-sp">閲覧</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php t_create_tbody($row,'teach');?>
                        </tbody>
                    </table>
                </div>

                <footer>
                    <div class="change_save">
                        <?php create_btn_chg($page,$records); ?>
                    </div>
                </footer>

            </div>

        </body>
        <script type="text/javascript" src="\DEVELOPMENT_PRACTICE/JS_files/methot.js"></script>

    </html>


</html>