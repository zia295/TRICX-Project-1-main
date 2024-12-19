<?php 
include 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $name = trim($_POST['name']) ?? '';
    $email = trim($_POST['email']) ?? '';
    $recipient_email = trim($_POST['recipient_email'] ?? '');
    $subject = trim($_POST['subject']) ?? '';
    $message = trim($_POST['message']) ?? '';


    if (empty($name) || empty($email) || empty($recipient_email) || empty($subject) || empty($message)) {
        die("All fields are required");
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        die("Invalid email format");
    }

    try{
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = 'true';
        $mail->Username = 'asadnanga885@gmail.com';
        $mail->Password = 'fvxt yokb pslx nxiw';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom($email, $name);
        $mail->addAddress($recipient_email);

        $mail->subject = $subject;
        $mail->Body = "You recieved a message from $name:\n\n$message";

        $mail->send();
        echo "Thank you for your message! we will get back to you soon";
    } catch (Exception $e){
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    }