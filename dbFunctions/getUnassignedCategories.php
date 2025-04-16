<?php
require_once "dbConnect.php";

$counterID = $_GET['counterID'];
$conn = dbConnection();
// Fetch categories not assigned to this counter
$sql = "SELECT * FROM food_category 
        WHERE foodCategoryID NOT IN 
        (SELECT foodCategoryID FROM counter_category WHERE counterID = ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $counterID);
$stmt->execute();
$result = $stmt->get_result();

$categories = [];
while($row = $result->fetch_assoc()) {
    $categories[] = $row;
}

echo json_encode($categories);
?>
