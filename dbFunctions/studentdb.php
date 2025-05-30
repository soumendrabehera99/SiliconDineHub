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
        $stmt = $conn->prepare("SELECT s.seID, s.name, s.sic, s.dob,s.isActive, s.studentID, se.email FROM student s LEFT JOIN sic_email se ON s.seID = se.seID ORDER BY s.sic");
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

function deleteValidCustomerById($id) {
    $conn = null;
    $stmt = null;

    try {
        $conn = dbConnection(); 
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid ID provided.");
        }
        $stmt = $conn->prepare("DELETE FROM sic_email WHERE seID = ?");
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }
        $stmt->bind_param("i", $id);

        if (!$stmt->execute()) {
            throw new Exception("Error executing delete query: " . $stmt->error);
        }
        if ($stmt->affected_rows > 0) {
            return true; // Successfully deleted
        } else {
            return false; // No rows deleted (invalid ID)
        }

    } catch (Exception $e) {
        error_log("Delete Error: " . $e->getMessage());
        return false; 
    } finally {
        if ($stmt !== null) {
            $stmt->close();
        }
        if ($conn !== null) {
            $conn->close();
        }
    }
}

function blockStudentById($id) {
    $conn = null;
    $stmt = null;

    try {
        $conn = dbConnection(); 

        $stmt = $conn->prepare("UPDATE student SET isActive = 0 WHERE seID = ?");
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }

        $stmt->bind_param("i", $id);

        if (!$stmt->execute()) {
            throw new Exception("Error executing update query: " . $stmt->error);
        }

        if ($stmt->affected_rows > 0) {
            return ["success" => true, "message" => "Student blocked successfully."];
        } else {
            return ["success" => false, "message" => "No record found with the given ID."];
        }

    } catch (Exception $e) {
        error_log("Block Student Error: " . $e->getMessage());
        return ["success" => false, "message" => "Error: " . $e->getMessage()];
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
function updateSicEmail($id, $sic, $email) { 
    $conn = null;
    $stmt = null;
    $stmt1 = null;
    try {
        $conn = dbConnection();
        if ($conn === null) {
            throw new Exception("Database connection failed.");
        }
        
        $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM sic_email WHERE sic = ? AND email = ?");
        if (!$stmt) {
            throw new Exception("Failed to prepare SELECT statement.");
        }
        $stmt->bind_param('ss', $sic, $email);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close(); 
        if ($count > 0) {
            return "present";
        }

        $stmt1 = $conn->prepare("UPDATE sic_email set sic = ?, email = ? WHERE seID = ?");
        if (!$stmt1) {
            throw new Exception("Failed to prepare INSERT statement.");
        }
        $stmt1->bind_param('ssi', $sic, $email, $id);
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

function getStudentByEmail($email,$password) {
    $conn = dbConnection();

    $stmt = $conn->prepare("
    SELECT s.* FROM student s JOIN sic_email se ON s.sic = se.sic WHERE se.email = ? AND s.password = ?");

    if(!$stmt){
        die(json_encode(['error'=>"SQL Prepare Failed".$conn->error]));
    }
    
    $stmt->bind_param("ss",$email,$password);
    if(!$stmt->execute()){
        die(json_encode(['error'=>"SQL Execution Failed".$stmt->error]));
    }
    $result = $stmt->get_result();

    $student = $result->fetch_assoc(); 

    return  $student;
}
function updateStudentStatus($studentId,$isActive){
    try{
            $conn = dbConnection();
            $stmt = $conn->prepare("UPDATE student SET isActive = ? WHERE studentID = ?");
            $stmt->bind_param("si",$isActive,$studentId);
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
function getStudentBySicFromStudent($sic){
    try{
        $sic = trim($sic);
        $conn = dbConnection();
        $stmt = $conn->prepare("SELECT * FROM student WHERE sic = ?");
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
function getStudentBySicFromSicEmail($sic) {
    $conn = null;
    $stmt = null;
    
    try {
        $sic = trim($sic);

        $conn = dbConnection();

        $stmt = $conn->prepare("SELECT seID, sic, email FROM sic_email WHERE sic = ?");
        
        $stmt->bind_param("s", $sic);
        
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

function saveStudent($sic, $seID, $name, $dob, $password, $isActive = "1") {
    $conn = null;
    $stmt = null;
    
    try {
        $conn = dbConnection();

        $stmt = $conn->prepare("INSERT INTO student (sic, seID, name, dob, password, isActive) VALUES (?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("sissss", $sic, $seID, $name, $dob, $password, $isActive);

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

function getStudentBySic($sic){
    try{
        $sic = trim($sic);
        $conn = dbConnection();
        $stmt = $conn->prepare("SELECT sic, name, studentID FROM student WHERE sic = ?");
        $stmt->bind_param("s",$sic);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }else{
            return "error";
        }
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function getStudentNameByStudentID($studentID){
    try{
        $studentID = trim($studentID);
        $conn = dbConnection();
        $stmt = $conn->prepare("SELECT name FROM student WHERE studentID = ?");
        $stmt->bind_param("s",$studentID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['name'];
        }else{
            return "error";
        }
    } catch (Exception $e) {
        return $e->getMessage();
    }
}
function getStudentNameBySic($sic){
    try {
        $sic = trim($sic);
        $conn = dbConnection();

        // First, check in student table
        $stmt = $conn->prepare("SELECT name FROM student WHERE sic = ?");
        $stmt->bind_param("s", $sic);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['name'];
        }

        // If not found in student, check in faculty table
        $stmt = $conn->prepare("SELECT name FROM faculty WHERE sic = ?");
        $stmt->bind_param("s", $sic);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['name'];
        }

        return "error";
        
    } catch (Exception $e) {
        return $e->getMessage();
    }
}


function getStudentSicByStudentID($studentID){
    try{
        $studentID = trim($studentID);
        $conn = dbConnection();
        $stmt = $conn->prepare("SELECT sic FROM student WHERE studentID = ?");
        $stmt->bind_param("s",$studentID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['sic'];
        }else{
            return "error";
        }
    } catch (Exception $e) {
        return $e->getMessage();
    }
}
function getStudentStudentIDBySic($sic){
    try{
        $sic = trim($sic);
        $conn = dbConnection();
        $stmt = $conn->prepare("SELECT studentID FROM student WHERE sic = ?");
        $stmt->bind_param("s",$sic);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['studentID'];
        }else{
            return "error";
        }
    } catch (Exception $e) {
        return $e->getMessage();
    }
}
?>
