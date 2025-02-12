<?php
require_once "categorydb.php";

if(isset($_POST['category'])){
    $category = $_POST['category'];
    $response = addCategory($category);
    echo $response;
}
?>