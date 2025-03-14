<?php
    session_start();

    if(isset($_SESSION['email']) && isset($_SESSION['role'])){
        session_unset();
        session_destroy();
        header("location: ./admin/adminLogin.php");
    }else if(isset($_SESSION['sic'])){
        session_unset();
        session_destroy();
        header("Location: ./studentSignIn.php");
        exit();
    }
?>