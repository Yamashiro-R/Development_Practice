<?php 
        $dsn = 'mysql:host=192.168.1.171;dbname=job_hunt_manage;charset=utf8';
        $user = 'user';
        $password = 'test';
    
        try{
            $db = new PDO($dsn, $user, $password);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            //プリペアドステートメントを作成
            $stmt_header = $db->prepare("SELECT * FROM ac_comp_data_tb,account_tb
                                    WHERE ac_comp_data_tb.act_id = account_tb.act_id and ac_comp_data_tb.as_number = 2");
            
            //クエリの実行
            $stmt_header->execute();
            $row_header = $stmt_header->fetchAll();

            // $row = array();
            
        }catch (PDOException $e) {
            exit('エラー：' . $e->getMessage());
        }
    
?>
<header class="site-header">
    <div class="wrapper site-header__wrapper">
        <div class="site-header__start">
            <p class="brand"><a href="home_2.php">就職活動管理Webアプリ</a></p>
        </div>
        <div class="site-header__middle">
            <nav class="nav">
            <button class="nav__toggle" aria-expanded="false" type="button">
            menu
            </button>
            <ul class="nav__wrapper">
                <li class="nav__item" title="ID:<?php echo $_SESSION['ID']?>">👤<?php echo $_SESSION['name'] ?></li>
                <li class="nav__item">
                    <div class="dropdown" id="la">
                        <input id="tg" class="dropInput" type="checkbox">
                        <label for="tg" class="dropLabel">PageList▼
                            <p class="sinki_header">
                                <?PHP 
                                    if(count($row_header) > 0){
                                    echo '🔴'; 
                                    }
                                ?>
                            </p>
                        </label>
                        <ul class="menu animation">
                            <li><a class="item" href="home_2.php">ホーム</a></li>
                            <li><a class="item" href="t_dvSearch.php">閲覧検索</a></li>
                            <li><a class="item" href="teach_req.php">新規申請依頼</a>
                                <p class="sinki_kensu_hd">
                                    <?php 
                                        if(count($row_header) > 0){
                                            echo "新規".count($row_header)."件";
                                        }
                                    ?>
                                </p>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
            </nav>
        </div>
        <div class="site-header__end">
            <a class="button_header" href="#" onclick="rog_out_js(); return false;">ログアウト</a>
        </div>
        <div class="hamburger-menu" >
            <input type="checkbox" id="menu-btn-check">
            <label for="menu-btn-check" class="menu-btn"><span></span></label>
            <div class="menu-content">
                <ul>
                    <li>
                        <a href="home_2.php">ホーム</a>
                    </li>
                    <li>
                        <a href="t_dvSearch.php">閲覧検索</a>
                    </li>
                    <li>
                        <a href="teach_req.php">新規申請依頼</a>
                        <p class="sinki_kensu_hg">
                            <?php 
                                if(count($row_header) > 0){
                                    echo "新規".count($row_header)."件";
                                }
                            ?>
                    </li>
                    <li>
                        <div class="site-header__end">
                            <a class="button_header" href="#" onclick="rog_out_js(); return false;">ログアウト</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>

<script>
    const la =  document.getElementById('la');
    la.addEventListener('mouseover',function() {
        document.getElementById('tg').checked = true;
    });

    la.addEventListener('mouseout',function() {
        document.getElementById('tg').checked = false;
    });

    /*teach_reqのグローバルメニュー↓*/

let navToggle = document.querySelector(".nav__toggle");
let navWrapper = document.querySelector(".nav__wrapper");

navToggle.addEventListener("click", function () {
if (navWrapper.classList.contains("active")) {
    this.setAttribute("aria-expanded", "false");
    this.setAttribute("aria-label", "menu");
    navWrapper.classList.remove("active");
} else {
    navWrapper.classList.add("active");
    this.setAttribute("aria-label", "close menu");
    this.setAttribute("aria-expanded", "true");
}
});

/*teach_reqのグローバルメニュー↑*/

/*ハンバーガーメニューが押されたときの処理*/ 
function hamb_mn() {
    $checked = document.getElementById('menu-btn-check').checked

    if($checked){
    alert('true');
        document.getElementsByClassName('req_form').style.pointerEvents.value = 'none';
    }
} 

</script>

