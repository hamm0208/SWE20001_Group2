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
    type VARCHAR(50),
    category VARCHAR(50),
    inventory INT(11),
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
$result = mysqli_query($conn, "SELECT COUNT(*) FROM inventory");
$row = mysqli_fetch_array($result);
$count = $row[0];
if($count == 0){
    $sql = "INSERT INTO inventory (name, description, type, category, inventory, price, item_image_name) VALUES
        ('Deluxe Cheeseburger', 'A mouthwatering cheeseburger with a juicy beef patty, melted cheese, fresh lettuce, tomato, onion, and pickles, served on a toasted sesame seed bun.', 'Food', 'Western', 100, 15, 'deluxe_cheeseburger.jpg'),
        ('Classic Margherita Pizza', 'Authentic Italian pizza topped with tomato sauce, fresh mozzarella cheese, basil leaves, and a drizzle of olive oil.', 'Food', 'Western', 100, 20, 'margherita_pizza.jpg'),
        ('Grilled Chicken Caesar Salad', 'Crisp romaine lettuce tossed with grilled chicken breast, croutons, Parmesan cheese, and Caesar dressing.', 'Food', 'Western', 100, 12, 'caesar_salad.jpg'),
        ('Spaghetti Bolognese', 'Al dente spaghetti pasta served with a rich and savory Bolognese sauce made from ground beef, tomatoes, onions, carrots, and herbs.', 'Food', 'Western', 100, 12, 'spaghetti_bolognese.jpg'),
        ('Fresh Fruit Smoothie', 'A refreshing blend of fresh fruits such as strawberries, bananas, and mangoes, blended with yogurt and ice.', 'Beverage', 'Western', 100, 6, 'fruit_smoothie.jpg')
    ";

mysqli_query($conn, $sql);

}

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
            ('ThomasShelby@gmail.com', 'Thomas', 'Shelby', '1967-01-01', 'male', '0123456789', null);
    ";
    mysqli_query($conn, $sql);
}

$find = "SELECT * FROM accounts where email='thenbeckham@gmail.com'";

$beckham_pw = password_hash("12345", PASSWORD_DEFAULT);
$anjaana_pw = password_hash("12345", PASSWORD_DEFAULT);
$crystal_pw = password_hash("12345", PASSWORD_DEFAULT);
$sakib_pw = password_hash("12345", PASSWORD_DEFAULT);
$irene_pw = password_hash("12345", PASSWORD_DEFAULT);
$preset_thomas_pw = password_hash("12345", PASSWORD_DEFAULT);
if(mysqli_num_rows(mysqli_query($conn,$find))!= 1){
    $sql = "INSERT IGNORE INTO accounts (email, password, type)
        VALUES
        ('thenbeckham@gmail.com', '$beckham_pw', 'management'),
            ('everlynchin09@gmail.com', '$anjaana_pw', 'management'),
            ('anjanaalyann@gmail.com', '$crystal_pw', 'management'),
            ('crystalgoh01@gmail.com', '$sakib_pw', 'management'),
            ('isakibul623@gmail.com', '$irene_pw', 'management'),
            ('ThomasShelby@gmail.com', '$preset_thomas_pw', 'customer');
    ";
    mysqli_query($conn, $sql);
}

//Orders
$sql = "CREATE TABLE IF NOT EXISTS orders (
    id INT(4) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    user_email VARCHAR(50) NOT NULL,
    status VARCHAR(50) NOT NULL,
    total INT(4) NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
mysqli_query($conn, $sql);

$sql = "CREATE TABLE IF NOT EXISTS order_items (
    order_id INT(4),
    item_id INT(4),
    quantity INT(11),
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (item_id) REFERENCES inventory(id) ON DELETE CASCADE ON UPDATE CASCADE
)";
mysqli_query($conn, $sql);
?>