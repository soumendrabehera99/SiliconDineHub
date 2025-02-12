<?php
    session_start();

    if(isset($_SESSION['email']) && isset($_SESSION['role'])){
        header("location: ./admin/adminLogin.php");
    }else{
        header("location: ./admin/userLogin.php");
    }
?>