<?php
require_once "../dbFunctions/orderdb.php";

if ($_POST['operation'] == "placeOrder") {
    $orderID = $_POST["orderID"];
    $studentID = $_POST["studentID"];
    $foodID = $_POST["foodID"];
    $quantity = $_POST["quantity"];
    $orderType = $_POST["orderType"];
    $price = $_POST["price"];
    $status = $_POST["status"];

    $result = placeOrder($orderID,$studentID, $foodID, $quantity, $orderType, $price, $status);
    echo json_encode(["result" => $result]);
}

?>