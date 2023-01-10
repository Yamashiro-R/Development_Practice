<?php
    session_start();    //セッション開始
    $_SESSION = array();

    $error = "";

    if (!empty($_SESSION['ID'])) {
        //セッションにユーザIDがある＝ログインしている
        //ログイン済みならトップページに遷移する

        if($_SESSION['ID'] / 10000 >= 99){
            header('Location: teacher/home.php'); /*管理者ユーザ*/
        }else{
            header('Location: student/home.php');/*生徒ユーザ*/
        }
        exit();
    }else if (!empty($_POST['ID']) && !empty($_POST['pass'])) {
        //ログインしていないがユーザ名とパスワードが送信されたとき

        //比嘉さんのデータベースアクセス用
        $dsn = 'mysql:host=192.168.1.171;dbname=job_hunt_manage;charset=utf8';  
        $user = 'user';
        $password = 'test';


        try{
            $db = new PDO($dsn, $user, $password);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            //プリペアドステートメントを作成
            $stmt = $db->prepare("SELECT * FROM account_tb,family_name_tb 
                                    WHERE account_tb.fn_number = family_name_tb.fn_number and act_id =:ID and password =:pass");
            
            $hasg_pass = hash("sha256",$_POST['pass']);
            //パラメータ割り当て
            $stmt->bindParam(':ID', $_POST['ID'], PDO::PARAM_STR);
            $stmt->bindParam(':pass', $hasg_pass, PDO::PARAM_STR);
            //クエリの実行
            $stmt->execute();



            if ($row = $stmt->fetch()) {   
                //IDとPassが一緒の場合　＝　新規ユーザページへ飛ばす
                if($_POST['pass'] == strval($_POST['ID'])){
                    $_SESSION['name'] = $row['account_name'];
                    $_SESSION['family_name'] = $row['family_name'];
                    $_SESSION['newlogID'] = $_POST['ID'];
                    header('Location: newlogin.php');
                    exit();
                }

                //ユーザが存在していたら、セッションにユーザIDセット

                $_SESSION['ID'] = $row['act_id'];
                $_SESSION['name'] = $row['account_name'];

                if($_SESSION['ID'] / 10000 >= 99) {
                    header('Location: teacher/home.php');
                }else{
                    header('Location: student/home.php');
                }
                exit();
            }else {
                //1レコードも取得できなかったとき
                //ユーザ名・パスワードが間違っている可能性あり
                $error = "IDもしくはPassが間違っています。";
            }
        }catch (PDOException $e) {
            exit('エラー：' . $e->getMessage());
        }    
    }else if(!empty($_POST)){
        //ユーザ名・パスワードが間違っている可能性あり
        $error = "IDもしくはPassが間違っています。";
    }
?>

<!DOCTYPE html>
    <html lang="ja">
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="cssfiles/style.css">
            <link rel="stylesheet" href="cssfiles/style_log.css">
            <title>就職活動管理WEBアプリ</title>
        </head>
        <body>
            <div id="main_title"> 
                <h1>就職活動管理<br class="br-sp">WEBアプリ</h1>
            </div>
            <p style="text-align: center; color: red; " ><?php echo $error ?></p>
            <form class="roginform" action="login.php" method="POST">
                <div class="ID-From">
                    <p class="p-title">ID</p>
                    <input type="text" class="id rogin-input" name="ID" maxlength="6" placeholder="6桁の数字" pattern="^[0-9]+$" autocomplete="off">
                </div>
                <div class="password">
                    <p class="p-title">Pass</p>
                        <input type="password" name="pass" maxlength="8" placeholder="6～8桁の英数字" pattern="^[0-9a-zA-Z]+$" class="pass rogin-input">
                </div>
                <input type="submit" class="btn btn-border" value="ログイン">
            </form>
        </body> 
    </html>
</html>