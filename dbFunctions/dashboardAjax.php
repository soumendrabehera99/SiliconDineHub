<?php 

include_once "dbConnect.php";

$conn = dbConnection();

// Get the 'operation' parameter
$operation = isset($_GET['operation']) ? $_GET['operation'] : '';

$orderData = [];

if ($operation === 'fetchOrderData') {
    $sql = "SELECT createdAt, SUM(price) AS totalPrice FROM order_table GROUP BY createdAt";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $orderData[] = [
                'createdAt' => $row['createdAt'],
                'price' => (float)$row['totalPrice']
            ];
        }
    }

    echo json_encode($orderData, JSON_PRETTY_PRINT);

} else {
    echo json_encode(['error' => 'Invalid operation'], JSON_PRETTY_PRINT);
}

$conn->close();
?>

