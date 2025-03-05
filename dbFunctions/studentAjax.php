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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read raw POST data and decode JSON
    $input = json_decode(file_get_contents("php://input"), true);

    // Check if the required message is received
    if (isset($input['message']) && $input['message'] === "deleteSicEmail") {
        $id = $input['id']; // Get ID from JSON request

        if (deleteValidCustomerById($id)) { // Call function to delete
            echo json_encode(["success" => true, "message" => "Record deleted successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to delete record."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Invalid request."]);
    }
}

?>

