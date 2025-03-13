<?php
require_once "studentdb.php";
if(isset($_POST['operation'])){
    if ($_POST['operation']== "studentSignUp" & isset($_POST['sic'])) {
        $sic = $_POST['sic'];
        $response = getStudentBySicFromStudent($sic);
        if ($response == "present") {
            echo json_encode(["status" => "present"]);
        } else if ($response == "error"){
            $response = getStudentBySicFromSicEmail($sic);
            if ($response == "error") {
                echo json_encode(["status" => "error1"]);
            } else if (is_array($response)) {
                echo "Data found:<br>";
                print_r($response);
            }
        }
    }
}
?>