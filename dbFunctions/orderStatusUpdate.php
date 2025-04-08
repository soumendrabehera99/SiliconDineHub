<?php
require 'dbConnect.php'; 

if (isset($_GET['orderID']) && isset($_GET['status'])) {
    $orderID = $_GET['orderID'];
    $newStatus = $_GET['status'];

    try {
        $conn = dbConnection(); 
        $stmt = $conn->prepare("UPDATE order_table SET status = ? WHERE orderID = ?");
        $stmt->bind_param("si", $newStatus, $orderID);

        if ($stmt->execute()) {
            header("Location: ../counterDashboard.php");
            exit();
        } else {
            echo "Failed to update status.";
        }

        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid parameters.";
}
?>
