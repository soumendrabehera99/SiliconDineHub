<?php
require_once "dbConnect.php";

function addStudent($sic, $email) {
    $conn = null;
    $stmt = null;
    $stmt1 = null;
    try {
        $conn = dbConnection();
        $stmt = $conn->prepare("SELECT * FROM sic_email WHERE sic = ?");
        $stmt->bind_param('s', $sic);
        $stmt->execute();
        $res = $stmt->get_result();
        
        if ($res->num_rows > 0) {
            return "present";
        } else {
            $stmt1 = $conn->prepare("INSERT INTO sic_email(sic, email) VALUES(?, ?)");
            $stmt1->bind_param('ss', $sic, $email);
            $stmt1->execute();
            
            if ($conn->affected_rows > 0) {
                return "success";
            } else {
                return "error";
            }
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        return "error: " . $e->getMessage();
    } finally{
        $stmt1->close();
        $stmt->close();
        $conn->close();
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
