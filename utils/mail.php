<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';

function sendMail($toEmail = "mca.23mmci48@silicon.ac.in", $subject = "Check Internet Connection", $body = "Checking when the internet connection is off then mail is send successful or not", $fromEmail = 'silicondinehub@gmail.com', $fromName = 'DineHub') {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                                         
        $mail->SMTPAuth   = true;                                
        $mail->Host       = 'smtp.gmail.com';                    
        $mail->Username   = 'silicondinehub@gmail.com';          
        $mail->Password   = 'knnvjryfxlhrvbhy';                  
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;      
        $mail->Port       = 587;                                 
        
        // Check internet connection
        if (!@fsockopen('www.google.com', 80)) {
            return "internet error";
        }

        // Recipients
        $mail->setFrom($fromEmail, $fromName);                   
        $mail->addAddress($toEmail);                             

        // Content
        $mail->isHTML(true);                                    
        $mail->Subject = $subject;                              
        $mail->Body    = $body;                                 

        // Send email
        if ($mail->send()) {
            return "success";
        } else {
            return "error";
        }
    } catch (MailException $e) {
        return "Custom Exception: " . $e->getMessage();
    } catch (Exception $e) {
        return "Mailer Error: " . $mail->ErrorInfo;
    }
}
?>
