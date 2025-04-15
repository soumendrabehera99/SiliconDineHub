<?php
require_once 'dbConnect.php';

header('Content-Type: application/json');

try {
    $conn = dbConnection();
    $stmt = $conn->prepare("
        SELECT 
            o.*,
            s.name, 
            s.sic, 
            f.name AS foodName     
        FROM order_table o
        JOIN student s ON o.studentID = s.studentID
        JOIN food f ON o.foodID = f.foodID
        WHERE o.status = 'pending' OR o.status = 'ready'
    ");

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