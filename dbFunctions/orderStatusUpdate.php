<?php
require 'dbConnect.php'; 
require_once "../utils/mail.php";

if (isset($_GET['orderID']) && isset($_GET['status'])) {
    $orderID = $_GET['orderID'];
    $newStatus = $_GET['status'];

    try {
        $conn = dbConnection();

        // Update order status
        $stmt = $conn->prepare("UPDATE order_table SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $newStatus, $orderID);

        if ($stmt->execute()) {

            // Get email, student name, and food name
            $infoQuery = "
                SELECT se.email, s.studentID, s.name AS studentName, f.name AS foodName
                FROM order_table ot
                JOIN student s ON ot.studentID = s.studentID
                JOIN sic_email se ON s.sic = se.sic
                JOIN food f ON ot.foodID = f.foodID
                WHERE ot.orderID = ?
            ";

            $infoStmt = $conn->prepare($infoQuery);
            $infoStmt->bind_param("i", $orderID);
            $infoStmt->execute();
            $result = $infoStmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $toEmail = $row['email'];
                $studentID = $row['studentID'];
                $foodName = $row['foodName'];
                $studentName = $row['studentName'];

                $subject = "Order Status Update";

                if (strtolower($newStatus) === 'ready') {
                    $body = "
                        Hi $studentName,<br><br>
                        Your food order <strong>\"$foodName\"</strong> (Order ID: <strong>$orderID</strong>) is now <strong>ready for pickup</strong>.<br>
                        Please collect it from the counter within 30 minutes.<br><br>
                        <strong>Note:</strong> You must carry your I-Card at the time of pickup.<br><br>
                        Thank you for using Silicon DineHub!
                    ";
                } 
                else if (strtolower($newStatus) === 'delivered') {
                    $body = "
                        Hi $studentName,<br><br>
                        Your food order <strong>\"$foodName\"</strong> (Order ID: <strong>$orderID</strong>) has been <strong>delivered successfully</strong>.<br>
                        We hope you enjoy your meal!<br><br>
                        <strong>Note:</strong> You must carry your I-Card at the time of pickup.<br><br>
                        Thank you for using Silicon DineHub!
                    ";
                }                

                // Send the email
                $response = sendMail($toEmail, $subject, $body);
            } else {
                echo "Student or food info not found for this order.";
            }

            $infoStmt->close();
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
