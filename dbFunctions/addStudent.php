<?php
require_once "studentdb.php";

if (isset($_POST['sic']) && isset($_POST['email'])) {
    $sic = $_POST['sic'];
    $email = $_POST['email'];

    $response = addStudent($sic, $email);

    echo $response;
}
?>

