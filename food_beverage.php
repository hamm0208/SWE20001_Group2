<?php
// Include database connection file
include 'database.php';

// Fetch food items from the database
$sql_food = "SELECT * FROM inventory WHERE type='Food'";
$result_food = mysqli_query($conn, $sql_food);

// Fetch beverage items from the database
$sql_beverage = "SELECT * FROM inventory WHERE type='Beverage'";
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
</head>

<body>
<?php include 'header.php'; ?>

<section class="container1">
    <div>
        <h1 class="category" id="foodmenu">FOOD MENU<span class="menu"></span></h1>
    </div>
    <section class="card-container">
        <?php while ($row_food = mysqli_fetch_assoc($result_food)) { ?>
            <section class="card">
                <figure class="front1">
                    <img src="images/food_image/<?php echo $row_food['item_image_name']; ?>" alt="<?php echo $row_food['name']; ?>">
                    <figcaption class="front-wording1">Food</figure>
                <div class="back">
                    <div class="back-wording">
                        <h5 class="info-title"><?php echo $row_food['name']; ?></h5>
                        <p class="info"><?php echo $row_food['description']; ?></p>
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
                    <figcaption class="front-wording1">Beverage</figure>
                <div class="back">
                    <div class="back-wording">
                        <h5 class="info-title"><?php echo $row_beverage['name']; ?></h5>
                        <p class="info"><?php echo $row_beverage['description']; ?></p>
                    </div>
                </div>
            </section>
        <?php } ?>
    </section>
</section>

<?php include 'footer.php'; ?>
</body>
</html>