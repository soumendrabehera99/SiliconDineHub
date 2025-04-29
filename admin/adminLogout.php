<?php
    session_start();

    if(isset($_SESSION['email']) && isset($_SESSION['role'])){
        session_unset();
        session_destroy();
        header("location: ./adminLogin.php");
    }
?>