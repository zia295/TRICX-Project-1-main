<?php include "header.php";
require_once 'database.php';

$sql = "SELECT * FROM event";
$stmt = $conn->query($sql);

// Fetch events from the database
$stmt = $conn->prepare("SELECT * FROM event ORDER BY event_date DESC LIMIT 5"); // Limit to 5 recent events
$stmt->execute();
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = null;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Events</h1>
    
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
            <p>No events found</p>
        <?php endif; ?>
    </div>
</section>

</body>
</html>

<br>


    <br>

    <?php include 'footer.php'; ?>