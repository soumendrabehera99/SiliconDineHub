<?php
require_once "dbConnect.php";

function addStudent($sic, $email) { 
    $conn = null;
    $stmt = null;
    $stmt1 = null;
    try {
        $conn = dbConnection();
        if ($conn === null) {
            throw new Exception("Database connection failed.");
        }
        $stmt = $conn->prepare("SELECT * FROM sic_email WHERE sic = ?");
        if ($stmt === false) {
            throw new Exception("Failed to prepare SELECT statement.");
        }
        $stmt->bind_param('s', $sic);
        $stmt->execute();
        $res = $stmt->get_result();
        
        if ($res->num_rows > 0) {
            return "present"; // Student already exists
        } else {
            $stmt1 = $conn->prepare("INSERT INTO sic_email(sic, email) VALUES(?, ?)");
            if ($stmt1 === false) {
                throw new Exception("Failed to prepare INSERT statement.");
            }
            $stmt1->bind_param('ss', $sic, $email);
            $stmt1->execute();
            
            if ($conn->affected_rows > 0) {
                return "success"; // Successfully added student
            } else {
                return "error"; // Failed to add student
            }
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        return "error"; // Return detailed error message
    } finally {
        if ($stmt !== null) {
            $stmt->close();
        }
        if ($stmt1 !== null) {
            $stmt1->close();
        }
        if ($conn !== null) {
            $conn->close();
        }
    }
}

function getAllStudents() {
    $conn = null;
    $stmt = null;
    try {
        $conn = dbConnection();
        $stmt = $conn->prepare("SELECT * FROM student");
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
