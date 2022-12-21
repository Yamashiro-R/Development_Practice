<?php
session_start();

if(!isset($_SESSION['newlogID'])){
    header('Location: login.php');
    exit();
}
$option = array(7);


if (!empty( $_POST['pass']) && !empty($_POST['re-pass'])) {
    $pass = $_POST['pass'];
    $re_pas = $_POST['re-pass'];
    $family = 


        // $param_pass = json_encode($pass);
        // $param_re_pass = json_encode($re_pas);
        $dsn = 'mysql:host=192.168.1.171;dbname=job_hunt_manage;charset=utf8';
        $user = 'user';
        $password = 'test';

        $p_test = hash("sha256",$pass);
        $re_p_test = hash("sha256",$re_pas);
        $family = intval($family) ;

        if($p_test === $re_p_test && $p_test != ""){
            if($_SESSION['newlogID'] != $pass){
                try {
                    $db = new PDO($dsn, $user, $password);
                    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                    //プリペアドステートメントを作成
                    $stmt = $db->prepare("UPDATE account_tb SET password = :pass WHERE act_id = :act");
                    //パラメータ割り当て
                    $stmt->bindParam(':pass',$p_test, PDO::PARAM_STR);
                    $stmt->bindParam(':act', $_SESSION['newlogID'], PDO::PARAM_INT);
                    //クエリの実行
                    $stmt->execute();

                    $_SESSION = array();


                    header('Location: login.php');


                }catch(PDOException $e){
                    exit('エラー：' . $e->getMessage());
                }
            }

        }    

}else{
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
            <title>新規アカウント登録</title>
        </head>
        <body>
            <div id="main_title"> 
                <h1>新規アカウント登録</h1>
            </div>
                <form action="newlogin.php" class="roginform" method="POST">
                    <div class="ID-From">
                        <p class="p-title">ID</p>
                            <span id="newlogID" class="rogin-input" style="font-size: 150%;"><?php echo $_SESSION['newlogID'] ?></span>
                    </div>

                    <div class="ID-From">
                        <p class="p-title">氏名</p><p id="newlog_fn" class="rogin-input"><?PHP echo isset($_SESSION['name']) ? $_SESSION['name'] : '未所属'; ?></p>
                    </div>

                    <div class="ID-From">
                        <p class="p-title">科名</p><p id="newlog_fn" class="rogin-input"><?PHP echo isset($_SESSION['family_name']) ? $_SESSION['family_name'] : '未所属'; ?></p>
                    </div>

                    <div class="infomation">
                        <p class="info">※パスワードを設定してください。</p>
                    </div>

                    <div class="password">
                        <p class="p-title">New Pass</p>
                            <input type="text" pattern="^[0-9a-zA-Z]+$" maxlength="8" minlength="4" name="pass" placeholder="4～8桁の英数字" class="pass rogin-input" value="<?php echo $pass ?>" autocomplete="off"
>
                    </div>

                    <div class="re-password">
                        <p class="re-pw p-title">Pass<br class="br-sp">再入力</p>
                            <input type="text" pattern="^[0-9a-zA-Z]+$" maxlength="8" minlength="4" name="re-pass" placeholder="4～8桁の英数字" class="re-pass rogin-input" value="<?php echo $re_pas ?>" autocomplete="off"
>
                    </div>

                <!-- <button class="btn btn-border">登録</button> -->
                <input type="submit" class="btn btn-border" value="登録" onclick="new_login_check()">
                </form>


                <script type="text/javascript" src="JS_files/methot.js"></script>
        </body>
    </html>
</html>