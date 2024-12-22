<?php 

session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: index.php");
    exit();
}

require_once 'database.php';

$event_id = isset($_GET['event_id']) ? $_GET['event_id'] : null;

if($event_id){
    $stmt = $conn->prepare("DELETE FROM event WHERE event_id = ?");
    $stmt->bindParam(1, $event_id, PDO::PARAM_INT);

    if($stmt->execute()){
        header("Location: manage_events.php");
        exit();
    } else{
        echo "Something went wrong. please try again";
    }

    $stmt = null;
} else{
    header("Location: manage_events.php");
    exit();
}

$conn = null;