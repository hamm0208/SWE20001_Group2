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

?>