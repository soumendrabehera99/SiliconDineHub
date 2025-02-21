<?php
require_once "dbConnect.php";
function addFood($categoryID, $foodName, $uploadedFile, $foodDescription, $foodPrice, $foodStatus){
    try{
        $conn = dbConnection();
    
        $stmt = $conn->prepare("SELECT * FROM food WHERE name = ?");
        if (!$stmt) {
            die(json_encode(["error" => "SQL Prepare Failed: " . $conn->error]));
        }
        $stmt->bind_param('s',$foodName);
        if (!$stmt->execute()) {
            die(json_encode(["error" => "SQL Execution Failed: " . $stmt->error]));
        }
        $res = $stmt->get_result();
        if($res->num_rows > 0){
            return "present";
        }else{
            $stmt1 = $conn->prepare("INSERT INTO food(foodCategoryID, name, image, description, price, isAvailable) VALUES(?, ?, ?, ?, ?, ?)");
            $stmt1->bind_param('isssss',$categoryID, $foodName, $uploadedFile, $foodDescription, $foodPrice, $foodStatus);
            $stmt1->execute();
            if($conn->affected_rows > 0){
                return "success";
            }else{
                return "error";
            }
        }
    }catch(Exception $e){
        return $e->getMessage();
    }
}

function deleteFoodById($foodID) {
    $stmt = null;
    $conn = null;
    try {
        $conn = dbConnection();
        $stmt = $conn->prepare("DELETE FROM food WHERE foodID = ?");
        $stmt->bind_param("i", $foodID);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return "success";
        }
        return "error";
    } catch (Exception $e) {
        error_log($e->getMessage());
        return "error";
    } finally {
        $stmt->close();
        $conn->close();
    }
}

function getFoods($search, $pageNo, $limit) {
    $conn = dbConnection();
    $searchTerm = "%". $search ."%";
    $offset = ($pageNo -1) * $limit;

    $countStmt = $conn->prepare("SELECT COUNT(*) AS total from food WHERE name LIKE ?");

    if(!$countStmt){
        die(json_encode(['error'=>"SQL Prepare Failed".$conn->error]));
    }
    
    $countStmt->bind_param("s",$searchTerm);
    if(!$countStmt->execute()){
        die(json_encode(['error'=>"SQL Execution Failed".$countStmt->error]));
    }
    $countResult = $countStmt->get_result();

    $totalPages = ceil($countResult->fetch_assoc()['total']/$limit);

    $stmt = $conn->prepare("
    SELECT f.foodID, f.name, f.price, f.isAvailable, f.foodCategoryID, 
           c.category 
    FROM food f
    LEFT JOIN food_category c ON f.foodCategoryID = c.foodCategoryID
    WHERE f.name LIKE ? 
    ORDER BY f.foodCategoryID IS NOT NULL, f.name ASC 
    LIMIT $limit OFFSET $offset
");

    if(!$stmt){
        die(json_encode(['error'=>"SQL Prepare Failed".$conn->error]));
    }
    
    $stmt->bind_param("s",$searchTerm);
    if(!$stmt->execute()){
        die(json_encode(['error'=>"SQL Execution Failed".$stmt->error]));
    }
    $result = $stmt->get_result();

    $foods = $result->fetch_all(MYSQLI_ASSOC);

    return [
        "foods" => $foods,
        "currentPage" => $pageNo,
        "totalPages" => $totalPages
    ];
}

function getFoodById($id) {
    $conn = dbConnection();

    $stmt = $conn->prepare("
    SELECT f.foodID, f.name, f.price, f.isAvailable, f.foodCategoryID, 
           c.category 
    FROM food f
    LEFT JOIN food_category c ON f.foodCategoryID = c.foodCategoryID
    WHERE f.foodID = ?
");

    if(!$stmt){
        die(json_encode(['error'=>"SQL Prepare Failed".$conn->error]));
    }
    
    $stmt->bind_param("i",$id);
    if(!$stmt->execute()){
        die(json_encode(['error'=>"SQL Execution Failed".$stmt->error]));
    }
    $result = $stmt->get_result();

    $food = $food = $result->fetch_assoc(); 

    return [
        "food" => $foods,
    ];
}

function getCategoryById($categoryID) {
    $conn = null;
    $stmt = null;
    try {
        $conn = dbConnection();
        $stmt = $conn->prepare("SELECT category FROM food_category WHERE foodCategoryID = ?"); 
        $stmt->bind_param("i", $categoryID); // 
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            return $row['category'];
        } else {
            return "Unknown"; 
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        return "Error: " . $e->getMessage();
    } finally {
        if ($stmt) $stmt->close();
        if ($conn) $conn->close();
    }
}

function updateFood($foodId,$categoryId,$foodName,$description,$price,$isAvailable){
    try{
            $conn = dbConnection();
            $stmt = $conn->prepare("SELECT * FROM food WHERE foodID = ?, foodCategoryID = ?, name = ?, description = ?, price = ?, isAvailable = ?");
            if (!$stmt) {
                die(json_encode(["error" => "SQL Prepare Failed: " . $conn->error]));
            }
            $stmt->bind_param('iissss',$foodId,$categoryId,$foodName,$description,$price,$isAvailable);
            if (!$stmt->execute()) {
                die(json_encode(["error" => "SQL Execution Failed: " . $stmt->error]));
            }
            $res = $stmt->get_result();
            if($res->num_rows > 0){
                return "present";
            }else{
                $stmt = $conn->prepare("UPDATE food set foodCategoryID = ?, name = ?, description = ?, price = ?, isAvailable = ? WHERE foodID = ?");
                $stmt->bind_param("issssi",$categoryId,$foodName,$description,$price,$isAvailable,$foodId);
                $stmt->execute();
                if($conn-> affected_rows > 0){
                    return "success";
                }else{
                    return "error";
                }
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
}
function updateFoodStatus($foodId,$isAvailable){
    try{
            $conn = dbConnection();
            $stmt = $conn->prepare("UPDATE food set isAvailable = ? WHERE foodID = ?");
            $stmt->bind_param("si",$isAvailable,$foodId);
            $stmt->execute();
            if($conn-> affected_rows > 0){
                return "success";
            }else{
                return "error";
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
}
?>