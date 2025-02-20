<?php
require_once "../dbFunctions/fooddb.php";

// Function to generate a UUID
function generateUUID() {
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}

if(isset($_POST["foodName"], $_POST["categoryName"], $_FILES["foodImage"], $_POST["foodDescription"], $_POST["foodPrice"], $_POST["foodStatus"])){
    $foodName = $_POST["foodName"];
    $categoryName = $_POST["categoryName"];
    $foodDescription = $_POST["foodDescription"];
    $foodPrice = $_POST["foodPrice"];
    $foodStatus = $_POST["foodStatus"];

    $foodImage = $_FILES['foodImage'];
    $fileTmp = $foodImage['tmp_name'];
    $fileExt = strtolower(pathinfo($foodImage['name'], PATHINFO_EXTENSION));

    // Generate UUID and rename file
    $uuid = generateUUID();
    $newFileName = $uuid . '.' . $fileExt;

    // Create upload directory if it doesn't exist
    $uploadDir = __DIR__ . "/../uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $destination = $uploadDir . $newFileName;

    if (move_uploaded_file($fileTmp, $destination)) {
        $response = addFood($categoryName, $foodName, $newFileName, $foodDescription, $foodPrice, $foodStatus);
        echo json_encode(["status" => $response]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to upload image"]);
    }    
} else {
    echo json_encode(["status" => "error", "message" => "Missing required fields"]);
}
?>