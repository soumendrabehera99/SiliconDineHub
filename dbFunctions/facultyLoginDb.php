<?php
require_once 'dbConnect.php';
$conn = dbConnection();
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sic = $_POST['sic'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM faculty WHERE sic = ?");
    $stmt->bind_param("s", $sic);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 0) {
        echo json_encode([
            'status' => 'Not present',
            'message' => 'Faculty not found.'
        ]);
        exit;
    }
    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if ($password === $user['password']) {

            $_SESSION['sic'] = $user['sic'];
            $_SESSION['role'] = 'faculty';

            echo json_encode([
                'status' => 'success',
                'message' => 'Login successful.'
            ]);
        } else {
            echo json_encode([
                'status' => 'passwordError',
                'message' => 'Incorrect password.'
            ]);
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Faculty not found.'
        ]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method.'
    ]);
}
?>
