<?php
require_once "dbConnect.php";
function addCategory($category){
    try{
        $conn = dbConnection();
    
        $stmt = $conn->prepare("SELECT * FROM food_category WHERE category = ?");
        if (!$stmt) {
            die(json_encode(["error" => "SQL Prepare Failed: " . $conn->error]));
        }
        $stmt->bind_param('s',$category);
        if (!$stmt->execute()) {
            die(json_encode(["error" => "SQL Execution Failed: " . $stmt->error]));
        }
        $res = $stmt->get_result();
        if($res->num_rows > 0){
            return "present";
        }else{
            $stmt1 = $conn->prepare("INSERT INTO food_category(category) VALUES(?)");
            $stmt1->bind_param('s',$category);
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

function deleteCategory($id){
    $conn = dbConnection();
    $stmt = $conn->prepare("DELETE FROM food_category where foodCategoryID = ?");
    if (!$stmt) {
        die(json_encode(["error" => "SQL Prepare Failed: " . $conn->error]));
    }
    $stmt->bind_param("i",$id);
    if (!$stmt->execute()) {
        die(json_encode(["error" => "SQL Execution Failed: " . $stmt->error]));
    }
    if($conn->affected_rows > 0){
        return "success";
    }else{
        return "error";
    }
}

function getCategories($search, $pageNo, $limit) {
    $conn = dbConnection();
    $searchTerm = "%". $search ."%";
    $offset = ($pageNo -1) * $limit;

    $countStmt = $conn->prepare("SELECT COUNT(*) AS total from food_category WHERE category LIKE ?");

    if(!$countStmt){
        die(json_encode(['error'=>"SQL Prepare Failed".$conn->error]));
    }
    
    $countStmt->bind_param("s",$searchTerm);
    if(!$countStmt->execute()){
        die(json_encode(['error'=>"SQL Execution Failed".$countStmt->error]));
    }
    $countResult = $countStmt->get_result();

    $totalPages = ceil($countResult->fetch_assoc()['total']/$limit);

    $stmt = $conn->prepare("SELECT *  FROM food_category WHERE category LIKE ? ORDER BY category LIMIT $limit OFFSET $offset");

    if(!$stmt){
        die(json_encode(['error'=>"SQL Prepare Failed".$conn->error]));
    }
    
    $stmt->bind_param("s",$searchTerm);
    if(!$stmt->execute()){
        die(json_encode(['error'=>"SQL Execution Failed".$stmt->error]));
    }
    $result = $stmt->get_result();

    $categories = $result->fetch_all(MYSQLI_ASSOC);

    return [
        "categories" => $categories,
        "currentPage" => $pageNo,
        "totalPages" => $totalPages
    ];
}

function updateCategory($id,$category){
    try{
            $conn = dbConnection();
            $stmt = $conn->prepare("SELECT * FROM food_category WHERE category = ?");
            if (!$stmt) {
                die(json_encode(["error" => "SQL Prepare Failed: " . $conn->error]));
            }
            $stmt->bind_param('s',$category);
            if (!$stmt->execute()) {
                die(json_encode(["error" => "SQL Execution Failed: " . $stmt->error]));
            }
            $res = $stmt->get_result();
            if($res->num_rows > 0){
                return "present";
            }else{
                $stmt = $conn->prepare("UPDATE food_category set category = ? WHERE foodCategoryID = ?");
                $stmt->bind_param("si",$category,$id);
                $stmt->execute();
                if($conn-> affected_rows > 0){
                    return "success";
                }else{
                    return "error";
                }
            }
        } catch (Excption $e) {
            return $e->getMessage();
        }
}
?>