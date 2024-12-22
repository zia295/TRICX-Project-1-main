<?php include "header.php"; ?>



<h1 class="con-title">
    Contact Us
</h1>
<br>
<br>
<h4 class="subtitle">Feel free to get in touch...</h4>
<br>
<br>
<form class="form" action="contact_process.php" method="POST" required>
    <input class="inputs" type="text" name="name" placeholder="Your name" required><br>
    <br>
    <input class="inputs" type="email" name="email" placeholder="Your email address" required><br>
    <br>
    <input class="inputs" type="text" name="subject" placeholder="Subject" required><br>
    <br>
    <textarea class="inputs" name="message" placeholder="Your message" required></textarea><br>
    <br>
    <button type="submit">Submit</button>
</form>


    <br>


    <section>
    <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d9731.683824444852!2d-1.5134334!3d52.4262299!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2suk!4v1733694376773!5m2!1sen!2suk" width="300" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>


    <br>
    <br>
    <br>
    <br>
    <br>
    <?php include "footer.php"; ?>