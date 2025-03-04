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
        
        // Check if SIC already exists
        $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM sic_email WHERE sic = ?");
        if (!$stmt) {
            throw new Exception("Failed to prepare SELECT statement.");
        }
        $stmt->bind_param('s', $sic);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close(); // Close SELECT query
        
        if ($count > 0) {
            return "present"; // SIC already exists
        }

        // Insert new student
        $stmt1 = $conn->prepare("INSERT INTO sic_email (sic, email) VALUES (?, ?)");
        if (!$stmt1) {
            throw new Exception("Failed to prepare INSERT statement.");
        }
        $stmt1->bind_param('ss', $sic, $email);
        $stmt1->execute();
        
        return ($conn->affected_rows > 0) ? "success" : "error";
        
    } catch (Exception $e) {
        error_log($e->getMessage());
        return "error"; 
    } finally {
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

function getAllSicEmail() {
    $conn = null;
    $stmt = null;
    try {
        $conn = dbConnection();
        $stmt = $conn->prepare("SELECT * FROM sic_email");
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

function totalNoOfSicEmail() {
    $conn = null;
    $stmt = null;
    try {
        $conn = dbConnection();
        $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM sic_email");
        $stmt->execute();
        $res = $stmt->get_result();
        
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc(); 
            return $row['total']; 
        } else {
            return "0"; 
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        return "error: " . $e->getMessage();
    } finally {
        if ($stmt !== null) {
            $stmt->close();
        }
        if ($conn !== null) {
            $conn->close();
        }
    }
}

function totalNoOfStudents() {
    $conn = null;
    $stmt = null;
    try {
        $conn = dbConnection();
        $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM student");
        $stmt->execute();
        $res = $stmt->get_result();
        
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc(); 
            return $row['total']; 
        } else {
            return "0"; 
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        return "error: " . $e->getMessage();
    } finally {
        if ($stmt !== null) {
            $stmt->close();
        }
        if ($conn !== null) {
            $conn->close();
        }
    }
}

function getExistingSics($sicList){
    $conn = null;
    $stmt = null;
    try {
        $conn = dbConnection();
        if ($conn === null) {
            throw new Exception("Database connection failed.");
        }

        $placeHolder = implode(",", array_fill(0,count($sicList),"?"));
        $stmt = $conn->prepare("SELECT sic FROM sic_email WHERE sic IN ($placeHolder)");

        if (!$stmt) {
            throw new Exception("Failed to prepare SELECT statement.");
        }

        $stmt->bind_param(str_repeat('s', count($sicList)), ...$sicList);
        $stmt->execute();
        $result = $stmt->get_result();

        $existingSICs = [];
        while ($row = $result->fetch_assoc()) {
            $existingSICs[] = $row['sic'];
        }

        return $existingSICs;
    } catch (Exception $e) {
        error_log($e->getMessage());
        return [];
    } finally {
        if ($stmt !== null) {
            $stmt->close();
        }
        if ($conn !== null) {
            $conn->close();
        }
    }
}
?>
