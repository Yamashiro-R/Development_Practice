<?php
    session_start();
    if (!isset($_SESSION['ID'])) {
        header('Location: \Development_Practice/login.php');
        exit();
    }
?>