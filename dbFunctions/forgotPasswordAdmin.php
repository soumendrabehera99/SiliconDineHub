<?php
session_start();
require_once "dbConnect.php";

try {
    $conn = dbConnection();

    $otp = trim($_POST['otp'] ?? '');
    $newPassword = trim($_POST['newPassword'] ?? '');
    $email = trim($_SESSION['email'] ?? '');

    if (!isset($_SESSION['otp'])) {
        echo json_encode(["status" => "error", "message" => "OTP session not set"]);
        exit;
    }

    if (empty($otp) || empty($newPassword) || empty($email)) {
        echo json_encode(["status" => "error", "message" => "All fields are required"]);
        exit;
    }

    if ($otp != $_SESSION['otp']) {
        echo json_encode(["status" => "Otp mismatch", "message" => "Incorrect OTP"]);
        exit;
    }

    $SqlQuery = "UPDATE admin_table SET password = ? WHERE email = ?";
    $stmt = $conn->prepare($SqlQuery);

    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => "Database error: " . $conn->error]);
        exit;
    }

    $stmt->bind_param("ss", $newPassword, $email);

    if (!$stmt->execute()) {
        echo json_encode(["status" => "error", "message" => "Query execution failed: " . $stmt->error]);
        exit;
    }

    if ($stmt->affected_rows > 0) {
        echo json_encode(["status" => "success", "message" => "Password updated successfully"]);
    } else {
        echo json_encode(["status" => "Not found", "message" => "Email not registered or no changes made"]);
    }

    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
