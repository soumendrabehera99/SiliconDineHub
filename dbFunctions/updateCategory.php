<?php
require_once "categorydb.php";

if(isset($_POST['category']) && isset($_POST['id'])){
    $id = $_POST['id'];
    $category = $_POST['category'];
    $response = updateCategory($id, $category);
    echo $response;
}
?>