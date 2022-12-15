<?php
    include '../includes/login.php';
    include '../includes/function.php';

?>

<?php 
    
    //戻るボタン用のURLを設定する。
    $return_URL;
    if( isset( $_SESSION['edit_Form_3'] ) ){
        //$_SESSION['edit_Form_3']がある時
        switch($_SESSION['edit_Form_3']){
            case 0:
                $return_URL = "edit_Form_1.php";
                break;
            case 1:
                $return_URL = "edit_Form_2_1.php";
                break;
            case 2:
                $return_URL = "edit_Form_2_2.php";
                break;
            default:
                $return_URL = "edit_Form_2_3.php";
            
        }
        //リンクをセットしたらセッションを破棄する。
        unset($_SESSION['edit_Form_3']);
    }else{
        $return_URL = "edit_Form_2_3.php";
        
    }
   
?>


<?php
    $dsn = 'mysql:host=192.168.1.171;dbname=job_hunt_manage;charset=utf8';
    $user = 'user';
    $password = 'test';

    $pages = array("edit_Form_2_1.php","edit_Form_2_2.php","edit_Form_2_3.php");

    $reference_number = $_SESSION['reference_edit'];

    if(isset($_SESSION['reference_edit'])){
        $reference_number = $_SESSION['reference_edit'];
        if($_POST){
                if(isset($_POST['cancel'])){

                }else{
                    try {
                        $db = new PDO($dsn, $user, $password);
                        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                        //プリペアドステートメントを作成
                        

                        $stmt = $db->prepare("UPDATE ac_comp_data_tb SET  impressions = :impres,future_activities = :future,remarks = :rem WHERE reference_number = :ref");
                        $stmt->bindParam(':impres',$_POST['thoughts'],PDO::PARAM_STR);
                        $stmt->bindParam(':future',$_POST['schedule'],PDO::PARAM_STR);
                        $stmt->bindParam(':ref',$reference_number,PDO::PARAM_INT);
                        $stmt->bindParam(':rem',$_POST['remarks'],PDO::PARAM_STR);

                        $stmt->execute();
                        
                        $stmt = $db->prepare("SELECT * FROM ac_comp_data_tb WHERE reference_number = :ref_num");

                        $stmt->bindParam(':ref_num',$reference_number,PDO::PARAM_INT);

                        //クエリの実行
                        $stmt->execute();

                        $row = $stmt -> fetch();


                        if(isset($_POST['fin'])) {
                            if($_SESSION['back_page'] == 'save'){
                                header('Location: savedata.php');
                                exit();
                            }else if($_SESSION['back_page'] == 'result'){
                                header('Location: result.php');
                                exit();
                            }
                        }
                    
                    }catch(PDOException $e) {
                        exit('エラー：' . $e->getMessage());
                    }
            }
                    
        }
    }else{
        header('Location: Input_Form_2_3.php');
    }


    try{
        $db = new PDO($dsn, $user, $password);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        //プリペアドステートメントを作成

        $stmt = $db->prepare("SELECT * FROM ac_comp_data_tb WHERE reference_number = :ref_num");

        $stmt->bindParam(':ref_num',$reference_number,PDO::PARAM_INT);

        //クエリの実行
        $stmt->execute();


        if($row = $stmt -> fetch()){
            $impressions = $row['impressions'];
            $future_activities = $row['future_activities'];
            $remarks = $row['remarks'];
        }else{
            $impressions = null;
            $future_activities = null;
            $remarks = null;
        }
        
    }catch (PDOException $e) {
        exit('エラー：' . $e->getMessage());
    }
?>




<!DOCTYPE html>
    <html lang="ja">
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="../cssfiles/style.css">
            <link rel="stylesheet" href="cssfiles/style_Input_Form.css">
            <title>入力画面</title>
        </head>
        <?php include 'header.php' ?>

        <body>
            <div class="return">    <!-- 犬の画像用戻るボタン -->
                <a href="<?php echo $pages[$_SESSION['Input_3']]?>"><img src="../images/innu.jpeg"></a>
            </div>
            <div id="main_title">   <!-- 共通のタイトル部分 -->
            <h1 class="edit_h1">就職活動報告(編集)</h1>
                <h2 class="edit_h2">ステップ３</h2>
            </div>

            <form action="edit_Form_3.php" method="post">
                <div class="box">
                    <div class="thoughts">
                        <h3>感想、反省点</h3>
                        <textarea id="thought1" class="thoughts-text" name="thoughts"><?PHP echo $impressions ?></textarea>
                    </div>
                    <div class="schedule">
                        <h3>今後の活動予定</h3>
                        <textarea id="thought2" class="thoughts-text" name="schedule"><?PHP echo $future_activities ?></textarea>
                    </div>
                    <div class="schedule">
                        <h3>備考</h3>
                        <textarea id="thought3" class="thoughts-text" name="remarks"><?PHP echo $remarks ?></textarea>
                    </div>
                
                    <input type="hidden" value="" name="hantei">
                    <div class="button">
                        <input type="submit"  class="btn_item" name="cancel" value="キャンセル" alt="キャンセル">
                        <input type="submit" class="keep" value="保存" alt="保存" onclick="save_alert()">
                        <input type="submit"  class="btn_item  fin_btn" name="fin" value="編集終了" alt="編集終了">
                    </div>
                </div>
            </form>

        </body>
        <script type="text/javascript" src="\DEVELOPMENT_PRACTICE/JS_files/methot.js"></script>
    </html>


</html>