<?php
/*include 'database.php';*/
session_start();
$isLoggedIn = isset($_SESSION['id']);
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] == 'admin';
$current_page = basename($_SERVER ['PHP_SELF']);




/*  this code is to handle search submission*/
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
    $search = htmlspecialchars($_POST['search']);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="script.js"></script>
    <title>Document</title>
</head>
<div>

<!---searchbar section starts here-->
<section class="searchbar text-center">
    <div class="container">
    <form action="events.php" method="post">
        <input class="searchbar" type="search" name="search" placeholder="search" required>
        <button type="submit" name="search" class="fa fa-search">
        </div>
        
        </form>
        <a class="title" href="index.php" alt="logo"><h1>FULL CIRCLE EVENTS</h1></a>
       

</div>
</section>

<section class="icons">
<a href="https://www.youtube.com/" class="fab fa-youtube">Youtube</a>
        <a href="https://www.facebook.com/?locale=en_GB" class="fab fa-facebook">Facebook</a>
        <a href="https://x.com/?lang=en" class="fab fa-twitter">Twitter</a>
</section>

<!--searchbar section ends here---->

<br>
<br>

<!----navbar section starts here----->
<div class="navbar">
    <div class="container">
        <div class="logo">
            <a href="index.php" title="logo" <?php if ($current_page == 'index.php') echo 'class="active"'; ?>>
                <img src="./images/logo.jpg" alt="logo" class="img-responsive img-curve">
            </a>
        </div>
        

        <div class="menu text-left">
            <ul>
                <li><a href="index.php" <?php if($current_page == 'index.php') echo 'class="active"'; ?>>Home</a></li>
                <li><a href="about.php" <?php if($current_page == 'about.php') echo 'class="active"'; ?>>About</a></li>
                <li><a href="events.php" <?php if($current_page == 'events.php') echo 'class="active"'; ?>>Events</a></li>
                <li><a href="contact.php" <?php if($current_page == 'contact.php') echo 'class="active"'; ?>>Contact</a></li>
                <li><a href="login.php" <?php if($current_page == 'login.php') echo 'class="active"'; ?>>Login</a></li>
                <li><a href="signup.php" <?php if($current_page == 'signup.php') echo 'class="active"'; ?>>Signup</a></li>
                </ul>
    
        </div>
</div>
    

            



            <div class="clearfix"></div>
                </div>
            
    </section>

    <!---navbar section ends here-->

    
    <br>
    <br>
    




</body>
</html>



<br>
<br>



