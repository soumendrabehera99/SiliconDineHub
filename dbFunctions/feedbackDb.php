<?php
require_once 'dbConnect.php';
require_once 'studentdb.php'; // Ensure this contains getNameByStudentId($studentID)
header('Content-Type: application/json');

$conn = dbConnection(); 

try {

    // Query top 6 feedbacks with rating > 3
    $sql = "SELECT studentID, feedback_type, rating, feedback_text 
            FROM feedback 
            WHERE rating > 3 
            ORDER BY submitted_at DESC 
            LIMIT 6";

    $result = $conn->query($sql);

    if (!$result) {
        throw new Exception("Query failed: " . $conn->error);
    }

    $feedback = [];
    while ($row = $result->fetch_assoc()) {
        $studentName = getStudentNameByStudentID($row['studentID']); // Call function from studentDb
        $row['student_name'] = $studentName;
        $feedback[] = $row;
    }

    echo json_encode([
        'success' => true,
        'data' => $feedback
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}

