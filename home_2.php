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
            <link rel="stylesheet" href="cssfiles/style_prot.css">
            <!-- アイコン用のkit -->
            <script src="https://kit.fontawesome.com/fd6da7ad7b.js" crossorigin="anonymous"></script>

            <title>ホーム画面</title>
        </head>
        <body class="home">
        <div id="main_title"> 
            <h1>報告活動管理Webアプリ</h1>
        </div>

            <div class="prot_div">
                <div class="new_title"> 
                    <div class="title" onclick="TOP()">TOP</div>
                    <div class="title" onclick="CreateReport()">報告書作成</div>
                </div>
                <div class="prot_body1">
                    <button>
                        <i class="fa-solid fa-magnifying-glass"></i>
                        検索
                    </button>
                </div>
                <div class="prot_body2">
                    <button>
                        <i class="fa-solid fa-pen-to-square"></i>
                        新規作成
                    </button>
                    <button>
                        <i class="fa-solid fa-floppy-disk"></i>    
                        保存済みデータ
                    </button>
                </div>
            </div>
            
            <script type="text/javascript" src="home.js"></script>
            <script type="text/javascript">setting()</script>

        </body>



    
    </html>


</html>