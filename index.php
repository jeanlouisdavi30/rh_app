<?php
    if(!isset($_SESSION['user_id']) AND !isset($_SESSION['utype'])){
        header('Location: login_page.php');
        exit();
    }
?>