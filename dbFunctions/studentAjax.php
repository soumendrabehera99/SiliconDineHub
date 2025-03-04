<?php
require_once "studentdb.php";
if(isset($_POST['operation'])){
    if (isset($_POST['sic']) && isset($_POST['email']) && $_POST['operation']== "studentAdd") {
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
    }
}
?>

