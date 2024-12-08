<?php include 'header.php'; ?>




<form action="signupHandler.php" method="Post" required>
    <input class="signup-input" type="text" name="nickname" placeholder="your nickname" required><br>
    <br>
    <input class="signup-input" type="text" name="name" placeholder="your name" required><br>
    <br>
        <input class="signup-input" type="text" name="email" placeholder="your email address" required><br>
        <br>
        <input class="signup-input" type="password" name="password" placeholder="password" required><br>
        <br>
        <input class="signup-input" type="password" name="confirm_password" placeholder="confirm_password" required><br>
        <br>
        <button class="signup-butt" type="submit">Register</button>
    </form>