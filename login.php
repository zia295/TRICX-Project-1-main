<?php include "header.php"; ?> 




<br>
<h1 class="log-title">Log in</h1>
<br>
<br>
<form class="login-form" action="loginHandler.php" method="Post" required>
        <input class="login-input" type="text" name="email" placeholder="your email address" required><br>
        <br>
        <input class="login-input" type="password" name="password" placeholder="password" required><br>
        <br>
        <button class="login-butt" type="submit">Login</button>

        <a class="register-link" href="login.php">If not registered</a>
    </form>