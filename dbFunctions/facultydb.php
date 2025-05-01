<?php
require_once "dbConnect.php";

function getFacultyByIDFromFaculty($sic){
    try{
        $sic = trim($sic);
        $conn = dbConnection();
        $stmt = $conn->prepare("SELECT * FROM faculty WHERE sic = ?");
        $stmt->bind_param("s",$sic);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return "present";
        }else{
            return "error";
        }
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function getFacultyByIDFromFacultyEmail($facSic) {
    $conn = null;
    $stmt = null;
    
    try {
        $facSic = trim($facSic);

        $conn = dbConnection();

        $stmt = $conn->prepare("SELECT seID, sic, email FROM sic_email WHERE sic = ?");
        
        $stmt->bind_param("s", $facSic);
        
        $stmt->execute();
        
        $res = $stmt->get_result();
        
        if ($res->num_rows > 0) {
            return $res->fetch_assoc();
        } else {
            return "error";
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        return "Error: " . $e->getMessage();
    } finally {
        if ($stmt) {
            $stmt->close();
        }
        if ($conn) {
            $conn->close();
        }
    }
}

function saveFaculty($facSic, $seID, $name, $dob, $password, $isActive = "1") {
    $conn = null;
    $stmt = null;
    
    try {
        $conn = dbConnection();

        $stmt = $conn->prepare("INSERT INTO faculty (sic, seID, name, dob, password, isActive) VALUES (?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("sissss", $facSic, $seID, $name, $dob, $password, $isActive);

        if ($stmt->execute()) {
            return "success";
        } else {
            return "error: " . $stmt->error;
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        return "Error: " . $e->getMessage();
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