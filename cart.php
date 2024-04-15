<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="keywords" content="FoodEge, catering, food, beverage">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Beckham Then">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>View Cart</title>
</head>
<body style='background-color:#d8c3a5;'> 

<?php
include 'header.php'; 
include 'connection.php';
session_start();
if(!isset($_SESSION["cart_ids"])){
    $_SESSION["cart_ids"] = [];
}
?>
<style>


</style>
<div class="container-fluid w-75 cart_container mt-3">
    <div class="row">
        <div class="col">
            <h1 class='display-4 fira-sans-black '>My Cart</h1>
        </div>
        <div class="col d-flex justify-content-end align-items-center">
            <a href="menu.php" class="go_back">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M360-240 120-480l240-240 56 56-144 144h568v80H272l144 144-56 56Z"/></svg>
                </span>
                <span class='fira-sans-black'>Add more item to cart</span>
            </a>
        </div>
    </div>
    <div class='cart-table-wrapper p-3'>
        <?php
            if(count($_SESSION["cart_ids"]) == 0){
                echo'<h2 class="text-center display-4">Your cart is empty</h2>';
            }
        ?>
        <table class="table">
            <thead  class="thead-dark thead">
                <tr>
                    <th class='w-25'>Item</th>
                    <th class='w-25'>Price (RM)</th>
                    <th class='w-25'>Quantity</th>
                    <th class='w-25'>Total</th>
                    <th></th>
                </tr>
            </thead>
            <?php
            $grand_total = 0;
            foreach ($_SESSION["cart_ids"] as $item) {
                if ($item['itemQty'] > 0) {
                    echo "<tr>";
                        echo "<td>";
                        echo "<p class='playfair-display cart-item-name my-0'>{$item['itemName']}</p>";
                        echo "<img src=\"Images/food_image/{$item['itemImgName']}\" alt=\"{$item['itemName']}\" class='img-fluid cart_item_img'>";
                        echo "</td>";
                        echo "<td class='align-middle h2'>";
                        echo "<span>{$item['itemPrice']}</span>";
                        echo "</td>";
                        echo "<td class='align-middle h2'>";
                        echo "<form action=\"cart_functions.php\" method=\"post\" style=\"display: inline;\">";
                        echo "<input type=\"hidden\" name=\"id_remove\" value=\"{$item['itemID']}\">";
                        echo "<button type=\"submit\" class=\"svg-button\" name=\"remove\" style=\"border: none; background: none;\">";
                        echo "<svg xmlns=\"http://www.w3.org/2000/svg\" height=\"24\" viewBox=\"0 -960 960 960\" width=\"24\"><path d=\"M200-440v-80h560v80H200Z\"/></svg>";
                        echo "</button>";
                        echo "</form>";
                        echo "<span>{$item['itemQty']}</span>";
                        echo "<form action=\"cart_functions.php\" method=\"post\" style=\"display: inline;\">";
                        echo "<input type=\"hidden\" name=\"id_add\" value=\"{$item['itemID']}\">";
                        echo "<button type=\"submit\" class=\"svg-button\" name=\"add\" style=\"border: none; background: none;\">";
                        echo "<svg xmlns=\"http://www.w3.org/2000/svg\" height=\"24\" viewBox=\"0 -960 960 960\" width=\"24\"><path d=\"M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z\"/></svg>";
                        echo "</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "<td class='align-middle h2 '>";
                        $totalPrice = $item['itemQty'] * $item['itemPrice'];
                        echo "<span>RM{$totalPrice}</span>";
                        echo "</td>";
                        echo "<td>";
                        echo '<a href="deleteItemFromCart.php?itemID=' . $item['itemID'] . '">';
                        echo '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>';
                        echo '</a>';

                        echo "</td>";
                    echo "</tr>";
                    $grand_total += $totalPrice; 
                }
            }
            
            ?>
            <tr class="delivery-fee-row">
                <td colspan="3" class="text-right align-middle h4"><strong>Delivery Fee:</strong></td>
                <td><span class="grand-total-amount h3">RM 10</span></td>
            </tr>
            <tr>
                <td colspan="3" class="text-right align-middle h3"><strong>Item total:</strong></td>
                <td><span class="grand-total-amount h2">RM<?php echo $grand_total+10; ; ?></span></td>
            </tr>
            
            <tr>
                <td colspan="3" class="text-right align-middle h2"></td>
                <td class="text-right">
                <button id="place_order_btn" class="place_order_btn mt-3" <?php echo ($grand_total == 10) ? 'disabled' : ''; ?>>Place Order</button>
                </td>
                
            </tr>
        </table>
    </div>
</div>
<script>
    // Add an event listener to the button
    document.getElementById("place_order_btn").addEventListener("click", function() {
        // Check if the button is not disabled
        if (!this.disabled) {
            // Redirect to add_order.php
            window.location.href = "add_order.php";
        }else{
            
        }
    })
    var button = document.getElementById("place_order_btn");
    // Add an event listener to the button
    document.getElementById("place_order_btn").addEventListener("click", function() {
        // Check if the button is not disabled
        if (!this.disabled) {
            // Redirect to add_order.php
            element.classList.toggle("place_order_btn mt-3");

            window.location.href = "add_order.php";
        }else{
            element.classList.toggle("place_order_btn1 mt-3");
            
        }
    });
    function toggleClassBasedOnTotal(grandTotal) {
        var button = document.getElementById("place_order_btn");
        if (grandTotal > 10) {
            button.classList.remove("place_order_btn1");
            button.classList.add("place_order_btn");
        } else {
            button.classList.remove("place_order_btn");
            button.classList.add("place_order_btn1");
        }
    }

    // Call the function with the initial grand total
    toggleClassBasedOnTotal(<?php echo $grand_total; ?>);
</script>
</div>
<?php include 'footer.php'; ?>
</body>

</html>
