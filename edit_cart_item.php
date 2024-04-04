<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit') {
    $index = $_POST['index'];
    $quantity = $_POST['quantity'];

    if ($quantity == 0) {
        // If quantity is 0, remove the item from the cart
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // Re-index the array after removal
    } else {
        // Update the quantity of the item in the cart
        $_SESSION['cart'][$index]['quantity'] = $quantity;
    }
}
?>
