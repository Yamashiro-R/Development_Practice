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
                <form action="home.php" class="roginform">
                    <div class="ID-From">
                        <p class="p-title">ID</p>
                            <input type="text" class="id rogin-input">
                    </div>
                    <div class="infomation">
                        <p class="info">※パスワードを設定してください。</p>
                    </div>
                    <div class="password">
                        <p class="p-title">Pass</p>
                            <input type="text" name="pass" placeholder="4桁英数字" class="pass rogin-input">
                    </div>
                    <div class="re-password">
                        <p class="re-pw p-title">Pass<br class="br-sp">再入力</p>
                            <input type="text" name="re-pass" placeholder="4桁英数字" class="re-pass rogin-input">
                    </div>
                    <div class="class-name">
                        <p class="p-title">科名</p>
                            <!-- <input type="text" name="department" class="class_name rogin-input"> -->
                        <select name="department" class="rogselect">
                            <option value="gardening">造園ガーデニング科</option>
                            <option value="electric">電気システム科</option>
                            <option value="car-mnt">自動車整備科</option>
                            <option value="ofc-work">オフィスビジネス科</option>
                            <option value="media-art">メディア・アート科</option>
                            <option value="info-sys">情報システム科</option>
                            <option value="pra-work">総合実務科</option>
                            <option value="null" selected>未選択</option>
                        </select>
                    </div>
                    <button class="btn btn-border">登録</button>
                </form>
        </body>
    
    </html>


</html>