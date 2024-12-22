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
    <link rel="stylesheet" href="style.css"> <!-- Link to CSS for styling if needed -->
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
                    <th>Actions</th> <!-- New column for buttons -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($events as $event) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($event['event_name']); ?></td>
                        <td><?php echo htmlspecialchars($event['event_date']); ?></td>
                        <td><?php echo htmlspecialchars($event['event_venue']); ?></td>
                        <td>
                            <!-- Edit button -->
                            <a href="edit_event.php?event_id=<?php echo $event['event_id']; ?>" class="btn btn-edit">Edit</a>
                            <!-- Delete button (optional, for future use) -->
                            <a href="delete_event.php?event_id=<?php echo $event['event_id']; ?>" class="btn btn-delete">Delete</a>
                            <!-- View button: Link to view_event.php -->
                            <a href="view_event.php?event_id=<?php echo $event['event_id']; ?>" class="btn btn-view">View</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No events found</p>
    <?php endif; ?>

    <script src="script.js"></script>
</body>
</html>

<?php include 'footer.php'; ?>