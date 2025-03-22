<?php
session_start();
require_once "dbConnect.php";
require_once "../utils/mail.php";

try {
    $conn = dbConnection();

    if (!isset($_POST['email'])) {
        echo json_encode(["status" => "error", "message" => "Invalid request"]);
        exit;
    }

    $email = trim($_POST['email']);

    // Check if email exists in the admin table
    $SqlQuery = "SELECT *FROM admin_table WHERE email=?";
    $stmt = $conn->prepare($SqlQuery);

    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => "Database error: " . $conn->error]);
        exit;
    }

    $stmt->bind_param("s", $email);
    if (!$stmt->execute()) {
        echo json_encode(["status" => "error", "message" => "Query execution failed: " . $stmt->error]);
        exit;
    }

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Generate OTP and store in session
        $otp = random_int(100000, 999999);
        $_SESSION['email'] = $email;
        $_SESSION['otp'] = $otp;
        // Email Details
        $subject = "OTP Verification";
        $body = '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>OTP Email</title>
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
                        <h2>Admin OTP Verification</h2>
                        <hr>
                        <p>Dear Admin,</p>
                        <p>Your One-Time Password (OTP) is:</p>
                        <p class="otp-code">' . $otp . '</p>
                        <p>Please use this OTP to Reset your Password. Do not share this code with anyone.</p>
                        <p>Thank you!</p>
                        <div class="footer">
                            &copy; <a href="https://www.silicondinehub.com" target="_blank">www.silicondinehub.com</a>. All rights reserved.
                        </div>
                    </div>
                </body>
                </html>';

        // Send email
        $emailResponse = sendMail($email, $subject, $body);

        if ($emailResponse) {
            // echo json_encode(["status" => "present", "message" => "OTP sent successfully"]);
            echo json_encode(["status" =>  "present" ,"message" => "OTP sent successfully", "otp" => $otp]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to send OTP"]);
        }
    } else {
        echo json_encode(["status" => "Not found", "message" => "Email not registered"]);
    }

    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
