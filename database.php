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
        ('Fresh Fruit Smoothie', 'A refreshing blend of fresh fruits such as strawberries, bananas, and mangoes, blended with yogurt and ice.', 'Beverage', 'Western', 100, 6, 'fruit_smoothie.jpg'),
        ('Nasi Lemak', 'A traditional Malaysian dish consisting of fragrant rice cooked in coconut milk, served with sambal (spicy chili paste), fried crispy anchovies, roasted peanuts, sliced cucumber, and a hard-boiled egg.', 'Food', 'Malaysian', 100, 8, 'nasi_lemak.jpg'),
        ('Kimchi Fried Rice', 'A popular Korean dish made with cooked rice, kimchi, vegetables, and often meat or seafood, all stir-fried together in a hot pan.', 'Food', 'Korean', 100, 10, 'kimchi_fried_rice.jpg'),
        ('Chicken Teriyaki', 'Grilled chicken glazed with a sweet and savory teriyaki sauce, served with steamed rice and vegetables.', 'Food', 'Japanese', 100, 14, 'chicken_teriyaki.jpg'),
        ('Sushi Platter', 'Assorted sushi rolls and nigiri, including tuna, salmon, shrimp, and avocado, served with pickled ginger, wasabi, and soy sauce.', 'Food', 'Japanese', 100, 18, 'sushi_platter.jpg'),
        ('Beef Rendang', 'A flavorful dish made with tender beef slow-cooked in a rich and aromatic coconut curry sauce, flavored with a blend of spices such as lemongrass, galangal, ginger, and turmeric.', 'Food', 'Malaysian', 100, 16, 'beef_rendang.jpg'),
        ('Bibimbap', 'A Korean mixed rice dish topped with assorted vegetables, a fried egg, and sliced beef or tofu, served with spicy gochujang sauce.', 'Food', 'Korean', 100, 12, 'bibimbap.jpg'),
        ('Nasi Goreng', 'Malaysian fried rice cooked with a mix of vegetables, shrimp, chicken, and flavored with sweet soy sauce, chili, and shrimp paste, served with a fried egg on top.', 'Food', 'Malaysian', 100, 10, 'nasi_goreng.jpg'),
        ('Tonkatsu', 'A Japanese dish consisting of breaded and deep-fried pork cutlets, served with shredded cabbage and tonkatsu sauce.', 'Food', 'Japanese', 100, 15, 'tonkatsu.jpg'),
        ('Iced Teh Tarik', 'A Malaysian classic - black tea sweetened with condensed milk and \'pulled\' to create a frothy top, served over ice.', 'Beverage', 'Malaysian', 100, 5, 'iced_teh_tarik.jpg'),
        ('Soju', 'A popular Korean alcoholic beverage distilled from rice, barley, or wheat, known for its smooth taste and versatility.', 'Beverage', 'Korean', 100, 10, 'soju.jpg'),
        ('Green Tea Matcha Latte', 'A Japanese-inspired drink made with matcha green tea powder, steamed milk, and a touch of sweetness.', 'Beverage', 'Japanese', 100, 6, 'matcha_latte.jpg')
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


$beckham_pw = password_hash("12345", PASSWORD_DEFAULT);
$anjaana_pw = password_hash("12345", PASSWORD_DEFAULT);
$crystal_pw = password_hash("12345", PASSWORD_DEFAULT);
$sakib_pw = password_hash("12345", PASSWORD_DEFAULT);
$irene_pw = password_hash("12345", PASSWORD_DEFAULT);
$preset_thomas_pw = password_hash("12345", PASSWORD_DEFAULT);
$sql_check_empty = "SELECT COUNT(*) FROM accounts";
$result = mysqli_query($conn, $sql_check_empty);
$row = mysqli_fetch_array($result);
$count = $row[0];

if ($count == 0) {
    $sql_insert_preset = "INSERT INTO accounts (email, password, type)
        VALUES
        ('thenbeckham@gmail.com', '$beckham_pw', 'management'),
        ('everlynchin09@gmail.com', '$anjaana_pw', 'management'),
        ('anjanaalyann@gmail.com', '$crystal_pw', 'management'),
        ('crystalgoh01@gmail.com', '$sakib_pw', 'management'),
        ('isakibul623@gmail.com', '$irene_pw', 'management'),
        ('ThomasShelby@gmail.com', '$preset_thomas_pw', 'customer')";
        
    mysqli_query($conn, $sql_insert_preset);
}

