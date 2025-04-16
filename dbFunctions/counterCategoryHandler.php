<?php
require_once "dbConnect.php";
$conn = dbConnection();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['counterID'])) {

    $counterID = intval($_GET['counterID']);

    if (isset($_GET['editMode']) && $_GET['editMode'] == 1) {
        // Fetch all categories
        $assignedQuery = "SELECT foodCategoryID FROM counter_category WHERE counterID = ?";
        $assignedStmt = $conn->prepare($assignedQuery);
        $assignedStmt->bind_param("i", $counterID);
        $assignedStmt->execute();
        $assignedResult = $assignedStmt->get_result();
    
        $assignedCategories = [];
        while ($row = $assignedResult->fetch_assoc()) {
            $assignedCategories[] = $row['foodCategoryID'];
        }
    
        // Fetch all food categories
        $allCategoriesResult = $conn->query("SELECT * FROM food_category");
        $allCategories = [];
        while ($row = $allCategoriesResult->fetch_assoc()) {
            $allCategories[] = $row;
        }
    
        echo json_encode([
            'all' => $allCategories,
            'assigned' => $assignedCategories
        ]);
        exit;
    } else {
        // Default: Fetch unassigned categories for Add functionality
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
        exit;
    }

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = json_decode(file_get_contents("php://input"), true);
    $counterID = intval($data['counterID'] ?? 0);
    $categories = $data['categories'] ?? [];

    if (!empty($counterID) && !empty($categories)) {

        // If 'mode' is update, clear existing before inserting
        if (isset($data['mode']) && $data['mode'] === "update") {
            $deleteStmt = $conn->prepare("DELETE FROM counter_category WHERE counterID = ?");
            $deleteStmt->bind_param("i", $counterID);
            $deleteStmt->execute();
        }

        // Insert the new category assignments
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

} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit;
}
?>