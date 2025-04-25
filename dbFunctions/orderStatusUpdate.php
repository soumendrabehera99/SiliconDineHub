<?php
require 'dbConnect.php'; 

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $newStatus = $_GET['status'];

    try {
        $conn = dbConnection();

        date_default_timezone_set('Asia/Kolkata');

        $updatedAt = date("Y-m-d H:i:s");

        $stmt = $conn->prepare("UPDATE order_table SET status = ?, updatedAt = ? WHERE id = ?");
        $stmt->bind_param("ssi", $newStatus, $updatedAt, $id);

        if ($stmt->execute()) {
            sleep(2);
            header("Location: ../counterDashboard.php");
            exit();
        } else {
            echo "Failed to update status for Order ID: $id.<br>";
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
