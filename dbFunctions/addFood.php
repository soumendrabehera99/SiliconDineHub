<?php
require_once "../dbFunctions/fooddb.php";

if(isset($_POST["foodName"], $_POST["categoryID"], $_FILES["foodImage"], $_POST["foodDescription"], $_POST["foodPrice"], $_POST["foodStatus"])){
    $foodName = $_POST["foodName"];
    $categoryID = $_POST["categoryID"];
    $foodDescription = $_POST["foodDescription"];
    $foodPrice = $_POST["foodPrice"];
    $foodStatus = $_POST["foodStatus"];

    $uploadDir = __DIR__ . "/../uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $uploadedFile = "";

    if (!empty($_FILES['foodImage']['name'])) {  
        $fileName = basename($_FILES['foodImage']['name']);
        $fileTempPath = $_FILES['foodImage']['tmp_name'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $uniqueName = uniqid("food_", true) . '.' . $fileExt;
        $uploadPath = $uploadDir . $uniqueName;
        if (move_uploaded_file($fileTempPath, $uploadPath)) {
            $uploadedFile = $uniqueName;
        }
    }
    if (!empty($uploadedFiles)) {
        $response = addFood($categoryID, $foodName, json_encode($uploadedFiles), $foodDescription, $foodPrice, $foodStatus);
        echo json_encode(["status" => $response]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to upload images"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Missing required fields"]);
}
?>