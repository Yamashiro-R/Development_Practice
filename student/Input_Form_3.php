<?php
    include 'includes/login.php';
?>
<!DOCTYPE html>
    <html lang="ja">
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="cssfiles/style.css">
            <link rel="stylesheet" href="cssfiles/style_Input_Form.css">
            <title>theme</title>
        </head>
        <body>
            <div class="return">    <!-- 犬の画像用戻るボタン -->
                <a href="Input_Form_1.php"><img src="images/innu.jpeg"></a>
            </div>
            <div id="main_title">   <!-- 共通のタイトル部分 -->
                <h1>就職活動報告</h1>
                <h2>ステップ3</h2>
            </div>

            <div class="box">
                <div class="thoughts">
                    <h3>・感想、反省点</h3>
                    <textarea class="thoughts-text"></textarea>
                </div>
                <div class="schedule">
                    <h3>・今後の活動予定</h3>
                    <textarea class="thoughts-text"></textarea>
                </div>
           
                <div class="button">
                    <input type="button" class="cancel" value="キャンセル">
                    <input type="button" class="keep" value="保存">
                    <input type="button" class="confirmation" value="確認画面 →">
                </div> 
            </div>

        </body>
    
    </html>


</html>