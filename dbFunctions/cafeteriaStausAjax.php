<?php
include_once 'dbConnect.php';
header('Content-Type: application/json');

$conn = dbConnection();

try {
    // Determine operation
    $operation = $_SERVER['REQUEST_METHOD'] === 'GET' 
        ? ($_GET['operation'] ?? '') 
        : (json_decode(file_get_contents("php://input"), true)['operation'] ?? '');

    if ($operation === 'getStatus') {
        $result = $conn->query("SELECT is_open FROM cafeteria_status WHERE id = 1");
        if (!$result) {
            throw new Exception("Query failed: " . $conn->error);
        }

        $row = $result->fetch_assoc();
        echo json_encode(['success' => true, 'is_open' => $row['is_open']]);

    } elseif ($operation === 'update') {
        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data['is_open'])) {
            throw new Exception("Missing 'is_open' value.");
        }

        $is_open = (int)$data['is_open'];
        $stmt = $conn->prepare("UPDATE cafeteria_status SET is_open = ? WHERE id = 1");
        if (!$stmt) {
            throw new Exception("Statement preparation failed: " . $conn->error);
        }

        $stmt->bind_param("i", $is_open);
        if (!$stmt->execute()) {
            throw new Exception("Execution failed: " . $stmt->error);
        }

        echo json_encode(['success' => true, 'message' => 'Cafeteria status updated.']);
        $stmt->close();

    } else {
        throw new Exception("Invalid operation.");
    }

    $conn->close();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
