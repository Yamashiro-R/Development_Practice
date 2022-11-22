<!-- 旧ホームページ 閲覧検索 OR 就職活動報告 どちらかを選ばせるページ-->

<?php
    // include 'includes/login.php';

    // $_SESSION['ps_val'] = null;
    // $_SESSION['page'] = null;
?>

<!DOCTYPE html>
    <html lang="ja">
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="cssfiles/style.css">
            <link rel="stylesheet" href="cssfiles/style_menu.css">
            <link rel="stylesheet" href="cssfiles/style_flexible.css">
            <title>ホーム画面</title>
        </head>
        <body class="home">
            <div>
                <div id="main_title"> 
                    <h1>ホームメニュー</h1>
                </div>
                    <div>
                    <button class="homebtnEturan" onclick="location.href='dvSearch.php'">閲覧検索</button>
                    <button class="homebtnHoukoku" onclick="location.href='./houkoku.php'">就職活動報告</button>
                </div>
            </div>

        </body>
    
    </html>


</html>