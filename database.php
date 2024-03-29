<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "FoodEdge";

$conn = mysqli_connect($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
mysqli_query($conn, $sql);

//Select FoodEdge database
mysqli_select_db($conn, $dbname);

$sql = "CREATE TABLE IF NOT EXISTS inventory(
    id INT(4) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    category VARCHAR(50),
    price DECIMAL(10, 2),
    image_name VARCHAR(255)
)";
mysqli_query($conn, $sql);

?>