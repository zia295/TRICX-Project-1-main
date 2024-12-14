<?php include 'database.php';

session_start();

if($_SERVER ["REQUEST_METHOD"] === "POST"){
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    try{

    $pdo = "SELECT id, name, email, hashed_password, role from registered_user WHERE email = :email";
    $stmt = $conn->prepare($pdo);
    $stmt->bindParam(':email', $email);
    $stmt->execute();


    
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify password
        if ($user && password_verify($password, $user['hashed_password'])) { 
            // Set session variables for logged-in user
            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            // Redirect to index page
            header("Location: index.php");
            exit();
        } else {
            echo "Invalid username or password";
        }
    } else {
        echo "Invalid username or password";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
}

    
    