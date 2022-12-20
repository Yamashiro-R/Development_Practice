<?php
    include '../includes/login.php';
    include '../includes/function.php';

    $_SESSION['ps_val'] = null;
    $_SESSION['page_dvs'] = null;
    $_SESSION['page_dv'] = null;
    $_SESSION['ap_status'] = null;
    $_SESSION['reference'] = null;
    $_SESSION['reference_edit'] = null;
    $_SESSION['Input_3'] = null;
    $_SESSION['back_page'] = null;

    
    //Input_Form編集中に飛んだらreferenceを破棄させて新規にさせる。
    //元々を編集するときは保存済みデータから編集させる!!
    if(isset(($_SESSION['reference']))){
        unset($_SESSION['reference']);
    }
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
                    <div class="title" onclick="TOP()">報告書検索</div>
                    <div class="title" onclick="CreateReport()">報告書作成</div>
                </div>
                <div class="prot_body1">
                    <button class="p-body1" onclick="location.href='dvSearch.php'">
                        <i class="fa-solid fa-magnifying-glass"></i><br>
                        検索
                    </button>
                </div>
                <div class="prot_body2">
                    <button class="p-body2" onclick="location.href='Input_Form_1.php'">
                        <i class="fa-solid fa-pen-to-square"></i><br>
                        新規作成
                    </button>
                    <button class="p-body2" onclick="location.href='dataView.php'">
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