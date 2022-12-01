<?php
    include '../includes/login.php';
    include '../includes/function.php';

?>

<?php
    if(empty($_POST['thoughts']) || empty($_POST['schedule']) || empty($_POST['remarks'])){
        echo "処理しない";
    }else {
        
        $reference_number = 1;

//                 echo '成功';
//                 //ポストされたデータを変数に格納
//                 $id = intval($_SESSION['ID']);

                $dsn = 'mysql:host=192.168.1.171;dbname=job_hunt_manage;charset=utf8';
                $user = 'user';
                $password = 'test';

                try{
                    $db = new PDO($dsn, $user, $password);
                    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                    //プリペアドステートメントを作成

                    $stmt = $db->prepare("SELECT * FROM ac_comp_data_tb WHERE reference_number = :ref_num");

                    $stmt->bindParam(':ref_num',$reference_number,PDO::PARAM_INT);

                    //クエリの実行
                    $stmt->execute();

                    $row_catch = $stmt -> fetch();

                    var_dump($row_catch);
                    echo '  <br> ';
                    echo '  <br> ';
                    
                }catch (PDOException $e) {
                    exit('エラー：' . $e->getMessage());
                }


                try {
                    $db = new PDO($dsn, $user, $password);
                    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                    //プリペアドステートメントを作成


                    $stmt = $db->prepare("UPDATE ac_comp_data_tb SET  impressions = :impres,future_activities = :future WHERE reference_number = :ref");
                    $stmt->bindParam(':impres',$_POST['thoughts'],PDO::PARAM_STR);
                    $stmt->bindParam(':future',$_POST['schedule'],PDO::PARAM_STR);
                    $stmt->bindParam(':ref',$reference_number,PDO::PARAM_INT);
                    

                    // $stmt = $db->prepare("UPDATE ac_comp_data_tb SET  impressions = :impres,future_activities = :future,remarks = :rem WHERE reference_number = :ref");
                    // $stmt->bindParam(':impres',$_POST['thoughts'],PDO::PARAM_STR);
                    // $stmt->bindParam(':future',$_POST['schedule'],PDO::PARAM_STR);
                    // $stmt->bindParam(':ref',$reference_number,PDO::PARAM_INT);
                    // $stmt->bindParam(':rem',$_POST['remarks'],PDO::PARAM_STR);

                    $stmt->execute();
                    
                    $stmt = $db->prepare("SELECT * FROM ac_comp_data_tb WHERE reference_number = :ref_num");

                    $stmt->bindParam(':ref_num',$reference_number,PDO::PARAM_INT);

                    //クエリの実行
                    $stmt->execute();

                    $row_catch = $stmt -> fetch();

                    var_dump($row_catch);
                    

                }catch(PDOException $e) {
                    exit('エラー：' . $e->getMessage());
                }

            }


// }
?>

<?php 
    function toBoolean(string $str) {
        return ($str === 'true');
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
                <a href="Input_Form_1.php"><img src="../images/innu.jpeg"></a>
            </div>
            <div id="main_title">   <!-- 共通のタイトル部分 -->
                <h1>就職活動報告</h1>
                <h2>ステップ3</h2>
            </div>

            <form action="Input_Form_3.php" method="post">
                <div class="box">
                    <div class="thoughts">
                        <h3>感想、反省点</h3>
                        <textarea class="thoughts-text" name="thoughts"></textarea>
                    </div>
                    <div class="schedule">
                        <h3>今後の活動予定</h3>
                        <textarea class="thoughts-text" name="schedule"></textarea>
                    </div>
                    <div class="schedule">
                        <h3>備考</h3>
                        <textarea class="thoughts-text" name="remarks"></textarea>
                    </div>
                
                    <input type="hidden" value="" name="hantei">
                    <div class="button">
                        <input type="button" class="cancel" value="キャンセル" alt="キャンセル">
                        <input type="submit" class="keep" value="保存" alt="保存">
                        <input type="submit" class="confirmation" value="確認画面 →" alt="確認画面 →">
                    </div>
                </div>
            </form>

        </body>
        <script type="text/javascript" src="\DEVELOPMENT_PRACTICE/JS_files/methot.js"></script>
    </html>


</html>