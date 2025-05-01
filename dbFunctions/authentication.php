<?php
require_once "studentdb.php";
require_once "facultydb.php";
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
                $subject = "OTP Verfication";

                $otp = random_int(100000,999999);
                $body= '<!DOCTYPE html>
                        <html lang="en">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <title>Email OTP</title>
                            <link href="../assets/bootstrap/bootstrap.min.css" rel="stylesheet">
                            <style>
                                body {
                                    display: flex;
                                    justify-content: center;
                                    align-items: center;
                                    height: 100vh;
                                    background-color: #f8f9fa;
                                }
                                .otp-container {
                                    background: white;
                                    padding: 30px;
                                    border-radius: 10px;
                                    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
                                    text-align: center;
                                    width: 100%;
                                    max-width: 400px;
                                }
                                .otp-code {
                                    font-size: 2.5rem;
                                    font-weight: bold;
                                    color: green;
                                }
                                .footer {
                                    margin-top: 20px;
                                    font-size: 0.9rem;
                                }
                                hr {
                                    border: none;
                                    height: 1px;
                                    background-color: #ddd;
                                    margin: 15px 0;
                                }
                                h3 {
                                    color: #007bff;
                                    font-weight: bold;
                                }
                                a {
                                    text-decoration: none;
                                }
                            </style>
                        </head>
                        <body>
                            <div class="otp-container">
                                <h2>Student Resgistration OTP</h2>
                                <hr>
                                <p>Dear User,</p>
                                <p>Your One-Time Password (OTP) is:</p>
                                <p class="otp-code">'.$otp.'</p>
                                <p>Please use this OTP to complete your Registration process. Do not share this code with anyone.</p>
                                <p>Thank you for Registration !</p>
                                <div class="footer">
                                    &copy; <a href="https://www.silicondinehub.com" target="_blank">www.silicondinehub.com</a>. All rights reserved.
                                </div>
                            </div>
                        </body>
                        </html>
                        ';

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

    else if ($_POST['operation'] == "facultySignUp" && isset($_POST['facSic'])) {
        $facSic = $_POST['facSic'];
        $response = getFacultyByIDFromFaculty($facSic); // Check if already registered

        if ($response == "present") {
            echo json_encode(["status" => "present"]);
        } else if ($response == "error") {
            $response = getFacultyByIDFromFacultyEmail($facSic); // Check in eligible list
            if ($response == "error") {
                echo json_encode(["status" => "error1"]);
            } else if (is_array($response)) {
                $facSic = $response['sic'];
                $seID = $response['seID'];
                $toEmail = $response['email'];
                $subject = "OTP Verification";

                $otp = random_int(100000, 999999);

                $body = '<!DOCTYPE html>
                        <html lang="en">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <title>Email OTP</title>
                            <link href="../assets/bootstrap/bootstrap.min.css" rel="stylesheet">
                            <style>
                                body { display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f8f9fa; }
                                .otp-container { background: white; padding: 30px; border-radius: 10px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); text-align: center; width: 100%; max-width: 400px; }
                                .otp-code { font-size: 2.5rem; font-weight: bold; color: green; }
                                .footer { margin-top: 20px; font-size: 0.9rem; }
                                hr { border: none; height: 1px; background-color: #ddd; margin: 15px 0; }
                                h3 { color: #007bff; font-weight: bold; }
                                a { text-decoration: none; }
                            </style>
                        </head>
                        <body>
                            <div class="otp-container">
                                <h2>Faculty Registration OTP</h2>
                                <hr>
                                <p>Dear Faculty,</p>
                                <p>Your One-Time Password (OTP) is:</p>
                                <p class="otp-code">' . $otp . '</p>
                                <p>Please use this OTP to complete your Registration. Do not share this code with anyone.</p>
                                <p>Thank you!</p>
                                <div class="footer">&copy; <a href="https://www.silicondinehub.com" target="_blank">www.silicondinehub.com</a>. All rights reserved.</div>
                            </div>
                        </body>
                        </html>';

                $response = sendMail($toEmail, $subject, $body);

                if ($response == "internet error") {
                    echo json_encode(["status" => "error2"]);
                } else if ($response == "error") {
                    echo json_encode(["status" => "error3"]);
                } else if ($response == "success") {
                    echo json_encode([
                        "status" => "success",
                        "seID" => $seID,
                        "sic" => $facSic,
                        "email" => $toEmail,
                        "otp" => $otp
                    ]);
                }
            }
        }
    }

    // ----------- FACULTY SAVE ----------
    else if ($_POST['operation'] == "saveFaculty") {
        $seID = trim($_POST['seID']);
        $facSic = trim($_POST['facSic']);
        $name = trim($_POST['name']);
        $dob = trim($_POST['dob']);
        $password = trim($_POST['password']);

        if (empty($seID) || empty($facSic) || empty($name) || empty($dob) || empty($password)) {
            echo json_encode(["status" => "error", "message" => "All fields must be filled."]);
            exit;
        }

        $response = saveFaculty($facSic, $seID, $name, $dob, $password);

        echo json_encode(["status" => $response]);
        exit;
    }
}
?>