<?php
require_once 'dbConnect.php';
require_once 'studentdb.php'; // Ensure this contains getNameByStudentId($studentID)

function fetchFeedBacks(){
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

        return json_encode([
            'success' => true,
            'data' => $feedback
        ]);

    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }
}

function fetchAnalyticsFeedBacks($days) {
    $conn = dbConnection();

    try {
        $feedback = [];

        // GOOD Feedback (rating > 3)
        $sqlGood = "SELECT studentID, feedback_type, rating, feedback_text 
                    FROM feedback 
                    WHERE rating > 3 AND submitted_at >= DATE_SUB(NOW(), INTERVAL ? DAY) 
                    ORDER BY submitted_at DESC 
                    LIMIT 5";

        $stmtGood = $conn->prepare($sqlGood);
        $stmtGood->bind_param("i", $days);
        $stmtGood->execute();
        $resultGood = $stmtGood->get_result();

        $good = [];
        while ($row = $resultGood->fetch_assoc()) {
            $row['student_name'] = getStudentNameByStudentID($row['studentID']);
            $good[] = $row;
        }

        // BAD Feedback (rating <= 3)
        $sqlBad = "SELECT studentID, feedback_type, rating, feedback_text 
                   FROM feedback 
                   WHERE rating <= 3 AND submitted_at >= DATE_SUB(NOW(), INTERVAL ? DAY) 
                   ORDER BY submitted_at DESC 
                   LIMIT 5";

        $stmtBad = $conn->prepare($sqlBad);
        $stmtBad->bind_param("i", $days);
        $stmtBad->execute();
        $resultBad = $stmtBad->get_result();

        $bad = [];
        while ($row = $resultBad->fetch_assoc()) {
            $row['student_name'] = getStudentNameByStudentID($row['studentID']);
            $bad[] = $row;
        }

        return json_encode([
            'success' => true,
            'good' => $good,
            'bad' => $bad
        ]);
    } catch (Exception $e) {
        return json_encode([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }
}

?>

