<?php
include 'dbConnect.php'; 
$conn = dbConnection();
try {
    // Prepare the statement
    $stmt = $conn->prepare("SELECT studentID, feedback_type, rating, feedback_text, submitted_at FROM feedback WHERE rating BETWEEN  3 AND 5 ORDER BY submitted_at DESC LIMIT 5");
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();

    $feedbacks = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $feedbacks[] = $row;
        }
    }

    echo json_encode($feedbacks);

    // Close statement
    $stmt->close();

} catch (Exception $e) {
    // Handle exception
    echo json_encode(['error' => $e->getMessage()]);
}

// Close connection
$conn->close();
?>
