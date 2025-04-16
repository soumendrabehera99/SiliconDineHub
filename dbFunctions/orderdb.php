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
function fetchOrdersByStatus($studentID, $isActive = true) {
    try {
        $conn = dbConnection();
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        if ($isActive) {
            $statusCondition = "o.status IN ('pending', 'ready')";
        } else {
            $statusCondition = "o.status = 'delivered'";
        }

        $query = "SELECT o.*, f.name AS foodName, f.image AS foodImage 
          FROM order_table o 
          JOIN food f ON o.foodID = f.foodID 
          WHERE o.orderID = ? AND $statusCondition
          ORDER BY o.createdAt DESC";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $studentID);
        $stmt->execute();

        $result = $stmt->get_result();
        $orders = [];

        while ($row = $result->fetch_assoc()) {
            error_log("Order Found: " . $row["foodName"]);
            $orders[] = [
                "foodName" => $row["foodName"],
                "foodImage" => $row["foodImage"],
                "createdAt" => $row["createdAt"],
                "status" => $row["status"],
                "price" => $row["price"]
            ];
        }
        

        return $orders;
    } catch (Exception $e) {
        return [];
    }
}

?>