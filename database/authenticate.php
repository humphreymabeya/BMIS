<?php
    if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
        header("location: ../../admin/login.php");
        exit();
    }
?>