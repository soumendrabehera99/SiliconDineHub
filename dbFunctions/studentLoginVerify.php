<?php
session_start();
require_once "dbConnect.php";

try {
    $conn = dbConnection();

    if (!isset($_POST['sic']) || !isset($_POST['password'])) {
        throw new Exception("Invalid request");
    }

    $sic = trim($_POST['sic']);
    $password = trim($_POST['password']);

    $loginQry = "SELECT * FROM student WHERE sic=?";
    $stmt = $conn->prepare($loginQry);

    if (!$stmt) {
        throw new Exception("Database error: " . $conn->error);
    }

    $stmt->bind_param("s", $sic);
    if (!$stmt->execute()) {
        throw new Exception("Query execution failed: " . $stmt->error);
    }

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if ($user['password'] === $password) { 
            $_SESSION['sic'] = $sic;
            $_SESSION['role'] = "student";
            echo "success";
        } else {
            echo "Password Incorrect";
        }
    } else {
        echo "sic not registered";
    }

    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
