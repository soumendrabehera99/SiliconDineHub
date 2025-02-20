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

    $uploadedFiles = [];

    // Check if multiple images are uploaded or just one
    if(is_array($_FILES['foodImage']['name'])) {  
        $photoCount = count($_FILES['foodImage']['name']);

        for($i = 0; $i < $photoCount; $i++){
            $fileName = basename($_FILES['foodImage']['name'][$i]);
            $fileTempPath = $_FILES['foodImage']['tmp_name'][$i];
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            $uniqueName = uniqid("Property_", true) . '.' . $fileExt;
            $uploadPath = $uploadDir . $uniqueName;

            if (move_uploaded_file($fileTempPath, $uploadPath)) {
                $uploadedFiles[] = $uniqueName;
            }
        }
    } else {  
        // Single file upload case
        $fileName = basename($_FILES['foodImage']['name']);
        $fileTempPath = $_FILES['foodImage']['tmp_name'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $uniqueName = uniqid("food_", true) . '.' . $fileExt;
        $uploadPath = $uploadDir . $uniqueName;

        if (move_uploaded_file($fileTempPath, $uploadPath)) {
            $uploadedFiles[] = $uniqueName;
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