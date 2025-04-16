<?php
require_once "./dbConnect.php";
$conn = dbConnection();

$data = json_decode(file_get_contents("php://input"), true);
$counterID = $data['counterID'];
$categories = $data['categories'];

if (!empty($counterID) && !empty($categories)) {
    $stmt = $conn->prepare("INSERT INTO counter_category (counterID, foodCategoryID) VALUES (?, ?)");
    foreach ($categories as $categoryID) {
        $stmt->bind_param("ii", $counterID, $categoryID);
        $stmt->execute();
    }
    echo "success";
} else {
    echo "error";
}
?>
