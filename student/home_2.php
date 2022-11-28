<?php
    include '../includes/login.php';
    include '../includes/function.php';

    $_SESSION['ps_val'] = null;
    $_SESSION['page'] = null;
?>

<!DOCTYPE html>
    <html lang="ja">
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="../cssfiles/style.css">
            <link rel="stylesheet" href="../cssfiles/style_prot.css">
            <!-- アイコン用のkit -->
            <script src="https://kit.fontawesome.com/fd6da7ad7b.js" crossorigin="anonymous"></script>

            <title>ホーム画面</title>
        </head>
        <?php include 'header.php' ?>

        <body class="home">
        <div id="main_title"> 
            <!-- 後で考える -->
            <h1>ホーム画面</h1>     
        </div>

            <div class="prot_div">
                <div class="new_title"> 
                    <div class="title" onclick="TOP()">TOP</div>
                    <div class="title" onclick="CreateReport()">報告書作成</div>
                </div>
                <div class="prot_body1">
                    <button onclick="location.href='dvSearch.php'">
                        <i class="fa-solid fa-magnifying-glass"></i><br>
                        検索
                    </button>
                </div>
                <div class="prot_body2">
                    <button onclick="location.href='Input_Form_1.php'">
                        <i class="fa-solid fa-pen-to-square"></i><br>
                        新規作成
                    </button>
                    <button onclick="location.href='dataView.php'">
                        <i class="fa-solid fa-floppy-disk"></i><br>
                        保存済データ
                    </button>
                </div>
            </div>
            
            <script type="text/javascript" src="\DEVELOPMENT_PRACTICE/JS_files/home.js"></script>
            <script type="text/javascript" src="\DEVELOPMENT_PRACTICE/JS_files/methot.js"></script>
            

        </body>




    </html>


</html>