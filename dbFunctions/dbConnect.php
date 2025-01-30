<?php
    function dbConnection(){
        $conn = new mysqli('127.0.0.1','root','','silicon_dine_hub') or die($conn->connect_error);
        return $conn;
    }
?>