<?php
session_start();
require_once "studentdb.php";
if(isset($_POST['operation'])){
    if ($_POST['operation']== "studentAdd" && isset($_POST['sic']) && isset($_POST['email'])) {
        $sic = $_POST['sic'];
        $email = $_POST['email'];

        $response = addStudent($sic, $email);

        echo $response;
    }else if($_POST['operation'] == 'addAllData'){
        $students = json_decode($_POST['jsonData'],true);

        if(!empty($students)){

            $sicList = array_column($students, "SIC");
            
            $existingSics = getExistingSics($sicList);
            // echo json_encode($existingSics);
            if(!empty($existingSics)){
                echo json_encode(["status" => "error", "message" => "Remove existing SIC numbers", "existingSICs" => $existingSics]);
            }else{
                foreach($students as $student){
                    $sic = $student['SIC'];
                    $email = $student['Email'];
                    addStudent($sic,$email);
                }
                
                echo json_encode(["status" => "success", "message" => "All students added successfully"]);
            }
        }else{
            echo json_encode(["status" => "error", "message" => "No student data received"]);
        }
    }else if ($_POST['operation']=="deleteSicEmail") {
        if ($_POST['id']) {
            $id = $_POST['id'];
    
            if (deleteValidCustomerById($id)) {
                echo json_encode(["success" => true, "message" => "Record deleted successfully."]);
            } else {
                echo json_encode(["success" => false, "message" => "Failed to delete record."]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Invalid request."]);
        }
    }else if ($_POST['operation']=="sicEmailUpdate" && isset($_POST['sic']) && isset($_POST['email']) && isset($_POST['id']) ) {
            $id = $_POST['id'];
            $sic = $_POST['sic'];
            $email = $_POST['email'];
            
            $response = updateSicEmail($id,$sic,$email);
            echo $response;
    }else if($_POST['operation']== "studentStatusUpdate" && isset($_POST['id'])){
        $id = $_POST['id'];
        $status = $_POST['status'];
        $response = updateStudentStatus($id,$status);
        echo $response;
    }else if($_POST['operation']== "getStudentID"){
        // echo $_SESSION['sic'];
        if (!isset($_SESSION['sic'])) {
            echo json_encode(false);
            exit;
        }
        echo json_encode(["sic"=>$_SESSION['sic']]);
        exit;
    }
}


?>

