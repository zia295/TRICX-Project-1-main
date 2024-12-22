<?php
include 'header.php';
require 'database.php';
?>

<section class="subtitle">
    <h3 class="subtitle">Experience the unforgettables</h3>
    
</section>
<br>
<br>

<!--Functionality will starts from here with slideshow
of images instead of video--->
<h3>Promo</h3>
<br>
<br>
<div class="slideshow-container">

  <div class="slides-fade">
    <div class="numbertext">1 / 3</div>
    <img src="./images/event4.jpg" alt="Coventry">
    <div class="text">Coventry</div>
  </div>

  <div class="slides-fade">
    <div class="numbertext">2 / 3</div>
    <img src="./images/event5.jpg" alt="Leicester">
    <div class="text">Leicester</div>
  </div>

  <div class="slides-fade">
    <div class="numbertext">3 / 3</div>
    <img src="./images/event6.jpg" alt="London"><br>
    <div class="text">London</div>
  </div>
  <br>
  <br>

  <!-- Navigation buttons -->
  <a class="prev" onclick="changeSlide(-1)">❮</a>
  <a class="next" onclick="changeSlide(1)">❯</a>
</div>

<br>


<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span>
  <span class="dot" onclick="currentSlide(2)"></span>
  <span class="dot" onclick="currentSlide(3)"></span>
</div>


    <?php

// Fetch events from the database
$stmt = $conn->prepare("SELECT * FROM event ORDER BY event_date DESC LIMIT 5"); // Limit to 5 recent events
$stmt->execute();
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = null;
?>

<h3 class="events">Events</h3>
<section class="events">
    <div class="event-container">
        <?php if (!empty($events)) : ?>
            <?php foreach ($events as $event) : ?>
                <div class="event-card">
                    <img src="<?php echo $event['image_filename']; ?>" alt="<?php echo $event['event_name']; ?>" class="image_filename">
                    <h3><?php echo $event['event_name']; ?></h3>
                    <p><strong>Date:</strong> <?php echo $event['event_date']; ?></p>
                    <p><strong>Venue:</strong> <?php echo $event['event_venue']; ?></p>
                    <br>
                    <p>Call us to book the event for you!</p>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No upcoming events</p>
        <?php endif; ?>
    </div>
</section>


    <a class="click-more" href="events.php"><button class="more">Click for more news</button></a>



    <script src="script.js"></script>
</body>
</html>



<br>
<br>

<hr>


<?php include 'footer.php'; ?>


