<?php
    // include 'includes/login.php';

    // $_SESSION['page'] = null;
?>
<!DOCTYPE html>
    <html lang="ja">
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="cssfiles/style.css">
            <link rel="stylesheet" href="cssfiles/style_menu.css">
            <link rel="stylesheet" href="cssfiles/style_flexible.css">
            <title>就職活動報告</title>
        </head>
        <body>
            <div>
                <div class="return">
                    <a href="./teach_home.php"><img class="return" src="images/innu.jpeg"></a>
                </div>
                <div id="main_title"> 
                    <h1>就職活動報告</h1>
                </div>

                <div>
                    <button class="newreq" onclick="location.href='Input_Form_1.php'">新規依頼</button>
                    <button class="okdata" onclick="location.href='./dataView.php'">承認済み</button>
                </div>

            </div>
        </body>
    </html>


</html>