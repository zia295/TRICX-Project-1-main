<?php
/*include 'database.php';*/
session_start();
$isLoggedIn = isset($_SESSION['name']);
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

<section>

<header class="header">
                 <a href="index.php" class="logo" <?php if ($current_page == 'index.php') echo 'class="active"'; ?>>
                <img src="./images/logo.jpg" alt="logo" class="img-responsive img-curve">
            </a>
        <nav class="navbar">
            <a href="./index.php" <?php if ($current_page == 'index.php') echo 'class="active"'; ?>>Home</a>
            <a href="./about.php" <?php if ($current_page == 'about.php') echo 'class="active"'; ?>>About</a>
            <a href="./events.php" <?php if ($current_page == 'events.php') echo 'class="active"'; ?>>Events</a>
            <a href="./contact.php" <?php if ($current_page == 'contact.php') echo 'class="active"'; ?>>Contact</a>
          
        </nav>

        <div class="auth">
            <?php if ($isLoggedIn) : ?>
                <div class="dropdown">
                    <button class="dropbtn">Hello <?php echo $_SESSION['nickname']; ?></button>
                    <div class="dropdown-content">
                        <a href="logout.php" class="logout">Logout</a>
                        <?php if ($isLoggedIn) : ?>
                            <a href="./manage_devices.php">Manage Devices</a>
                        <?php endif; ?>
                        <?php if ($isAdmin) : ?>
                            <a href="./manage_events.php">Manage Events</a>
                        <?php endif; ?>
                         <?php if ($isAdmin) : ?>
                            <a href="./manage_members.php">Manage Members</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php else : ?>
                <a href="./signup.php">Register</a>
                <a href="./login.php">Login</a>
            <?php endif; ?>
        </div>
    </header>
        

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