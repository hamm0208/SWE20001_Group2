<?php
session_start();
if(!isset($_SESSION['email'])){
    $_SESSION["email"] = "";
}
if(!isset($_SESSION['type'])){
    $_SESSION["type"] = "";
}
if(!isset($_SESSION['cart_ids'])){
    $_SESSION["cart_ids"] = "";
}
?>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="CSS/style.css"/>
<?php
?>
<body>

    <!-- Navbar (sit on top) -->
    <nav>
        <div class="nav-content">
            <div class="FoodEdge-logo">
                <a href="index.php">
                    <img src="images/web_resources/FoodEdgeLogo_NoBG.png" width="150" height="150" alt="FoodEdgeLogo_NoBG" title="FoodEdgeLogo_NoBG">
                </a>
            </div>
            <div class="right-align">
                <ul class="nav-links">
                    <li class="dropdown">
                        <a href="menu.php" class="dropdownbutton">CATERING MENU</a>
                    </li>
                    <li><a href="orders.php">ORDERS</a></li>
                    <li><a href="aboutus.php">ABOUT US</a></li>
                    <?php
                    if(isset($_SESSION['email'])){
                        if($_SESSION['email'] == ""){
                            echo "<li><a href='log_in.php'>LOG IN</a></li>";

                        }else{
                            echo "<li><a href='profile.php'>MY PROFILE</a></li>";

                        }
                    }
                    ?>
                    <li>
                        <div class="cart_icon_container">
                            <a href="cart.php"  class="cart_icon" ><svg xmlns="http://www.w3.org/2000/svg" fill="#8E3E1B" height="24" viewBox="0 -960 960 960" width="24"><path d="M280-80q-33 0-56.5-23.5T200-160q0-33 23.5-56.5T280-240q33 0 56.5 23.5T360-160q0 33-23.5 56.5T280-80Zm400 0q-33 0-56.5-23.5T600-160q0-33 23.5-56.5T680-240q33 0 56.5 23.5T760-160q0 33-23.5 56.5T680-80ZM246-720l96 200h280l110-200H246Zm-38-80h590q23 0 35 20.5t1 41.5L692-482q-11 20-29.5 31T622-440H324l-44 80h480v80H280q-45 0-68-39.5t-2-78.5l54-98-144-304H40v-80h130l38 80Zm134 280h280-280Z"/></svg></a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>