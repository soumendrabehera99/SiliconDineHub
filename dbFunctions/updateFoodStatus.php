<?php
require_once "fooddb.php";

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $status = $_POST['status'];
    $response = updateFoodStatus($id,$status);
    echo $response;
}
?>