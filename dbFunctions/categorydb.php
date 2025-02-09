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
            echo "Present";
        }else{
            $conn = dbConnection();
            $stmt1 = $conn->prepare("INSERT INTO food_category(category) VALUES(?)");
            $stmt1->bind_param('s',$category);
            $stmt1->execute();
            if($conn->affected_rows > 0){
                echo "success";
            }else{
                echo "error";
            }
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
}

function deleteCategory($id){
    $conn = dbConnection();
    $stmt = $conn->prepare("DELETE FROM food_category where foodCategoryID = ?");
    $stmt->bind_param("i",$id);
    $res= $stmt->execute();
    if($conn->affected_rows > 0){
        echo $res."success";
    }else{
        echo $res."error";
    }
}

function getCategories(){
    $conn = dbConnection();
    $stmt = $conn->prepare("SELECT * FROM food_category");
    $stmt->execute();
    $result = $stmt->get_result();
    if($result-> num_rows > 0){
        echo json_encode($result->fetch_all(MYSQLI_ASSOC));
    }else{
        echo "error";
    }
}

function updateCategory($id,$category){
    $conn = dbConnection();
    $stmt = $conn->prepare("UPDATE food_category set category = ? WHERE foodCategoryID = ?");
    $stmt->bind_param("si",$category,$id);
    $stmt->execute();
    if($conn-> affected_rows > 0){
        echo "success";
    }else{
        echo "error";
    }
}
?>