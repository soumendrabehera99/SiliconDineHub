<?php
session_start();
include_once './dbConnect.php';

header('Content-Type: text/plain'); // For easier debugging

try {
    $conn = dbConnection();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo "Invalid request method.";
        exit;
    }

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        echo "Username and password are required.";
        exit;
    }

    $stmt = $conn->prepare("SELECT * FROM counter_table WHERE userName = ? AND password = ?");
    if (!$stmt) {
        echo "SQL Prepare failed: " . $conn->error;
        exit;
    }

    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        echo "Query failed: " . $stmt->error;
        exit;
    }

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if ($row['status'] == 1) {
            $_SESSION['counterID'] = $row['counterID'];
            $_SESSION['userName'] = $row['userName'];
            echo "success";
        } else {
            echo "Your account is inactive.";
        }
    } else {
        echo "Invalid username or password.";
    }

    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    echo "Server error: " . $e->getMessage();
}
