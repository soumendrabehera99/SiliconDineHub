<?php
require_once "studentdb.php";
require_once "../utils/mail.php";
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
                $sic = $response['sic'];
                $seID = $response['seID'];
                $toEmail = $response['email'];
                $subject = "Otp Verfication";

                $otp = random_int(100000,999999);
                $body= "Your Registration OTP is:". $otp;

                $response = sendMail($toEmail,$subject,$body);
                
                if($response == "internet error"){
                    echo json_encode(["status" =>  "error2"]);
                }else if($response == "error"){
                    echo json_encode(["status" =>  "error3"]);
                }else if($response == "success"){
                    echo json_encode(["status" =>  "success" , "seID"=> $seID , "email" => $toEmail , "otp" => $otp]);
                }
            }
        }
    }else if ($_POST['operation'] == "saveStudent") {
        $seID = trim($_POST['seID']);
        $sic = trim($_POST['sic']);
        $name = trim($_POST['name']);
        $dob = trim($_POST['dob']);
        $password = trim($_POST['password']);

        if (empty($seID) || empty($sic) || empty($name) || empty($dob) || empty($password)) {
            echo json_encode(["status" => "error", "message" => "All fields must be filled."]);
            exit;
        }

        $response = saveStudent($sic, $seID, $name, $dob, $password);

        echo json_encode(["status" => $response]);
        exit;
    }
}
?>