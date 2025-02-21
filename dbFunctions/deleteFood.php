<?php
require_once "fooddb.php";

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $response = deleteFoodById($id);
    echo $response;
}
?>