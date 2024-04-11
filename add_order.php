<?php
session_start();
include "connection.php";

if(isset($_SESSION["cart_ids"]) && !empty($_SESSION["cart_ids"])){
    $grand_total = 10;
    foreach($_SESSION["cart_ids"] as $item){
        $grand_total+= ($item["itemPrice"] * $item['itemQty']);
    }
    echo "<br>".$grand_total."<br>";
    
    //Inserting orders
    $sql = "INSERT INTO orders
            SET
            user_email = 'thenbeckham@gmail.com',
            status = 'In Progress',
            total = $grand_total";
    $result = mysqli_query($conn, $sql);

    //Find the latest order id
    $sql = "SELECT COUNT(*) AS total_rows FROM orders";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $total_rows = $row['total_rows'];

    //Inserting order items into order_items table
    foreach($_SESSION["cart_ids"] as $item){
        $id = $item['itemID'];
        $quantity = $item['itemQty'];

        $sql = "SELECT inventory FROM inventory WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $inventory_amount = $row['inventory'];
        }

        $updated_inventory = $inventory_amount -$quantity;
        $sql = "UPDATE inventory
                    SET inventory = '$updated_inventory'
                        WHERE id = $id
                ";
        $result = mysqli_query($conn, $sql);

        $sql = "INSERT INTO order_items (order_id, item_id, quantity) VALUES ('$total_rows', '$id', '$quantity')";
        $result = mysqli_query($conn, $sql);
    }

    $_SESSION["cart_ids"] = [];
    echo "<script>alert('Your Order ID is: " . $total_rows . ". Order placed succesfully! You can view your order in the order tab.');</script>";
    echo '<script>window.location.href = "menu.php";</script>';
    exit();
}else{
    echo "<script>alert('Your cart is empty, cannot proceed order.');</script>";
    echo '<script>window.location.href = "menu.php";</script>';
    exit();
}

?>