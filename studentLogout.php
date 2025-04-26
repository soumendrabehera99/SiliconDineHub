<?php
    session_start();

    if(isset($_SESSION['sic'])){
        session_unset();
        session_destroy();
        header("Location: ./index.php");
        exit();
    }
?>