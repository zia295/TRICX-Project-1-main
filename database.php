<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tricx";

try {
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo "Connected Successfully";

}catch(PDOException $e){
    echo "Connection failed:" . $e->getMessage();
}



?>