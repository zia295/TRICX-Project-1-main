<?php include 'header.php';

require 'database.php';

// Fetch all events from the database
$stmt = $conn->prepare("SELECT * FROM event");
$stmt->execute();
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Events</title>
</head>
<body>
    <h1>Manage Events</h1>

    <a class="create" href="create_event.php">Create new event</a>

    <?php if (!empty($events)) : ?>
        <table>
            <thead>
                <tr>
                    <th>Event Name</th>
                    <th>Event Date</th>
                    <th>Event Venue</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($events as $event) : ?>
                    <tr> <!-- Corrected row opening -->
                        <td><?php echo $event['event_name']; ?></td>
                        <td><?php echo $event['event_date']; ?></td>
                        <td><?php echo $event['event_venue']; ?></td>
                    </tr> <!-- Corrected row closing -->
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No events found</p>
    <?php endif; ?>

    <script src="script.js"></script>
</body>
</html>

<br><br><br>

<?php include 'footer.php'; ?>
