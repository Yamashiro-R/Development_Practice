<header class="site-header">
    <div class="wrapper site-header__wrapper">
        <div class="site-header__start">
            <p class="brand">就職活動管理Webアプリ</p>
        </div>
        <div class="site-header__middle">
            <nav class="nav">
            <button class="nav__toggle" aria-expanded="false" type="button">
            menu
            </button>
            <ul class="nav__wrapper">
                <li class="nav__item" title="ID:1224">👤<?php echo $_SESSION['name'] ?></li>
                <li class="nav__item">
                    <div class="dropdown">
                        <input id="tg" class="dropInput" type="checkbox">
                        <label for="tg" class="dropLabel">PageList▼</label>
                        <ul class="menu animation">
                            <li><a class="item" href="home_2.php">ホーム</a></li>
                            <li><a class="item" href="dvSearch.php">閲覧検索</a></li>
                            <li><a class="item" href="Input_Form_1.php">報告書新規作成</a></li>
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
                    <a class="button_header" href="#" onclick="rog_out_js(); return false;">ログアウト</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
