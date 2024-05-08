<?php
include("database.php");
include("connection.php");

$sql = "SELECT user_email, contact_number, status
        FROM orders
        WHERE status IN ('Cancelled', 'In Progress', 'Complete')";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['user_email'] . "</td>";
        echo "<td>" . $row['contact_number'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        // You can add more columns or data here if needed
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>No orders found.</td></tr>";
}

mysqli_close($conn);
?>
