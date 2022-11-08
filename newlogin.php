<?php
session_start();

$select = "selected";
$option = array(7);

for ($i = 0; $i < 7; $i++) {
    $option[$i] = "";
}

if ($_POST) {
    $id = $_POST['ID'];
    $pass = $_POST['pass'];
    $re_pas = $_POST['re-pass'];
    $family = $_POST['department'];

    for ($i = 1; $i < 8; $i++) {
        if ($_POST['department'] == $i) {
            $option[$i-1] = "selected";
            $select = null;
            break;
        }
    }
        $dsn = 'mysql:host=192.168.2.136;dbname=job_hunt_manage;charset=utf8';
        $user = 'user';
        $password = 'test';

        $test = hash("sha256",$pass);
        $family = intval($family) ;



    
    
        try {
            $db = new PDO($dsn, $user, $password);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
             //プリペアドステートメントを作成
            $stmt = $db->prepare("UPDATE account_tb SET password  = :pass WHERE act_id = :act");
            //パラメータ割り当て
            $stmt->bindParam(':pass',$test, PDO::PARAM_STR);
            $stmt->bindParam(':act', $id, PDO::PARAM_STR);
            //クエリの実行
            $stmt->execute();
            $stmt = $db->prepare("UPDATE account_tb SET fn_number = :num WHERE act_id = :act");
            $stmt->bindParam(':num', $family, PDO::PARAM_INT);
            $stmt->bindParam(':act', $id, PDO::PARAM_STR);
            //クエリの実行
            $stmt->execute();
        }catch(PDOException $e){
            exit('エラー：' . $e->getMessage());
        }
    echo $family;
}else{
    echo 'ii';
    $id = null;
    $pass = null;
    $re_pas = null;
    $family = null;
}

?>


<!DOCTYPE html>
    <html lang="ja">
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="cssfiles/style.css">
            <link rel="stylesheet" href="cssfiles/style_newrog.css">
            <title>新規会員登録</title>
        </head>
        <body>
            <div id="main_title"> 
                <h1>新規会員登録</h1>
            </div>
                <form action="newlogin.php" class="roginform" method="POST">
                    <div class="ID-From">
                        <p class="p-title">ID</p>
                            <input type="text" class="id rogin-input" name="ID" value="<?php echo $id ?>" autocomplete="off"
>
                    </div>
                    <div class="infomation">
                        <p class="info">※パスワードを設定してください。</p>
                    </div>
                    <div class="password">
                        <p class="p-title">Pass</p>
                            <input type="text" pattern="^[0-9]+$" maxlength="4" name="pass" placeholder="4桁英数字" class="pass rogin-input" value="<?php echo $pass ?>" autocomplete="off"
>
                    </div>
                    <div class="re-password">
                        <p class="re-pw p-title">Pass<br class="br-sp">再入力</p>
                            <input type="text" name="re-pass" maxlength="4" placeholder="4桁英数字" class="re-pass rogin-input" value="<?php echo $re_pas ?>" autocomplete="off"
>
                    </div>
                    <div class="class-name">
                        <p class="p-title">科名</p>
                            <!-- <input type="text" name="department" class="class_name rogin-input"> -->
                        <select name="department" class="rogselect">
                            <option value="1"<?php echo $option[0] ?>>造園ガーデニング科</option>
                            <option value="2"<?php echo $option[1] ?>>電気システム科</option>
                            <option value="3"<?php echo $option[2] ?>>自動車整備科</option>
                            <option value="4"<?php echo $option[3] ?>>オフィスビジネス科</option>
                            <option value="5"<?php echo $option[4] ?>>メディア・アート科</option>
                            <option value="6"<?php echo $option[5] ?>>情報システム科</option>
                            <option value="7"<?php echo $option[6] ?>>総合実務科</option>
                            <option value="8"<?php echo $select ?>>未選択</option>
                        </select>
                    </div>
                <!-- <button class="btn btn-border">登録</button> -->
                <input type="submit" class="btn btn-border" value="登録" onclick="new_login_check()">
                </form>
                <script type="text/javascript" src="methot.js"></script>
        </body>
    </html>
</html>