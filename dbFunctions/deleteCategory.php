<?php
require_once "categorydb.php";

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $response = deleteCategory($id);
    echo $response;
}
?>