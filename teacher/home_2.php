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
        <body class="home">
        <?php include 'header.php' ?>
        <div id="main_title"> 
            <!-- 後で考える -->
            <h1>ホーム画面</h1>     
        </div>

            <div class="prot_div">
                <div class="new_title"> 
                    <div class="title" onclick="TOP()">TOP</div>
                    <div class="title title_t" onclick="CreateReport()">申請依頼
                        <p class="sinki">
                            <?PHP 
                                if(count($row_header) > 0){
                                echo '🔴'; 
                                }
                            ?>
                        </p>
                    </div>
                </div>
                <div class="prot_body1">
                    <button class="p-body1" onclick="location.href='t_dvSearch.php'">
                        <i class="fa-solid fa-magnifying-glass"></i><br>
                        検索
                    </button>
                </div>
                <div class="prot_body2 prot_body2_t">
                    <button onclick="location.href='teach_req.php'">
                        <i class="fa-solid fa-pen-to-square"></i><br>
                        依頼を確認
                        <p class="sinki_kensu">
                                <?php 
                                    if(count($row_header) > 0){
                                        echo count($row_header)."件";
                                    }
                                ?>
                        </p>
                    </button>
                    <!-- <button onclick="location.href='dataView.php'">
                        <i class="fa-solid fa-floppy-disk"></i><br>
                        保存済データ
                    </button> -->
                </div>
            </div>
            <script type="text/javascript" src="\DEVELOPMENT_PRACTICE/JS_files/home.js"></script>
            <script type="text/javascript" src="\DEVELOPMENT_PRACTICE/JS_files/methot.js"></script>
            

        </body>



    
    </html>


</html>