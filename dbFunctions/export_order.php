<!-- <?php
session_start();
require 'dbConnect.php';

$conn = dbConnection();

if (!isset($_SESSION['sic'])) {
    die("Student not logged in.");
}

$studentID = $_SESSION['sic'];
$fromDate = $_POST['fromDate'] ?? null;
$toDate = $_POST['toDate'] ?? null;
$quickOption = $_POST['quickOption'] ?? null;

$where = "WHERE studentID = ? AND status NOT IN ('pending', 'cancel')";
$params = [$studentID];

if ($fromDate && $toDate) {
    $where .= " AND createdAt BETWEEN ? AND ?";
    array_push($params, $fromDate, $toDate);
} elseif ($quickOption) {
    if ($quickOption === 'lastMonth') {
        $where .= " AND createdAt >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
    } elseif ($quickOption === 'lastWeek') {
        $where .= " AND createdAt >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
    }
}

$stmt = $conn->prepare("SELECT foodID, quantity, orderType, price, createdAt, updatedAt, status FROM order_table $where");
$stmt->bind_param(str_repeat('s', count($params)), ...$params);
$stmt->execute();
$result = $stmt->get_result();

// Get food name
function getFoodNameByFoodId($foodID) {
    global $conn;
    $stmt = $conn->prepare("SELECT foodName FROM food_table WHERE id = ?");
    $stmt->bind_param("i", $foodID);
    $stmt->execute();
    $food = $stmt->get_result()->fetch_assoc();
    return $food['foodName'] ?? 'Unknown';
}

// Get student name
$studentStmt = $conn->prepare("SELECT name FROM students WHERE id = ?");
$studentStmt->bind_param("i", $studentID);
$studentStmt->execute();
$studentData = $studentStmt->get_result()->fetch_assoc();
$studentName = $studentData['name'] ?? 'Unknown Student';

// Set Headers for Excel-friendly download
header("Content-Type: application/vnd.ms-excel");
$exportDate = date('Y-m-d_H-i-s');
header("Content-Disposition: attachment; filename=Order_Statement_{$exportDate}.xls");

// Output table
echo "<table border='1'>";
echo "<tr><th colspan='7'>Order Statement for: {$studentName}</th></tr>";
echo "<tr><th>Food Name</th><th>Quantity</th><th>Order Type</th><th>Price</th><th>Created At</th><th>Updated At</th><th>Status</th></tr>";

while ($order = $result->fetch_assoc()) {
    $foodName = getFoodNameByFoodId($order['foodID']);
    echo "<tr>";
    echo "<td>{$foodName}</td>";
    echo "<td>{$order['quantity']}</td>";
    echo "<td>{$order['orderType']}</td>";
    echo "<td>{$order['price']}</td>";
    echo "<td>{$order['createdAt']}</td>";
    echo "<td>{$order['updatedAt']}</td>";
    echo "<td>" . ucfirst($order['status']) . "</td>";
    echo "</tr>";
}

echo "</table>";
exit;
?> -->
