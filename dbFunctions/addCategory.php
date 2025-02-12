<?php
require_once "dbConnect.php";
require_once "categorydb.php";

if(isset($_POST['category'])){
    $category = $_POST['categoryName'];
    $response = addCategory($category);
    echo json_encode($response);
}
?>