$sql = "CREATE TABLE IF NOT EXISTS orders (
    id INT(4) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    user_email VARCHAR(50) NOT NULL,
    receiver_name VARCHAR(100) NOT NULL,
    receiver_email VARCHAR(50) NOT NULL,
    receiver_contact_number VARCHAR(20) NOT NULL,
    event_date DATE NOT NULL,
    delivery_option VARCHAR(50) NOT NULL,
    delivery_address VARCHAR(255), -- This field should be optional based on the delivery option
    special_remark TEXT,
    payment_method VARCHAR(50) NOT NULL,
    status VARCHAR(50) NOT NULL,
    total INT(4) NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
mysqli_query($conn, $sql);

$sql = "CREATE TABLE IF NOT EXISTS order_items (
    order_id INT(4),
    item_id VARCHAR(4),
    quantity INT(11),
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE ON UPDATE CASCADE
)";
mysqli_query($conn, $sql);

// Inquiries
$sql = "CREATE TABLE IF NOT EXISTS inquiries (
    inquiry_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    subject VARCHAR(255) NOT NULL,
    custom_subject VARCHAR(255),
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
mysqli_query($conn, $sql);

// Feedbacks
$sql = "CREATE TABLE IF NOT EXISTS feedbacks (
    feedback_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    eventType VARCHAR(255) NOT NULL,
    foodRating INT NOT NULL,
    serviceRating INT NOT NULL,
    feedback TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
mysqli_query($conn, $sql);


//Packages
$sql = "CREATE TABLE IF NOT EXISTS packages (
    package_id VARCHAR(4) PRIMARY KEY NOT NULL,
    name VARCHAR(255) NOT NULL,
    availability VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2),
    image VARCHAR(100) NULL
)";
mysqli_query($conn, $sql);

//Package Item
$sql = "CREATE TABLE IF NOT EXISTS package_items (
    package_id VARCHAR(4),
    item_id INT(4),
    quantity INT(11),
    PRIMARY KEY (package_id, item_id), -- Composite primary key
    FOREIGN KEY (package_id) REFERENCES packages(package_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (item_id) REFERENCES inventory(id) ON DELETE CASCADE ON UPDATE CASCADE
)";
mysqli_query($conn, $sql);

$preset_packages = array(
    array(
        'name' => 'Duo plater',
        'price' => 50,
        'items' => array(
            array('item_id' => 2, 'quantity' => 1), // Classic Margherita Pizza
            array('item_id' => 7, 'quantity' => 1), // Kimchi fried rice
            array('item_id' => 15, 'quantity' => 2) // Soju
        ),
        'image' => "duo_platter.jpg"
    ),
    array(
        'name' => 'Family Feast',
        'price' => 60,
        'items' => array(
            array('item_id' => 1, 'quantity' => 1), // Deluxe Cheeseburger
            array('item_id' => 3, 'quantity' => 1), // Grilled Chicken Caesar Salad
            array('item_id' => 6, 'quantity' => 1), // Nasi Lemak
            array('item_id' => 12, 'quantity' => 1), // Nasi Goreng
            array('item_id' => 14, 'quantity' => 4) // Iced Teh Tarik
        ),
        'image' => "family_feast.jpg"
    ),
    array(
        'name' => 'Health Boost',
        'price' => 30,
        'items' => array(
            array('item_id' => 3, 'quantity' => 1), // Grilled Chicken Caesar Salad
            array('item_id' => 5, 'quantity' => 1), // Fresh Fruit Smoothie
            array('item_id' => 11, 'quantity' => 1) // Biibimbap
        ),
        'image' => "health_boost.jpg"
    )
);
$sql_check_empty = "SELECT COUNT(*) FROM packages";
$result = mysqli_query($conn, $sql_check_empty);
$row = mysqli_fetch_array($result);
$count = $row[0];

if ($count == 0) {
    $sql_get_max_id = "SELECT MAX(CAST(SUBSTRING(package_id, 2) AS UNSIGNED)) FROM packages";
    $result = mysqli_query($conn, $sql_get_max_id);
    $row = mysqli_fetch_array($result);
    $max_id = $row[0];
    $max_id = $max_id ? $max_id : 0; // If no packages, set max_id to 0

    foreach ($preset_packages as $package) {
        $package_id = "P" . ($max_id + 1); // Construct package_id based on the max_id
        
        // Insert package into the packages table
        $sql = "INSERT INTO packages (package_id, name, availability, price, image) VALUES ('$package_id', '{$package['name']}', true ,'{$package['price']}', '{$package['image']}')";
        mysqli_query($conn, $sql);
        
        // Insert package items into the package_items table
        foreach ($package['items'] as $item) {
            $item_id = $item['item_id'];
            $quantity = $item['quantity'];
            $sql = "INSERT INTO package_items (package_id, item_id, quantity) VALUES ('$package_id', '$item_id', '$quantity')";
            mysqli_query($conn, $sql);
        }
        $max_id++;
    }
}
?>