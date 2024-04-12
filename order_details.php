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

    <title>Order Details</title>
</head>
    <?php
    include "header.php";
    include "connection.php";
    include 'font.php';
    $order_items = [];
    if(isset($_GET['orderID'])){
        $order_ID = $_GET["orderID"];
        $sql_check_id = "SELECT COUNT(*) AS count FROM orders WHERE id = '$order_ID'";
        $result_check_id = mysqli_query($conn, $sql_check_id);
        $row_check_id = mysqli_fetch_assoc($result_check_id);
        if($row_check_id['count'] == 0) {
            echo '<script>alert("Invalid ID");</script>';
            echo '<script>window.location.href = "orders.php";</script>';
            exit();
        }
    }else{
        echo '<script>alert("Invalid ID");</script>';
        echo '<script>window.location.href = "orders.php";</script>';
        exit();
    }

    $sql = "SELECT * FROM order_items WHERE order_id = '$order_ID'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $item_qty = $row['quantity'];
            $item_id = $row['item_id'];
            
            $sql_inventory = "SELECT * FROM inventory WHERE id = '$item_id'";
            $result_inventory = mysqli_query($conn, $sql_inventory);
            
            if(mysqli_num_rows($result_inventory) == 1){
                $row_inventory = mysqli_fetch_assoc($result_inventory);
                $order_items[$order_ID][] = [
                    "itemName" => $row_inventory["name"],
                    "itemPrice" => $row_inventory["price"],
                    "itemImgName" => $row_inventory["item_image_name"],
                    "itemQty" => $item_qty
                ];
            }
        }
    }
    ?>
<style>
    .go_back{
    text-decoration: none;
    color: black;
}
.order-details-wrapper{
    height: 100%
}
.order-details-h1{
        color: #8E4324;
    font-weight: bold;
    }
.order-details-table-wrapper{
    background-color: #EAE7DC;
    border-radius: 12px;
}
.order-item-name{
    font-size: 15px;
}

</style>
<body style='background-color:#d8c3a5;'>
    <div class="container-fluid w-75 order-details-wrapper mt-3">
        <div class="row">
            <div class="col">
                <h1 class='display-5 order-details-h1'>Order Details for Order ID: <?php echo $order_ID?></h1>
            </div>
            <div class="col d-flex justify-content-end align-items-center">
                <a href="orders.php" class="go_back">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M360-240 120-480l240-240 56 56-144 144h568v80H272l144 144-56 56Z"/></svg>
                    </span>
                    <span class='fira-sans-black'>View Order History</span>
                </a>
            </div>
        </div>
        <div class='order-details-table-wrapper p-3'>
            <table class="table text-center">
                <thead class="thead-dark">
                    <tr>
                        <th class='w-25'>Item</th>
                        <th class='w-25'>Price (RM)</th>
                        <th class='w-25'>Quantity</th>
                        <th class='w-25'>Total</th>
                    </tr>
                </thead>
                <?php
                    $grand_total = 0;
                    foreach ($order_items as $order_ID => $items) {
                        foreach ($items as $item) {
                            echo "<tr>";
                            echo "<td>";
                            echo "<p class='playfair-display order-item-name text-center my-0'>{$item['itemName']}</p>";
                            echo "<img src=\"Images/food_image/{$item['itemImgName']}\" alt=\"{$item['itemName']}\" class='img-fluid cart_item_img'>";
                            echo "</td>";
                            echo "<td class='align-middle h2'>";
                            echo "<span>{$item['itemPrice']}</span>";
                            echo "</td>";
                            echo "<td class='align-middle h2'>";
                            // If you want to display item quantity, you can do so here
                            echo "<span>{$item['itemQty']}</span>";
                            echo "</td>";
                            echo "<td class='align-middle h2 '>";
                            $totalPrice = $item['itemQty'] * $item['itemPrice'];
                            echo "<span>RM{$totalPrice}</span>";
                            echo "</td>";
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
                    <td colspan="3" class="text-right align-middle h3"><strong>Total:</strong></td>
                    <td><span class="grand-total-amount h2">RM<?php echo $grand_total+10; ; ?></span></td>
                </tr>
            </table>
        </div>
    </div> 


<?php
    include "footer.php"
    ?>
</body>
</html>