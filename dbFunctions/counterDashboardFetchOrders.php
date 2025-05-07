<?php
require_once 'dbConnect.php';
session_start();

header('Content-Type: application/json');

try {
    $counterID = $_SESSION['counterID']; 

    $conn = dbConnection();
    $stmt = $conn->prepare("
        SELECT 
            o.*, 
            COALESCE(s.name, f.name) AS name,
            COALESCE(s.sic, f.sic) AS sic,
            food.name AS foodName
        FROM order_table o
        LEFT JOIN student s ON o.sic = s.sic
        LEFT JOIN faculty f ON o.sic = f.sic
        JOIN food ON o.foodID = food.foodID
        JOIN counter_category cc ON food.foodCategoryID = cc.foodCategoryID
        WHERE cc.counterID = ?
        AND (o.status = 'pending' OR o.status = 'ready')
        AND DATE(o.createdAt) = CURDATE()
        ORDER BY o.id ASC;
    ");

    $stmt->bind_param("i", $counterID);
    $stmt->execute();
    $result = $stmt->get_result();

    $orders = [];
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }

    echo json_encode($orders);

    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>