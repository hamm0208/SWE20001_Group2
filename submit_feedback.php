<?php
include "connection.php"; // Include the database connection file

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $eventType = $_POST["eventType"];
    $foodRating = $_POST["foodRating"];
    $serviceRating = $_POST["serviceRating"];
    $feedback = $_POST["feedback"];

    // Insert data into the database
    $sql = "INSERT INTO feedback (name, eventType, foodRating, serviceRating, feedback) 
            VALUES ('$name', '$eventType', '$foodRating', '$serviceRating', '$feedback')";
    
    // Execute the SQL query
    if (mysqli_query($conn, $sql)) {
        echo "Feedback submitted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
