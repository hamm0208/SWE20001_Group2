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
    item_image_name VARCHAR(255)
)";
mysqli_query($conn, $sql);

//Customers ONLY
$sql = "CREATE TABLE IF NOT EXISTS users(
    email VARCHAR(50) PRIMARY KEY NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    dob DATE NULL,
    gender VARCHAR(6) NOT NULL,
    contact_number VARCHAR(15) NULL,
    profile_image VARCHAR(100) NULL
)";
mysqli_query($conn, $sql);


//Accounts ONLY
$sql = "CREATE TABLE IF NOT EXISTS accounts (
    email VARCHAR(50) PRIMARY KEY NOT NULL,
    password VARCHAR(255) NOT NULL,
    type VARCHAR(50) NOT NULL,
    FOREIGN KEY (email) REFERENCES users(email) ON DELETE CASCADE ON UPDATE CASCADE 
)";
mysqli_query($conn, $sql);

//Inserting Preset Data
$find = "SELECT * FROM users where email='thenbeckham@gmail.com'";
if(mysqli_num_rows(mysqli_query($conn,$find))!= 1){
    $sql = "INSERT IGNORE INTO users (email, first_name, last_name, dob, gender, contact_number, profile_image)
        VALUES
            ('thenbeckham@gmail.com', 'Beckham', 'Then', '2003-02-08', 'male', '0128781041', null),
            ('everlynchin09@gmail.com', 'Irene', 'Chin', '2002-01-01', 'female', '0143926960', null),
            ('anjanaalyann@gmail.com', 'Anjaana', 'Lyan', '2002-01-01', 'female', '0178181712', null),
            ('crystalgoh01@gmail.com', 'Crystal', 'Goh', '2002-01-01', 'female', '0146178161', null),
            ('isakibul623@gmail.com', 'Sakibul', 'Islam', '2001-01-01', 'male', '01952007652', null),
            ('ThomasShelby@gmai.com', 'Thomas', 'Shelby', '1967-01-01', 'male', '0123456789', null);
    ";
    mysqli_query($conn, $sql);
}

$find = "SELECT * FROM accounts where email='thenbeckham@gmail.com'";
if(mysqli_num_rows(mysqli_query($conn,$find))!= 1){
    $sql = "INSERT IGNORE INTO accounts (email, password, type)
        VALUES
        ('thenbeckham@gmail.com', '12345', 'management'),
            ('everlynchin09@gmail.com', '12345', 'management'),
            ('anjanaalyann@gmail.com', '12345', 'management'),
            ('crystalgoh01@gmail.com', '12345', 'management'),
            ('isakibul623@gmail.com', '12345', 'management'),
            ('ThomasShelby@gmai.com', '12345', 'customer');
    ";
    mysqli_query($conn, $sql);
}

?>