<?php include 'database.php';

session_start();

if($_SERVER ['REQUEST_METHOD'] === "POST"){
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    try{

    $pdo = "SELECT id, email , hashed_password from registered_user WHERE email = :email";
    $stmt = $conn->prepare($pdo);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if($stmt->rowCount() > 0){
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user && password_verify($password, $user['hashed_password'])){ 
            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
    }
                header("Location: index.php");
                exit();
            } else{
                echo "Invalid username or password";
            }
            } catch (PDOException $e){
                echo ("Invalid username or password:" . $e->getMessage());
            }
        }
    