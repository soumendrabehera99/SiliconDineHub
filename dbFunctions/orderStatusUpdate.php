<?php
require 'dbConnect.php'; 

if (isset($_GET['orderID']) && isset($_GET['status'])) {
    $orderID = $_GET['orderID'];
    $newStatus = $_GET['status'];

    try {
        $conn = dbConnection();

        $stmt = $conn->prepare("UPDATE order_table SET status = ? WHERE orderID = ?");
        $stmt->bind_param("ss", $newStatus, $orderID);

        if ($stmt->execute()) {
            sleep(2);
            header("Location: ../counterDashboard.php");
            exit();

        } else {
            echo "Failed to update status for Order ID: $orderID.<br>";
        }

        $stmt->close();
        $conn->close();

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid parameters. Make sure orderID and status are set in the URL.<br>";
}
?>
