<?php
    session_start();

    if(isset($_SESSION['email']) && isset($_SESSION['role'])){
        session_unset();
        session_destroy();
        header("location: ./admin/adminLogin.php");
    }else if(isset($_SESSION['sic'])){
        session_unset();
        session_destroy();
        header("Location: ./index.php");
        exit();
    }else if(isset($_SESSION['counterID'])){
        session_unset();
        session_destroy();
        header("Location: ./counterLogin.php");
        exit();
    }
?>