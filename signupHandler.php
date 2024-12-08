<?php include 'database.php';

/*echo '<pre>';
print_r($_POST); // This will show all submitted form data.
echo '</pre>';
exit;*/

/* this below code call the names of the form   */
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $nickname = $_POST['nickname'] ?? '';
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    /* this makes it filtered so it contains appropriate letters   */
    $filtered_nickname = filter_var(FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $filtered_name = filter_var(FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $filtered_email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $validated_email = filter_var($filtered_email, FILTER_VALIDATE_EMAIL);

    /* this below code matches the password   */
    if($password != $confirm_password){
        echo "Error: password dont match";
    }elseif (!$validated_email){
        echo "Error: Invalid email format";
    }else{
        /* if the email does not match then it searches the database  */
        try{
            $checkEmailSql = "Select * FROM registered_user WHERE email = :email";
            $checkEmailStmt = $conn->prepare($checkEmailSql);
            $checkEmailStmt->bindParam(':email', $validated_email);
            $checkEmailStmt->execute();

            /* this below code check for same email already registered */
            if($checkEmailStmt->rowCount() > 0){
                echo "Error: Email already registered";
            }else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            
                /* this below code allows data to be added into database */
                $sql = "INSERT INTO registered_user (nickname, name, email, hashed_password) VALUES (:nickname, :name, :email, :hashed_password)";
                $stmt = $conn->prepare($sql);                
                $stmt->bindParam(':nickname', var: $filtered_nickname);
                $stmt->bindParam(':name', $filtered_name);
                $stmt->bindParam(':email', $validated_email);
                $stmt->bindParam(':hashed_password', $hashed_password);

                if($stmt->execute()){
                    header("location: index.php");
                    exit();
                }else{
                        echo "Error: registration failed";
                    }
                }
            

                } catch (PDOException $e){
                    echo "Error: " .$e->getMessage();
                }
            }

        }
