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

function getTopSellingFood($days) {
    $conn = dbConnection();

    $dateLimit = date("Y-m-d", strtotime("-$days days"));

    $query = "SELECT f.name, f.image, f.price, SUM(o.quantity) as totalSold
              FROM order_table o
              JOIN food f ON o.foodID = f.foodID
              WHERE o.createdAt >= ? AND o.status = 'delivered'
              GROUP BY o.foodID
              ORDER BY totalSold DESC
              LIMIT 5";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $dateLimit);
    $stmt->execute();
    $res = $stmt->get_result();

    $data = [];
    while ($row = $res->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function getLoyalCustomers() {
    $conn = dbConnection();

    $sql = "
    SELECT 
        s.name, 
        s.dob,
        COUNT(o.orderID) AS orderCount,
        COALESCE(SUM(o.price), 0) AS totalSpent
    FROM 
        student s
    INNER JOIN 
        order_table o ON s.sic = o.orderID AND o.status IN ('delivered', 'ready')
    WHERE 
        s.isActive = 1
    GROUP BY 
        o.orderID
    ORDER BY 
        totalSpent DESC
    LIMIT 5
    ";

    $result = $conn->query($sql);
    $customers = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $joinedYear = (new DateTime($row['dob']))->format("Y");

            $totalSpent = (float) $row['totalSpent'];
            
            if ($totalSpent >= 1000) {
                $badge = "VIP";
            } elseif ($totalSpent >= 500) {
                $badge = "Gold";
            } else {
                $badge = "New";
            }

            $customers[] = [
                'name' => $row['name'],
                'joined' => $joinedYear,
                'orders' => $row['orderCount'],
                'spent' => $totalSpent,
                'badge' => $badge
            ];
        }
    }

    return $customers;
}


?>