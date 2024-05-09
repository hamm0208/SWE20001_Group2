<?php
session_start();
include "connection.php";

if($_SESSION["email"] == ""){
    echo '<script>alert("Please Login First");</script>';
    echo '<script>window.location.href = "log_in.php";</script>';
    exit();
}else{
    $email = $_SESSION["email"];
}

if(isset($_SESSION["cart_ids"]) && !empty($_SESSION["cart_ids"])){
    $grand_total = 10;
    foreach($_SESSION["cart_ids"] as $item){
        $grand_total+= ($item["itemPrice"] * $item['itemQty']);
    }
    
    $receiverName = $_POST['receiverName'];
    $contactNumber = $_POST['contactNumber']; 
    $receiverEmail = $_POST['email']; 
    $eventDate = $_POST['eventDate']; 
    $deliveryOption = $_POST['deliveryOption']; 
    $deliveryAddress = $_POST['deliveryAddress']; 
    $deliveryTime = $_POST['deliveryTime']; 
    $pickUpTime = $_POST['pickUpTime']; 
    $specialRemark = $_POST['specialRemark']; 
    $paymentMethod = $_POST['paymentMethod']; 

    //Inserting orders
    $sql = "INSERT INTO orders SET 
            user_email = '$email', 
            receiver_name = '$receiverName', 
            receiver_email = '$receiverEmail', 
            receiver_contact_number = '$contactNumber', 
            event_date = '$eventDate', 
            delivery_option = '$deliveryOption', 
            delivery_address = '$deliveryAddress', 
            delivery_time = '$deliveryTime', 
            pick_up_time = '$pickUpTime', 
            special_remark = '$specialRemark', 
            payment_method = '$paymentMethod', 
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
        if($id[0] == "P"){
            $sql_find_item = "SELECT * FROM package_items WHERE package_id = '$id'";
            $result_find_item = mysqli_query($conn, $sql_find_item);
            if (mysqli_num_rows($result_find_item) > 0) {
                while ($row_item = mysqli_fetch_array($result_find_item)){
                    $item_id = $row_item["item_id"];
                    $item_quantity = $row_item["quantity"];
                    $sql_search_inventory = "SELECT inventory FROM inventory WHERE id = '$item_id'";
                    $result_search_inventory = mysqli_query($conn, $sql_search_inventory);
                    if ($result_search_inventory && mysqli_num_rows($result_search_inventory) > 0) {
                        $row = mysqli_fetch_assoc($result_search_inventory);
                        $inventory_amount = $row['inventory'];
                    }
                    $updated_inventory = $inventory_amount -$item_quantity;
                    $sql = "UPDATE inventory
                        SET inventory = '$updated_inventory'
                            WHERE id = $item_id
                        ";
                    $result = mysqli_query($conn, $sql);
                }
            }
        }else{
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
        }
        $sql = "INSERT INTO order_items (order_id, item_id, quantity) VALUES ('$total_rows', '$id', '$quantity')";
        $result = mysqli_query($conn, $sql);
    }
    $_SESSION["cart_ids"] = [];
    echo "<script>alert('Your Order ID is: " . $total_rows . ". Order placed succesfully! You can view your order in the order tab.');</script>";
    echo '<script>window.location.href = "feedbackform.php";</script>';
    exit();
}else{
    echo "<script>alert('Your cart is empty, cannot proceed order.');</script>";
    echo '<script>window.location.href = "cart.php";</script>';
    exit();
}

?>