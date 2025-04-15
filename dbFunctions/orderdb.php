<?php
require_once "dbConnect.php";

function placeOrder($orderID,$studentID, $foodID, $quantity, $orderType, $price, $status){
    try {
        $conn = dbConnection();

        $createdAt = date("Y-m-d");
        $updatedAt = date("Y-m-d");

        $stmt = $conn->prepare("INSERT INTO `order_table` (orderID, studentID, foodID, quantity, orderType, price, createdAt, updatedAt, status)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("siissdsss", $orderID, $studentID, $foodID, $quantity, $orderType, $price, $createdAt, $updatedAt, $status);

        $stmt->execute();

        if ($conn->affected_rows > 0) {
            return "success";
        } else {
            return "error";
        }

    } catch (Exception $e) {
        return $e->getMessage();
    }
}

?>