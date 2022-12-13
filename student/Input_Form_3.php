<?php
    include '../includes/login.php';
    include '../includes/function.php';

?>


<?php
    $dsn = 'mysql:host=192.168.1.171;dbname=job_hunt_manage;charset=utf8';
    $user = 'user';
    $password = 'test';


    // $reference_number = 2;
    // $_SESSION['reference_number'] = $reference_number;
    if(isset($_SESSION['reference'])){
        $reference_number = $_SESSION['reference'];
        if($_POST){
            try {
                $db = new PDO($dsn, $user, $password);
                $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                //プリペアドステートメントを作成


                // $stmt = $db->prepare("UPDATE ac_comp_data_tb SET  impressions = :impres,future_activities = :future WHERE reference_number = :ref");
                // $stmt->bindParam(':impres',$_POST['thoughts'],PDO::PARAM_STR);
                // $stmt->bindParam(':future',$_POST['schedule'],PDO::PARAM_STR);
                // $stmt->bindParam(':ref',$reference_number,PDO::PARAM_INT);
                

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


                if(isset($_POST['conf'])){
                    if(!empty($_POST['thoughts']) || !empty($_POST['schedule']) || !empty($_POST['remarks'])){
                        // header('Location: conf.php');
                        header('Location: result.php');
                    }
                }
                

            }catch(PDOException $e) {
                exit('エラー：' . $e->getMessage());
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

    // var_dump($row_catch);
    // echo '  <br> ';
    // echo '  <br> ';
    
}catch (PDOException $e) {
    exit('エラー：' . $e->getMessage());
}


//                 echo '成功';
//                 //ポストされたデータを変数に格納
//                 $id = intval($_SESSION['ID']);




// }
echo $reference_number;
?>




<!DOCTYPE html>
    <html lang="ja">
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="../cssfiles/style.css">
            <link rel="stylesheet" href="cssfiles/style_Input_Form.css">
            <title>就職活動報告書_ステップ３</title>
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
                        <input type="button" class="cancel" value="キャンセル" alt="キャンセル">
                        <input type="submit" class="keep" value="保存" alt="保存" onclick="kep_btn()">
                        <input id="conf" type="submit" name="conf" class="confirmation" value="確認画面 →" alt="確認画面 →">
                    </div>
                </div>
            </form>

        </body>
        <script>

            input_jug();

            var idname = 'thought';
                for(let i = 0; i < 3; i++) {
                    var thought = document.getElementById(idname + (i + 1));
//              console.log(thought);
                thought.addEventListener('blur',() => {
                    input_jug();
                });
            }

            function input_jug(){
                // alert('true');
                var idname = 'thought';
                for(let i = 0; i < 3; i++) {
                    var thought = document.getElementById(idname + (i + 1));
                    if(thought.value == "" || thought.value == null){
                        document.getElementById('conf').disabled  = true;
                        return;
                    }
                }
                    document.getElementById('conf').disabled  = false;
            }

            function kep_btn(){
                alert('データが保存されました。');
            }
        </script>
        <script type="text/javascript" src="\DEVELOPMENT_PRACTICE/JS_files/methot.js"></script>
    </html>


</html>