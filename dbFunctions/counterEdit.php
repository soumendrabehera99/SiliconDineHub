<?php
include './dbConnect.php'; 
try {
    if (
        isset($_POST['id']) &&
        isset($_POST['username']) &&
        isset($_POST['password']) &&
        isset($_POST['status'])
    ) {
        $id = $_POST['id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $status = $_POST['status'];

        $conn = dbConnection();

        if (!$conn) {
            throw new Exception("Database connection failed");
        }

        $stmt = $conn->prepare("UPDATE counter_table SET userName=?, password=?, status=? WHERE counterID=?");

        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("ssii", $username, $password, $status, $id);

        if (!$stmt->execute()) {
            throw new Exception("Execution failed: " . $stmt->error);
        }

        if ($stmt->affected_rows > 0) {
            echo "success";
        } else {
            echo "no_change";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "invalid_data";
    }
} catch (Exception $e) {
    echo "error: " . $e->getMessage();
}
?>
