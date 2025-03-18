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
    SELECT f.*, c.category 
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
    SELECT f.*, c.category 
    FROM food f LEFT JOIN food_category c ON f.foodCategoryID = c.foodCategoryID
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

    $food = $result->fetch_assoc(); 

    return  $food;
}

function updateFood($foodId,$categoryId,$foodName,$description,$price,$isAvailable){
    try{
            $conn = dbConnection();
            $stmt = $conn->prepare("SELECT * FROM food WHERE foodID = ? AND foodCategoryID = ? AND name = ? AND description = ? AND price = ? AND isAvailable = ?");
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
function upadateFoodImage($foodId,$imageName){
    try{
        $conn = dbConnection();
        $stmt = $conn->prepare("UPDATE food set image = ? WHERE foodID = ?");
        $stmt->bind_param("si",$imageName,$foodId);
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

function getAllFood($categoryID, $search, $pageNo, $limit) {
    $conn = dbConnection();
    $searchTerm = "%" . $search . "%";
    $offset = ($pageNo - 1) * $limit;

    $whereClause = "WHERE f.isAvailable = 1 AND f.name LIKE ?";
    
    $params = ["s", &$searchTerm];

    if (!empty($categoryID)) {
        $whereClause .= " AND f.foodCategoryID = ?";
        $params[0] .= "i"; 
        $params[] = &$categoryID;
    }

    $countQuery = "SELECT COUNT(*) AS total FROM food f $whereClause";
    $countStmt = $conn->prepare($countQuery);
    
    if (!$countStmt) {
        die(json_encode(['error' => "SQL Prepare Failed: " . $conn->error]));
    }

    $countStmt->bind_param(...$params);
    
    if (!$countStmt->execute()) {
        die(json_encode(['error' => "SQL Execution Failed: " . $countStmt->error]));
    }

    $countResult = $countStmt->get_result();
    $totalPages = ceil($countResult->fetch_assoc()['total'] / $limit);

    // Query to fetch filtered food items
    $query = "SELECT f.*, c.category 
              FROM food f 
              LEFT JOIN food_category c ON f.foodCategoryID = c.foodCategoryID 
              $whereClause 
              ORDER BY f.foodCategoryID IS NOT NULL, f.name ASC 
              LIMIT ? OFFSET ?";

    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die(json_encode(['error' => "SQL Prepare Failed: " . $conn->error]));
    }

    // Add limit and offset to bind parameters
    $params[0] .= "ii";
    $params[] = &$limit;
    $params[] = &$offset;
    
    $stmt->bind_param(...$params);

    if (!$stmt->execute()) {
        die(json_encode(['error' => "SQL Execution Failed: " . $stmt->error]));
    }

    $result = $stmt->get_result();
    $foods = $result->fetch_all(MYSQLI_ASSOC);

    return [
        "foods" => $foods,
        "currentPage" => $pageNo,
        "totalPages" => $totalPages
    ];
}

?>