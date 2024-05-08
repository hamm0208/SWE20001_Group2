
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodEdge-Management Order Detail</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/bootstrap.css">    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    
    <style>
        .first-row-margin {
            margin-left: 0.5%; 
        }
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
</head>
<body id="background">
    <?php
    include("font.php");
    include('connection.php');
    session_start();
    try{
    if(isset($_SESSION["email"]) && isset($_SESSION["type"])) {
            if($_SESSION["type"] == "management"){
                $email = $_SESSION['email'];
                $user = $_SESSION['type'];
            }else{
                echo '<script>alert("Unauthorised Access!");</script>';
                echo '<script>window.location.href = "log_in.php";</script>';
                exit();
            }
        }else{
            echo '<script>alert("Unauthorised Access!");</script>';
                echo '<script>window.location.href = "log_in.php";</script>';
                exit();
        }
    }catch(Exception $e){};

    if(isset($_GET['orderID'])){
        $order_ID = $_GET["orderID"];
        $sql_check_id = "SELECT COUNT(*) AS count FROM orders WHERE id = '$order_ID'";
        $result_check_id = mysqli_query($conn, $sql_check_id);
        $row_check_id = mysqli_fetch_assoc($result_check_id);
        if($row_check_id['count'] == 0) {
            echo '<script>alert("Invalid ID");</script>';
            echo '<script>window.location.href = "management_orders.php";</script>';
            exit();
        }
    }else{
        echo '<script>alert("Invalid ID");</script>';
        echo '<script>window.location.href = "management_orders.php";</script>';
        exit();
    }

    $sql = "SELECT * FROM order_items WHERE order_id = '$order_ID'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $item_qty = $row['quantity'];
            $item_id = $row['item_id'];
            if($item_id[0]=="P"){
                $sql_inventory = "SELECT * FROM packages WHERE package_id = '$item_id'";
            }else{
                $sql_inventory = "SELECT * FROM inventory WHERE id = '$item_id'";
            }
            $result_inventory = mysqli_query($conn, $sql_inventory);
            
            if(mysqli_num_rows($result_inventory) == 1){
                $row_inventory = mysqli_fetch_assoc($result_inventory);
                $order_items[$order_ID][] = [
                    "itemName" => $row_inventory["name"],
                    "itemID" => $row_inventory["package_id"] ?? null,
                    "itemPrice" => $row_inventory["price"],
                    "itemImgName" => $row_inventory["item_image_name"] ?? null,
                    "itemQty" => $item_qty
                ];
            }
        }
    }
    
    ?>
    <div class="container-fluid">
        <div class="row first-row-margin">
            <?php include("management_navbar.php")?>

            <div class="col-10 ">
                <div class="row">
                    <div class="col-10 pt-5 mx-3">
                        <h1 class="pt-5 fira-sans-black">Order Details For Order ID: <?php echo $order_ID ?></h1>
                    </div>
                    <div class="col d-flex justify-content-end align-items-center">
                        <a href="management_orders.php" class="go_back">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M360-240 120-480l240-240 56 56-144 144h568v80H272l144 144-56 56Z"/></svg>
                            </span>
                            <span class='fira-sans-black'>View Order History</span>
                        </a>
                    </div>
                </div>
                <div class="container-fluid order_container">
                    <div class='order-details-table-wrapper p-3'>
                        <table class="table text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th class='w-25 bg-dark text-light'>Item</th>
                                    <th class='w-25 bg-dark text-light'>Price (RM)</th>
                                    <th class='w-25 bg-dark text-light'>Quantity</th>
                                    <th class='w-25 bg-dark text-light'>Total</th>
                                </tr>
                            </thead>
                            <?php
                                $grand_total = 0;
                                foreach ($order_items as $order_ID => $items) {
                                    foreach ($items as $item) {
                                        echo "<tr>";
                                        echo "<td class='border border-dark'>";
                                        echo "<p class='playfair-display order-item-name text-center my-0'>{$item['itemName']}</p>";
                                        if(isset($item['itemID']) && $item['itemID'][0] == "P") {
                                            $package_id = $item['itemID'];
                                            $sql_items = "SELECT * FROM package_items WHERE package_id='$package_id'";
                                            $result_items = mysqli_query($conn, $sql_items);
                                            echo "<ol class='package_list my-2 text-left'>";
                
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
                                            }else {
                                                echo "No package items found.";
                                                }
                                            echo "</ol>";
                                        }else{
                                            echo "<img src=\"Images/food_image/{$item['itemImgName']}\" alt=\"{$item['itemName']}\" class='img-fluid cart_item_img'>";
                                        }
                                        echo "</td>";
                                        echo "<td class='align-middle h2 border border-dark'>";
                                        echo "<span>{$item['itemPrice']}</span>";
                                        echo "</td>";
                                        echo "<td class='align-middle h2 border border-dark'>";
                                        // If you want to display item quantity, you can do so here
                                        echo "<span>{$item['itemQty']}</span>";
                                        echo "</td>";
                                        echo "<td class='align-middle h2 border border-dark'>";
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
            </div>
        </div>
    </div>
</div>
</body>
</html>
