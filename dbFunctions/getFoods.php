<?php
require_once "fooddb.php";

header('Content-Type: application/json');

$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$limit = isset($_POST['limit']) ? (int)$_POST['limit'] : 5;
$search = isset($_POST['food']) ? $_POST['food'] : '';

$response = getFoods($search, $page, $limit);

echo json_encode($response);
?>