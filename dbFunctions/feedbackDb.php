<?php
session_start();
include_once 'dbConnect.php';
include_once 'studentdb.php';
$conn = dbConnection(); 
try {

    // Only POST method allowed
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Invalid request method.");
    }

    $studentID = getStudentStudentIDBySic($_SESSION['sic']);
    $feedback_type = htmlspecialchars(trim($_POST['feedback_type']));
    $rating = intval($_POST['rating']);
    $feedback_text = htmlspecialchars(trim($_POST['feedback']));

    // Prepare SQL
    $stmt = $conn->prepare("INSERT INTO feedback (studentID, feedback_type, rating, feedback_text) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("isis", $studentID, $feedback_type, $rating, $feedback_text);

    if (!$stmt->execute()) {
        throw new Exception("Execute failed: " . $stmt->error);
    }

    echo "success";
} catch (Exception $e) {
    http_response_code(400); 
    echo $e->getMessage();
}
?>
