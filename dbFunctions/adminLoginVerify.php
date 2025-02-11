<?php
session_start();
require_once "dbConnect.php";

try {
    $conn = dbConnection();

    if (!isset($_POST['email']) || !isset($_POST['password'])) {
        throw new Exception("Invalid request");
    }

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $loginQry = "SELECT * FROM admin_table WHERE email=?";
    $stmt = $conn->prepare($loginQry);

    if (!$stmt) {
        throw new Exception("Database error: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    if (!$stmt->execute()) {
        throw new Exception("Query execution failed: " . $stmt->error);
    }

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if ($user['password'] === $password) { 
            $_SESSION['email'] = $email;
            $_SESSION['role'] = "admin";
            echo "success";
        } else {
            echo "Password Incorrect";
        }
    } else {
        echo "Email not registered";
    }

    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
