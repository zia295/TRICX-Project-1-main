<?php
include 'header.php';
require 'database.php';

$event_id = isset($_GET['event_id']) ? $_GET['event_id'] : null;
$event_name = $event_date = $event_venue = "";
$event_name_err = $event_date_err = $event_venue_err = "";

if ($event_id) {
    $stmt = $conn->prepare("SELECT * FROM event WHERE event_id = ?");
    $stmt->bindParam(1, $event_id, PDO::PARAM_INT);
    $stmt->execute();
    $event = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($event) {
        $event_name = $event['event_name'];
        $event_date = $event['event_date'];
        $event_venue = $event['event_venue'];
    } else {
        die("No event found.");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["event_name"]))) {
        $event_name_err = "Please enter an event name.";
    } else {
        $event_name = trim($_POST["event_name"]);
    }

    if (empty(trim($_POST["event_date"]))) {
        $event_date_err = "Please select an event date.";
    } else {
        $event_date = trim($_POST["event_date"]);
    }

    if (empty(trim($_POST["event_venue"]))) {
        $event_venue_err = "Please enter an event venue.";
    } else {
        $event_venue = trim($_POST["event_venue"]);
    }

    if (empty($event_name_err) && empty($event_date_err) && empty($event_venue_err)) {
        $stmt = $conn->prepare("UPDATE event SET event_name = ?, event_date = ?, event_venue = ? WHERE event_id = ?");
        $stmt->bindParam(1, $event_name);
        $stmt->bindParam(2, $event_date);
        $stmt->bindParam(3, $event_venue);
        $stmt->bindParam(4, $event_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: manage_events.php");
            exit;
        } else {
            die("Update failed: " . print_r($stmt->errorInfo(), true));
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Event</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Event</h1>
    <form class="form-container"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?event_id=" . $event_id); ?>" method="post">
        <div class="form-group <?php echo (!empty($event_name_err)) ? 'has-error' : ''; ?>">
            <label>Event Name</label>
            <input type="text" name="event_name" class="form-control" value="<?php echo $event_name; ?>">
            <span class="help-block"><?php echo $event_name_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($event_date_err)) ? 'has-error' : ''; ?>">
            <label>Event Date</label>
            <input type="date" name="event_date" class="form-control" value="<?php echo $event_date; ?>">
            <span class="help-block"><?php echo $event_date_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($event_venue_err)) ? 'has-error' : ''; ?>">
            <label>Event Venue</label>
            <input type="text" name="event_venue" class="form-control" value="<?php echo $event_venue; ?>">
            <span class="help-block"><?php echo $event_venue_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Update">
            <a href="manage_events.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</body>
</html>