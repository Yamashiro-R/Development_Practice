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
                        <label for="tg" class="dropLabel">PageList▼</label>
                        <ul class="menu animation">
                            <li><a class="item" href="home_2.php">ホーム</a></li>
                            <li><a class="item" href="dvSearch.php">閲覧検索</a></li>
                            <li><a class="item" href="Input_Form_1.php">報告書新規作成</a></li>
                            <li><a class="item" href="dataView.php">保存データ</a></li>
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
                        <a href="dvSearch.php">閲覧検索</a>
                    </li>
                    <li>
                        <a href="Input_Form_1.php">報告書新規作成</a>
                    </li>
                    <li>
                        <a href="dataView.php">保存データ</a>
                    </li>
                    <li>
                    <a class="button_rogout" href="#" onclick="rog_out_js(); return false;">ログアウト</a>
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

