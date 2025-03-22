<?php
    session_start();
    
    if(isset($_SESSION['email']) && isset($_SESSION['otp'])){
        session_unset();
        session_destroy();
    }
?>