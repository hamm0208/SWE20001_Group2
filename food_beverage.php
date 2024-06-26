<?php
// Include database connection file
include 'database.php';

// Fetch food items from the database
$sql_food = "SELECT * FROM inventory WHERE type='Food'";
$result_food = mysqli_query($conn, $sql_food);

// Fetch beverage items from the database
$sql_beverage = "SELECT * FROM inventory WHERE type='Beverage'";
$result_beverage = mysqli_query($conn, $sql_beverage);

// Handle sorting and filtering for Food
$sortFood = $_GET['sortFood'] ?? 'name_asc';
$filterFoodPrice = $_GET['filterFoodPrice'] ?? 'all';

// Build SQL query for food
$sql_food = "SELECT * FROM inventory WHERE type='Food'";
if ($filterFoodPrice == 'under10') {
    $sql_food .= " AND price < 10";
} elseif ($filterFoodPrice == 'above10') {
    $sql_food .= " AND price >= 10";
}

// Apply sorting for Food
switch ($sortFood) {
    case 'name_asc':
        $sql_food .= " ORDER BY name ASC";
        break;
    case 'name_desc':
        $sql_food .= " ORDER BY name DESC";
        break;
    case 'price_asc':
        $sql_food .= " ORDER BY price ASC";
        break;
    case 'price_desc':
        $sql_food .= " ORDER BY price DESC";
        break;
}

// Handle sorting and filtering for Beverage
$sortBeverage = $_GET['sortBeverage'] ?? 'name_asc';
$filterBeveragePrice = $_GET['filterBeveragePrice'] ?? 'all';

// Build SQL query for beverage
$sql_beverage = "SELECT * FROM inventory WHERE type='Beverage'";
if ($filterBeveragePrice == 'under10') {
    $sql_beverage .= " AND price < 10";
} elseif ($filterBeveragePrice == 'above10') {
    $sql_beverage .= " AND price >= 10";
}

// Apply sorting for Beverage
switch ($sortBeverage) {
    case 'name_asc':
        $sql_beverage .= " ORDER BY name ASC";
        break;
    case 'name_desc':
        $sql_beverage .= " ORDER BY name DESC";
        break;
    case 'price_asc':
        $sql_beverage .= " ORDER BY price ASC";
        break;
    case 'price_desc':
        $sql_beverage .= " ORDER BY price DESC";
        break;
}

$result_food = mysqli_query($conn, $sql_food);
$result_beverage = mysqli_query($conn, $sql_beverage);

?>

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
    <title>Food & Beverage Menu</title>
    <style>
        .menu-sort-filter {
        display: flex; /* Enables flexbox layout */
        justify-content: center; /* Centers items horizontally in the container */
        align-items: start; /* Aligns items at the start vertically */
        flex-wrap: wrap; /* Allows items to wrap if not enough space */
        text-align: left;
        width: 100%; /* Ensures the container takes up full width */
        margin-left: 3.8%;
        padding: 20px; /* Uniform padding for spacing */
        box-sizing: border-box; /* Includes padding and border in the element's total width and height */
        }

        .menu-sort-filter form {
            width: 300px; 
            display: flex; 
            flex-direction: column; 
            margin-right: 20px; 
            margin-bottom: 20px; 
            background-color: #e98074;
            padding: 20px;
            border-radius: 28px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .menu-sort-filter label {
            font-family: 'Fira Sans', sans-serif;
            font-size: 18px;
            color: #fff;
            margin-bottom: 10px; 
        }

        .menu-sort-filter select,
        .menu-sort-filter button {
            font-family: 'Fira Sans', sans-serif;
            width: 100%; 
            padding: 10px;
            border-radius: 5px;
            border: none;
            margin-bottom: 10px; 
        }

        .menu-sort-filter select {
            background-color: #d8c3a5;
            color: #8E3E1B;
        }

        .menu-sort-filter button {
            background-color: #8E3E1B;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .menu-sort-filter button:hover {
            background-color: #e85a4f;
            color: #d8c3a5;
        }
    </style>
</head>

<body>
<?php include 'header.php'; ?>

<section class="container1">
    <br>
    <div class="menu-sort-filter">
        <!-- Sorting and Filtering for Food -->
        <form action="food_beverage.php" method="get">
            <label for="sortFood">Sort Food By:</label>
            <select name="sortFood" id="sortFood">
                <option value="name_asc">Name (A-Z)</option>
                <option value="name_desc">Name (Z-A)</option>
                <option value="price_asc">Price (Low-High)</option>
                <option value="price_desc">Price (High-Low)</option>
            </select>
            <br>
            <label for="filterFoodPrice">Filter Food By Price:</label>
            <select name="filterFoodPrice" id="filterFoodPrice">
                <option value="all">All</option>
                <option value="under10">Under RM10</option>
                <option value="above10">Above RM10</option>
            </select>
            <button type="submit">Apply</button>
        </form>
        <br>
        <br>
        <!-- Sorting and Filtering for Beverages -->
        <form action="food_beverage.php" method="get">
            <label for="sortBeverage">Sort Beverage By:</label>
            <select name="sortBeverage" id="sortBeverage">
                <option value="name_asc">Name (A-Z)</option>
                <option value="name_desc">Name (Z-A)</option>
                <option value="price_asc">Price (Low-High)</option>
                <option value="price_desc">Price (High-Low)</option>
            </select>
            <br>
            <label for="filterBeveragePrice">Filter Beverage By Price:</label>
            <select name="filterBeveragePrice" id="filterBeveragePrice">
                <option value="all">All</option>
                <option value="under10">Under RM10</option>
                <option value="above10">Above RM10</option>
            </select>
            <button type="submit">Apply</button>
        </form>
    </div>

    <div>
        <h1 class="category" id="foodmenu">FOOD MENU<span class="menu"></span></h1>
    </div>
    <section class="card-container">
        <?php while ($row_food = mysqli_fetch_assoc($result_food)) { ?>
            <section class="card">
                <figure class="front1">
                    <img src="images/food_image/<?php echo $row_food['item_image_name']; ?>" alt="<?php echo $row_food['name']; ?>">
                    <figcaption class="front-wording1"><?php echo $row_food['name'] ?></figure>
                <div class="back">
                    <div class="back-wording">
                        <h5 class="info-title"><?php echo $row_food['name'] ." (RM ". $row_food['price'] .")"; ?></h5>
                        <p class="info"><?php echo $row_food['description']; ?></p>
                        <form action="cart_functions.php" method='POST'>
                            <input type='text' value="<?php echo $row_food['id']?>" name='id' hidden>
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

<section class="container1">
    <div>
        <h1 class="category" id="beveragemenu">BEVERAGE MENU<span class="menu"></span></h1>
    </div>
    <section class="card-container">
        <?php while ($row_beverage = mysqli_fetch_assoc($result_beverage)) { ?>
            <section class="card">
                <figure class="front1">
                    <img src="images/food_image/<?php echo $row_beverage['item_image_name']; ?>" alt="<?php echo $row_beverage['name']; ?>">
                    <figcaption class="front-wording1"><?php echo $row_beverage['name']?></figure>
                <div class="back">
                    <div class="back-wording">
                        <h5 class="info-title"><?php echo $row_beverage['name']; ?></h5>
                        <p class="info"><?php echo $row_beverage['description']; ?></p>
                        <form action="cart_functions.php" method='POST'>
                            <input type='text' value="<?php echo $row_beverage['id']?>" name='id' hidden>
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

<?php include 'footer.php'; ?>
</body>
</html>