<?php include 'header.php';
require 'database.php';


$event_name = $event_date = $event_venue = "";
$event_name_err = $event_date_err = $event_venue_err = $image_err = "";

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_event_name = trim($_POST["event_name"]);
    if (empty($input_event_name)) {
        $event_name_err = "Please enter an event name.";
    } else {
        $event_name = $input_event_name;
    }

    $input_event_date = trim($_POST["event_date"]);
    if (empty($input_event_date)) {
        $event_date_err = "Please select an event date.";
    } else {
        $event_date = $input_event_date;
    }

    $input_event_venue = trim($_POST["event_venue"]);
    if (empty($input_event_venue)) {
        $event_venue_err = "Please select an event venue.";
    } else {
        $event_venue = $input_event_venue;
    }

    // Handle the image upload
    $image_err = "";
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["image_filename"]["name"]);
    $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validate image file
    if (!empty($_FILES["image_filename"]["name"])) {
        if (getimagesize($_FILES["image_filename"]["tmp_name"]) === false) {
            $image_err = "The file is not a valid image.";
        } elseif (!in_array($image_file_type, ["jpg", "png", "jpeg", "gif"])) {
            $image_err = "Only JPG, JPEG, PNG & GIF files are allowed.";
        } elseif ($_FILES["image_filename"]["size"] > 5000000) { // Limit size to 5MB
            $image_err = "The file is too large.";
        } else {
            // Save the uploaded file
            if (!move_uploaded_file($_FILES["image_filename"]["tmp_name"], $target_file)) {
                $image_err = "There was an error uploading the file.";
            }
        }
    } else {
        $image_err = "Please upload an image.";
    }

    // Insert into the database if no errors
    if (empty($event_name_err) && empty($event_date_err) && empty($event_venue_err) && empty($image_err)) {
        $stmt = $conn->prepare("INSERT INTO event (event_name, event_date, event_venue, image_filename) VALUES (:event_name, :event_date, :event_venue, :image_filename)");
        $stmt->bindParam(":event_name", $event_name);
        $stmt->bindParam(":event_date", $event_date);
        $stmt->bindParam(":event_venue", $event_venue);
        $stmt->bindParam(":image_filename", $target_file);

        if ($stmt->execute()) {
            header("Location: manage_events.php");
            exit();
        } else {
            echo "Something went wrong. Please try again.";
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
    <title>Create Event</title>
</head>
<body>
    <h1 class="event_title">Create Event</h1>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
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
        <div class="form-group <?php echo (!empty($image_err)) ? 'has-error' : ''; ?>">
            <label>Event Image</label>
            <input type="file" name="image_filename" class="form-control">
            <span class="help-block"><?php echo $image_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Create">
            <a href="manage_events.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</body>
</html>
