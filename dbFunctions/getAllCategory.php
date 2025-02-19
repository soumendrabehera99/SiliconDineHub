<?php
require_once "categorydb.php";

header('Content-Type: application/json');

$response = getAllCategory();

echo json_encode($response);
?>
