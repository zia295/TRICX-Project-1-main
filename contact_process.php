<?php 

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);


    if (empty($name) || empty($email) || empty($message)){
        die("All fields are required");
    }

    
}