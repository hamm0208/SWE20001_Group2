<?php
session_start();

if (!isset($_SESSION["cart_ids"])) {
    $_SESSION["cart_ids"] = [];
}
echo var_dump($_SESSION["cart_ids"]);
if (isset($_GET["itemID"])) {
    $id_to_delete = intval($_GET["itemID"]);
    echo $id_to_delete."\t";
    $found = false;
    foreach ($_SESSION["cart_ids"] as $key => $id) {
        if ($_GET["itemID"] == $id['itemID']) {
            unset($_SESSION["cart_ids"][$key]);
            $_SESSION["cart_ids"] = array_values($_SESSION["cart_ids"]);
            $found = true;
            echo "<script>alert('Item has been removed from the cart');</script>";
            break;
        }
  }

    if (!$found) {
        echo "<script>alert('Item ID does not exist in the cart');</script>";
    }
   echo '<script>window.location.href = "cart.php";</script>';
    $id = "";
    exit();
}

?>