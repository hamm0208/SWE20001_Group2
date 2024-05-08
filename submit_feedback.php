<?php
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $eventType = $_POST["eventType"];
    $foodRating = $_POST["foodRating"];
    $serviceRating = $_POST["serviceRating"];
    $feedback = $_POST["feedback"];
    $sql = "INSERT INTO feedbacks (name, eventType, foodRating, serviceRating, feedback) 
            VALUES ('$name', '$eventType', '$foodRating', '$serviceRating', '$feedback')";

    if (mysqli_query($conn, $sql)) {
        echo "Feedback submitted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
