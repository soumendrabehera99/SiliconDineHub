<?php
include_once './dbConnect.php';

header('Content-Type: application/json');

try {
    if (!isset($_GET['id']) || !isset($_GET['status'])) {
        throw new Exception("Missing required parameters.");
    }

    $id = intval($_GET['id']);
    $currentStatus = intval($_GET['status']);
    $newStatus = $currentStatus ? 0 : 1;

    $conn = dbConnection();

    if ($conn->connect_error) {
        throw new Exception("Database connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("UPDATE counter_table SET status = ? WHERE counterID = ?");
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ii", $newStatus, $id);

    if (!$stmt->execute()) {
        throw new Exception("Execution failed: " . $stmt->error);
    }

    header("Location: ../admin/counterManage.php?status=updated");
    exit();

} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
