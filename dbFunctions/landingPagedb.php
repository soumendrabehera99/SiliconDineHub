<?php 
require_once "dbConnect.php";

function getRandomFoods() {
    $conn = null;
    $stmt = null;
    try {
        $conn = dbConnection();
        
        $sql = "SELECT f.* 
                FROM food f 
                WHERE f.isAvailable = '1' 
                GROUP BY f.foodCategoryID 
                ORDER BY RAND() 
                LIMIT 12";

        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("SQL preparation failed: " . $conn->error);
        }

        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows > 0) {
            return $res;
        } else {
            return "error: No results found";
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        return "error: " . $e->getMessage();
    } finally {
        if ($stmt) {
            $stmt->close();
        }
        if ($conn) {
            $conn->close();
        }
    }
}
function getCategoryNameByFoodId($foodId) {
    $conn = null;
    $stmt = null;
    try {
        $conn = dbConnection();

        $sql = "SELECT category FROM food_category WHERE foodCategoryID = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("SQL preparation failed: " . $conn->error);
        }
        $stmt->bind_param("i", $foodId);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            return $row['category']; // Return the category name
        } else {
            return false; 
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        return false;
    } finally {
        if ($stmt) {
            $stmt->close();
        }
        if ($conn) {
            $conn->close();
        }
    }
}
function getAllCategory() {
    $conn = null;
    $stmt = null;
    try {
        $conn = dbConnection();

        $sql = "SELECT *FROM food_category";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("SQL preparation failed: " . $conn->error);
        }
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows > 0) {
            return $res; 
        } else {
            return false; 
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        return false;
    } finally {
        if ($stmt) {
            $stmt->close();
        }
        if ($conn) {
            $conn->close();
        }
    }
}

function getFoodImageByCategoryId($foodCategoryID) {
    $conn = null;
    $stmt = null;
    try {
        $conn = dbConnection();

        $sql = "SELECT image FROM food WHERE foodCategoryID = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("SQL preparation failed: " . $conn->error);
        }
        $stmt->bind_param("i", $foodCategoryID);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            return $row['image']; // Return the image name
        } else {
            return false; 
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        return false;
    } finally {
        if ($stmt) {
            $stmt->close();
        }
        if ($conn) {
            $conn->close();
        }
    }
}
?>