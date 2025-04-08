<?php
include_once "dbConnect.php";

function totalOrder() {
    $conn = null;
    $stmt = null;
    try {
        $conn = dbConnection();

        $stmt = $conn->prepare("SELECT COUNT(*) AS totalOrder FROM order_table WHERE status = 'delivered'");

        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['totalOrder'];
        } else {
            return 0;
        }
    } catch (Exception $e) {
        error_log("Error in totalOrder: " . $e->getMessage());
        return 0; 
    } finally {
        if (isset($stmt)) { 
            $stmt->close();
        }
        if (isset($conn)) {
            $conn->close();
        }
    }
}

function getAllOrders() {
    $conn = null;
    $stmt = null;
    try {
        $conn = dbConnection();
        $stmt = $conn->prepare("SELECT * FROM order_table ORDER BY createdAt DESC");
        $stmt->execute();
        $res = $stmt->get_result();
        if($res->num_rows>0){
            return $res;
        }else{
            return "error";
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        return "error: " . $e->getMessage();
    } finally{
        $stmt->close();
        $conn->close();
    }
}

?>