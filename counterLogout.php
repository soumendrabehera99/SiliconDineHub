<?php
    session_start();
    if(isset($_SESSION['counterID'])){
        session_unset();
        session_destroy();
        header("Location: ./counterLogin.php");
        exit();
    }
?>