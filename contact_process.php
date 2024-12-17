<?php 
include 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);


    if (empty($name) || empty($email) || empty($message)){
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
        $mail->Password = '12345';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom($email, $name);
        $mail->addAddress('admin@example.com');

        $mail->Subject = $subject;
        $mail->Body = "You recieved a message from $name:\n\n$message";

        $mail->send();
        echo "Thank you for your message! we will get back to you soon";
    } catch (Exception $e){
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    }