<?php
header('Content-Type: application/json');
include_once './dbConnect.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $conn = dbConnection();

    if ($conn->connect_error) {
        throw new Exception("Database connection failed: " . $conn->connect_error);
    }

    if (!isset($_POST['username']) || !isset($_POST['password'])) {
        throw new Exception("Missing required POST data.");
    }

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $status = 1;

    // Check if username already exists
    $check = $conn->prepare("SELECT * FROM counter_table WHERE userName = ?");
    if (!$check) {
        throw new Exception("Prepare statement for checking username failed: " . $conn->error);
    }
    $check->bind_param("s", $username);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["status" => "error", "message" => "Username already exists."]);
    } else {
        $insert = $conn->prepare("INSERT INTO counter_table (userName, password, status) VALUES (?, ?, ?)");
        if (!$insert) {
            throw new Exception("Prepare statement for insert failed: " . $conn->error);
        }
        $insert->bind_param("ssi", $username, $password, $status);

        if ($insert->execute()) {
            echo json_encode(["status" => "success", "message" => "Record added successfully."]);
        } else {
            throw new Exception("Execution of insert failed: " . $insert->error);
        }
    }

    $conn->close();
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
