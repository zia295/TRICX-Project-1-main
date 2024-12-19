<?php include 'header.php';


$event_name = $event_date = $event_venue = "";
$event_name_err = $event_date_err = $event_venue_err = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $input_event_name = trim($_POST["event_name"]);
    if(empty($input_event_name)){
        $event_name_err = "Please enter an event name";
    } else {
        $event_name = $input_event_name;
    }

    $input_event_date = trim($_POST["event_date"]);
    if(empty($input_event_date)){
        $event_date_err = "Please select an event date";
    } else{
        $event_date = $input_event_date;
    }

    $input_event_venue = trim($_POST["event_venue"]);
    if(empty($input_event_venue)){
        $event_venue_err = "Please select an event venue";
    } else{
        $event_venue = $input_event_venue;
    }

    if (empty($event_name_err) && empty($event_date_err) && empty($event_venue_err)){
        $stmt = $conn->prepare("INSERT into event (event_name, event_date, event_venue) VALUES (:event_name, :event_date, :event_venue)");
        $stmt->bindParam(":event_name", $event_name);
        $stmt->bindParam(":event_date", $event_date);
        $stmt->bindParam(":event_venue", $event_venue);

        if($stmt->execute()){
            header("Location: manage_events.php");
            exit();
        } else {
            echo "Something went wrong. please try again";
        }
        $stmt = null;
    }
}
$conn = null;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <h1 class="event_title">Create Event</h1>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
            <input type="submit" class="btn btn-primary" value="Create">
            <a href="manage_events.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</body>
</html>
