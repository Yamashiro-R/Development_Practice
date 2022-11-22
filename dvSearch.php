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


    if($_POST){
        $name = $_POST['comp_name'];
        $address = $_POST['comp_address'];
        $job = $_POST['job'];

        $page = 1;
        $_SESSION['page'];
        $_SESSION['ps_val'] = $_POST;
    }else if(!$_POST && isset($_SESSION['ps_val'])){
        $_POST = $_SESSION['ps_val'];
        $name = $_POST['comp_name'];
        $address = $_POST['comp_address'];
        $job = $_POST['job'];

    } else{
        $name = false;
        $address = false;
        $job = false;
    }



    $select = 'SELECT * FROM ac_comp_data_tb join apply_status_tb 
                on ac_comp_data_tb.as_number = apply_status_tb.as_number 
                where ac_comp_data_tb.as_number = 3 ';

    if($name){
        $select .=  "and comp_name LIKE '%". $name . "%'" ; 
    }

    if($address){
        $select .=  "and comp_address LIKE '%". $address . "%'" ; 
    }

    if($job){
        $select .=  "and job LIKE '%". $job . "%'" ; 
    }


    $select_limit = $select; 
    $select_limit .= 'LIMIT :page , :num';



    try{
        $db = new PDO($dsn, $user, $password);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        //プリペアドステートメントを作成
        $stmt = $db->prepare("SELECT * FROM ac_comp_data_tb join apply_status_tb
                            on ac_comp_data_tb.as_number = apply_status_tb.as_number
                             where ac_comp_data_tb.as_number = 3 
                             ORDER by modified 
                             LIMIT :page,:num ");

        if($name || $address || $job){
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
         $stmt = $db->prepare("SELECT * FROM ac_comp_data_tb join apply_status_tb
                                on ac_comp_data_tb.as_number = apply_status_tb.as_number
                                where ac_comp_data_tb.as_number = 3 
                                ORDER by modified ");
        
        if($name || $address || $job){
            $stmt = $db->prepare($select);
        }

    
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
            <title>就職活動データ検索</title>
        </head>
        <body class="serch_back-color">
            <div>
                <div class="return">
                    <a href="home.php"><img src="images/innu.jpeg"></a>
                </div>
                <div id="main_title"> 
                    <h1>報告書📄<br class="br-sp">全データ検索</h1>
                </div>

                <div>
                    <form class="dvSform" action="dvSearch.php" method="POST">
                        <!-- <div class="dvStop">
                            <div class="dvSname"> -->
                        <div>
                             <p>
                                <label>企業名で検索<br><input type="search" name="comp_name" value="<?php echo $name ?>"></label>
                            </p>
                            <p>
                                <label>所在地<br><span class="small">※市町村で記入<br>(県外の場合は県名で記入)</span><br><input type="search" name="comp_address" value="<?php echo $address ?>"> </label>
                            </p>
                            <p>
                                <label>職種で検索<br><input type="search" name="job" value="<?php echo $job ?>"> </label>
                                <div class="button_d"><input type="submit" value="🔍検索"></div> 
                            </p>
                        </div>
                    </form>
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
                        <?php create_tbody($row,'past');?>
                        </tbody>
                    </table>
                </div>

                <footer>
                    <div class="change_save">
                        <?php create_btn_chg($page,$records,'search'); ?>
                    </div>
                </footer>

            </div>

        </body>
    
    </html>


</html>