<?php
include 'header.php';
require_once 'database.php';

// Get the event_id from the URL (GET parameter)
$event_id = isset($_GET['event_id']) ? $_GET['event_id'] : null;

// Check if event_id exists
if ($event_id) {
    // Prepare the query to fetch the event details
    $stmt = $conn->prepare("SELECT * FROM event WHERE event_id = ?");
    $stmt->bindParam(1, $event_id, PDO::PARAM_INT);
    $stmt->execute();
    
    // Fetch the event
    $event = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if event exists
    if (!$event) {
        echo "Event not found.";
        exit();
    }

    // Close the statement
    $stmt = null;
} else {
    // Redirect to manage events page if event_id is not provided
    header("Location: manage_events.php");
    exit();
}
?>

<!-- The HTML for displaying the event -->
<div class="view-device-container">
    <div class="view-device-details">
        <h2 class="event-name"><?php echo htmlspecialchars($event['event_name']); ?></h2>
        <p><strong>Date:</strong> <span class="event-date"><?php echo htmlspecialchars($event['event_date']); ?></span></p>
        <p><strong>Venue:</strong> <span class="event-venue"><?php echo htmlspecialchars($event['event_venue']); ?></span></p>
        <a href="manage_events.php" class="btn">Back to Events</a>
    </div>
</div>
