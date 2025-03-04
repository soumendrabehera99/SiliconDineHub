<?php
require_once "studentdb.php";
if(isset($_POST['operation'])){
    if (isset($_POST['sic']) && isset($_POST['email']) && $_POST['operation']== "studentAdd") {
        $sic = $_POST['sic'];
        $email = $_POST['email'];

        $response = addStudent($sic, $email);

        echo $response;
    }
}
?>

