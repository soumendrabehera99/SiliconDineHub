<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

function sendEmail($toEmail, $subject, $body, $fromEmail = 'silicondinehub@gmail.com', $fromName = 'DineHub') {
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                         // Send using SMTP
        $mail->SMTPAuth   = true;                                // Enable SMTP authentication
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->Username   = 'silicondinehub@gmail.com';          // SMTP username
        $mail->Password   = 'knnvjryfxlhrvbhy';                  // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;      // Enable TLS encryption
        $mail->Port       = 587;                                 // TCP port to connect to

        //Recipients
        $mail->setFrom($fromEmail, $fromName);                   // Set sender email and name
        $mail->addAddress($toEmail);                             // Add recipient email

        //Content
        $mail->isHTML(true);                                    // Set email format to HTML
        $mail->Subject = $subject;                              // Set email subject
        $mail->Body    = $body;                                 // Set email body

        // Send email
        if ($mail->send()) {
            return true;
        } else {
            return $mail->ErrorInfo;
        }
    } catch (Exception $e) {
        return "Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
