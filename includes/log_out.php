<?php
    session_start();
    /*ログアウト処理*/    
    if($_POST){
        $_SESSION = array();
    }        

?>