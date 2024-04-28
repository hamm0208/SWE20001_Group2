<?php
include "connection.php";
session_start();
if($_SESSION["email"] == ""){
    echo '<script>alert("Please login first to start ordering");</script>';
    echo '<script>window.location.href = "log_in.php";</script>';
    exit();
}
// Initialize $_SESSION["cart_ids"] as an empty array if it's not set
if (!isset($_SESSION["cart_ids"])) {
    $_SESSION["cart_ids"] = [];
}

if(isset($_POST["id"])){
    $id = $_POST["id"];
    if(array_key_exists($id, $_SESSION["cart_ids"])){
        $sql = "SELECT * FROM inventory where id = $id";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);
            $inventory = $row['inventory'];
        }

        if($_SESSION["cart_ids"][$id]["itemQty"] < $inventory){
            $_SESSION["cart_ids"][$id]["itemQty"] += 1;
        }else{
            echo "<script>alert('" . $_SESSION["cart_ids"][$id]["itemName"] . " does not have enough stock!');</script>";
        }
    }else{
        $sql = "SELECT * FROM inventory where id = $id";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);
            if($row['inventory'] > 0){
                $_SESSION["cart_ids"][$id] = [
                    "itemID" => $row["id"],
                    "itemName" => $row["name"],
                    "itemPrice" => $row["price"],
                    "itemImgName" => $row["item_image_name"],
                    "itemQty" => 1
                ];
                echo "<script>alert('" . $_SESSION["cart_ids"][$id]["itemName"] . " has been added to your cart!');</script>";
            }else{
                echo "<script>alert('" .$row['name'] . " does not have enough stock!');</script>";
            }
            
            // Use item name from $_SESSION["cart_ids"] array
        }
    }
    echo '<script>window.location.href = "food_beverage.php";</script>';
    $id = "";
    exit();
}

if(isset($_POST["id_add"])){
    $id = $_POST["id_add"];
    if(array_key_exists($id, $_SESSION["cart_ids"])){
        $_SESSION["cart_ids"][$id]["itemQty"] += 1;
    }
    echo '<script>window.location.href = "cart.php";</script>';
    $id = "";
    exit();
}

if(isset($_POST["id_remove"])){
    $id = $_POST["id_remove"];
    if(array_key_exists($id, $_SESSION["cart_ids"])){
        $_SESSION["cart_ids"][$id]["itemQty"] -= 1;
        if ($_SESSION["cart_ids"][$id]["itemQty"] == 0) {
            unset($_SESSION["cart_ids"][$id]);
        }
    }
    echo '<script>window.location.href = "cart.php";</script>';
    $id = "";
    exit();
}


?>