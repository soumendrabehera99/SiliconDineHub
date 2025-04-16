<?php 
require_once "dbConnect.php";
$conn = dbConnection();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['counterID']) && $_GET['mode'] === 'fetch') {
    $counterID = intval($_GET['counterID']);

    // Fetch all categories assigned to any counter except this one
    $sql = "SELECT fc.foodCategoryID, fc.category 
            FROM food_category fc
            LEFT JOIN counter_category cc 
            ON fc.foodCategoryID = cc.foodCategoryID
            WHERE cc.counterID IS NULL OR cc.counterID = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $counterID);
    $stmt->execute();
    $allResult = $stmt->get_result();

    $allCategories = [];
    while($row = $allResult->fetch_assoc()) {
        $allCategories[] = $row;
    }

    // Fetch assigned categories for this counter
    $assignedQuery = "SELECT foodCategoryID FROM counter_category WHERE counterID = ?";
    $assignedStmt = $conn->prepare($assignedQuery);
    $assignedStmt->bind_param("i", $counterID);
    $assignedStmt->execute();
    $assignedResult = $assignedStmt->get_result();

    $assignedCategories = [];
    while ($row = $assignedResult->fetch_assoc()) {
        $assignedCategories[] = $row['foodCategoryID'];
    }

    echo json_encode([
        'all' => $allCategories,
        'assigned' => $assignedCategories
    ]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $counterID = intval($data['counterID'] ?? 0);
    $categories = $data['categories'] ?? [];

    if (!empty($counterID) && !empty($categories)) {
        // Delete existing categories for this counter
        $deleteStmt = $conn->prepare("DELETE FROM counter_category WHERE counterID = ?");
        $deleteStmt->bind_param("i", $counterID);
        $deleteStmt->execute();

        // Insert new categories
        $stmt = $conn->prepare("INSERT INTO counter_category (counterID, foodCategoryID) VALUES (?, ?)");
        foreach ($categories as $categoryID) {
            $stmt->bind_param("ii", $counterID, $categoryID);
            $stmt->execute();
        }

        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input.']);
    }
    exit;
}

echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
exit;
?>
