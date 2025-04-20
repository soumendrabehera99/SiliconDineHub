<?php
session_start();
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
} else if ($_POST['operation'] == "fetchActiveOrders") {
    $studentID = $_SESSION["sic"];
    if (!isset($_SESSION["sic"])) {
        echo json_encode(["error" => "Session expired"]);
        exit;
    }    
    $orders = fetchOrdersByStatus($studentID, true);
    echo json_encode($orders);
} else if ($_POST['operation'] == "fetchPreviousOrders") {
    $studentID = $_SESSION["sic"];
    if (!isset($_SESSION["sic"])) {
        echo json_encode(["error" => "Session expired"]);
        exit;
    }
    $orders = fetchOrdersByStatus($studentID, false);
    echo json_encode($orders);
}else if ($_POST['operation'] == "fetchTopSellingFood") {
    $days = intval($_POST["days"]);
    $result = getTopSellingFood($days);
    echo json_encode($result);
}else if($_POST['operation'] == "fetchLoyalCustomer"){
    $customers = getLoyalCustomers();
    echo json_encode($customers);
}

?>