<?php
include 'database.php';
$sql_packages = "SELECT * FROM packages WHERE availability=true";
$result = mysqli_query($conn, $sql_packages);

// Fetch all rows into an array
$packages = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<style>
    .back_words {
            text-align: center;
        }
    .package_list{
        width: fit-content;
        text-align: left;
        padding: 0;
        margin: auto;
        margin-bottom: 20px;
    }
    .package_list li {
        font-size: 18px; /* Adjust the font size as needed */
        margin-bottom: 10px;
    }
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="FoodEge, catering, food, beverage">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Anjanaa Lyan AP Nagulan">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Package Menu</title>
</head>
<body id='background'>
    <?php include 'header.php'; ?>
    <section class="container1">
    <div>
        <h1 class="category" id="foodmenu">PACKAGES<span class="menu"></span></h1>
    </div>
    <section class="card-container">
        <?php foreach ($packages as $package) { ?>
            <section class="card">
                <figure class="front1">
                    <img src="images/food_image/<?php echo $package['image']; ?>" alt="<?php echo $package['name']; ?>">
                    <figcaption class="front-wording1"><?php echo $package['name']." (RM ". $package['price'] .")"; ?></figure>
                <div class="back">
                    <div class="back_words">
                        <h5 class="info-title">Package Contains</h5>
                        <?php 
                            $sql_items = "SELECT * FROM package_items WHERE package_id='{$package['package_id']}'";
                            $result_items = mysqli_query($conn, $sql_items);
                            echo "<ol class='package_list'>";

                            if (mysqli_num_rows($result_items) > 0) {
                                while ($row_item = mysqli_fetch_array($result_items)) {
                                    $item_id = $row_item["item_id"];
                                    $quantity = $row_item["quantity"];
                                    
                                    // Query to retrieve item details from the inventory table
                                    $sql_search_inventory = "SELECT * FROM inventory WHERE id = '$item_id'";
                                    $result_search_inventory = mysqli_query($conn, $sql_search_inventory);
                                    
                                    // Check if the item details are found
                                    if ($result_search_inventory && mysqli_num_rows($result_search_inventory) > 0) {
                                        $row_inventory = mysqli_fetch_array($result_search_inventory);
                                        $item_name = $row_inventory["name"];
                                        
                                        // Display item name along with its quantity
                                        echo "<li>  {$quantity} {$item_name}</li>";
                                    } else {
                                        // Display a message if item details are not found
                                        echo "Item details not found for item ID: {$item_id}";
                                    }
                                }
                                } else {
                                echo "No package items found.";
                                }
                            echo "</ol>";
                            ?>
                        <form action="cart_functions.php" method='POST'>
                            <input type='text' value="<?php echo $package['package_id']?>" name='id' hidden>
                            <button class="CartBtn" name='addToCart'>
                            <span class="IconContainer"> 
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512" fill="rgb(17, 17, 17)" class="cart"><path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"></path></svg>
                            </span>
                            <p class="text">Add to Cart</p>
                            </button>
                        </form>
                    </div>
                </div>
            </section>
        <?php } ?>
    </section>
</section>
</body>
</html>