<?php
session_start();
include 'dbConnect.php'; 
$conn = dbConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];

    // Validate inputs
    if (empty($currentPassword) || empty($newPassword)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit;
    }

    // Fetch admin
    $stmt = $conn->prepare("SELECT password FROM admin_table WHERE email = ?");
    $stmt->bind_param("s", $_SESSION['email']);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($storedPassword);
        $stmt->fetch();

        if ($storedPassword === $currentPassword) {
            // Update to new password
            $update = $conn->prepare("UPDATE admin_table SET password = ? WHERE email = ?");
            $update->bind_param("ss", $newPassword, $_SESSION['email']);
            $update->execute();

            echo json_encode(['status' => 'success', 'message' => 'Password changed successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Current password is incorrect.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Admin not found.']);
    }

    $stmt->close();
    $conn->close();
}
?>
