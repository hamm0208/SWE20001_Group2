<?php
// Include necessary files for database connection
include("database.php");
include("connection.php");

// Retrieve parameters from the AJAX request
$value = $_GET['value'];
$id = $_GET['id'];

// Update the orders table
$sql = "UPDATE orders SET status='$value' WHERE id=$id";

if (mysqli_query($conn, $sql)) {
    echo "Status updated successfully";
} else {
    echo "Error updating status: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>