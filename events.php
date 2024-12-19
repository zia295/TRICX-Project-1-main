<?php include "header.php";
require_once 'database.php';

$sql = "SELECT * FROM event";
$stmt = $conn->query($sql);

if ($stmt->rowCount() > 0){
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else{
    $result = [];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<section class="products" id="products">
    <h1 class="header">Our <span>Events</span></h1>
    <div class="box-container">
        <?php
        if(!empty($result)){
            foreach ($result as $row) {
                echo '<div class="box">';
                echo '<div class="box-head">';
                echo '<div class="image">';
                echo '<img src="./images/event4.jpg" alt="' . $row["event_name"] . '">';
                echo '</div>';
                echo '<span class="title">' . $row["event_name"] . '</span>';
                echo '<br></br>';
                echo '<a href="#" class="name">' . $row["event_venue"] . '</a>';
                echo '</div>';
                echo '<div class="box-bottom">';
                echo '<div class="info">';
                echo '<b class="date">' . $row["event_date"] . '</b>';
                echo '</div>';
                echo '<div class="product-btn">';
                echo '<a href="./images/event1.jpg"></a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else{
            echo "No events found";
        }
        ?>
    </div>

</section>
</body>
</html>

<br>


    <br>

    <?php include 'footer.php'; ?>