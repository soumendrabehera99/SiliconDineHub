<?php
require_once "dbConnect.php";
function addCategory($category){
    try{
        $conn = dbConnection();
    
        $stmt = $conn->prepare("SELECT * FROM food_category WHERE category = ?");
        $stmt->bind_param('s',$category);
        $stmt->execute();
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
    $stmt->bind_param("i",$id);
    $res= $stmt->execute();
    if($conn->affected_rows > 0){
        return "success";
    }else{
        return "error";
    }
}

function getCategories(){
    $conn = dbConnection();
    $stmt = $conn->prepare("SELECT * FROM food_category ORDER BY category");
    $stmt->execute();
    $result = $stmt->get_result();
    if($result-> num_rows > 0){
        return $result->fetch_all(MYSQLI_ASSOC);
    }else{
        return "error";
    }
}

function updateCategory($id,$category){
    $conn = dbConnection();
    $stmt = $conn->prepare("SELECT * FROM food_category WHERE category = ?");
        $stmt->bind_param('s',$category);
        $stmt->execute();
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
}
?>