<?php
require_once "../dbFunctions/fooddb.php";
if($_POST['operation']){
    if($_POST['operation'] == "foodAdd" && isset($_POST["foodName"]) && isset($_POST["categoryID"]) && isset($_FILES["foodImage"]) && isset($_POST["foodDescription"]) && isset($_POST["foodPrice"]) && isset($_POST["foodStatus"])){
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
        if (!empty($uploadedFile)) {
            $response = addFood($categoryID, $foodName, $uploadedFile, $foodDescription, $foodPrice, $foodStatus);
            echo json_encode(["status" => $response]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to upload images"]);
        }
    }else if($_POST['operation'] == "foodGet"){
        $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
        $limit = isset($_POST['limit']) ? (int)$_POST['limit'] : 5;
        $search = isset($_POST['food']) ? $_POST['food'] : '';

        $response = getFoods($search, $page, $limit);

        echo json_encode($response);
    }else if($_POST['operation']== "foodDelete" && isset($_POST['id'])){
        $id = $_POST['id'];
        $imageName = $_POST['imageName'];
        $uploadDir = __DIR__ . "/../uploads/";
        $filePath = $uploadDir . $imageName;
        if($imageName == ""){
            $response = deleteFoodById($id);
            echo $response;
        }else{
            if (file_exists($filePath)) {
                unlink($filePath);
                if(!file_exists($filePath)){
                    $response = deleteFoodById($id);
                    echo $response;
                }
            }
        }
    }else if($_POST['operation']== "foodStatusUpdate" && isset($_POST['id'])){
        $id = $_POST['id'];
        $status = $_POST['status'];
        $response = updateFoodStatus($id,$status);
        echo $response;
    }else if($_POST['operation']== "foodImageUpdate" && isset($_POST['id'])){

        $id = $_POST['id'];
        $previosImageName = $_POST['previosImageName'];
        
        $uploadDir = __DIR__ . "/../uploads/";

        $filePath = $uploadDir . $previosImageName;
        
        if (file_exists($filePath)) {
            unlink($filePath);
            if(!file_exists($filePath)){
                $uploadedFile = "";
        
                if (!empty($_FILES['newFoodImage']['name'])) {  
                    $fileName = basename($_FILES['newFoodImage']['name']);
                    $fileTempPath = $_FILES['newFoodImage']['tmp_name'];
                    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                    $uniqueName = uniqid("food_", true) . '.' . $fileExt;
                    $uploadPath = $uploadDir . $uniqueName;
                    if (move_uploaded_file($fileTempPath, $uploadPath)) {
                        $uploadedFile = $uniqueName;
                    }
                }
                if (!empty($uploadedFile)) {
                    $response = upadateFoodImage($id, $uploadedFile);
                    echo $response;
                } else {
                    echo $response;
                }
            }
        }
    }
}
?>