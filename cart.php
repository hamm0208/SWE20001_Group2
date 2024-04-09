<?php
session_start();

// Function to add food to cart
function addToCart($food_id, $quantity) {
    // Initialize cart if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Add or update item in the cart
    if (isset($_SESSION['cart'][$food_id])) {
        $_SESSION['cart'][$food_id] += $quantity;
    } else {
        $_SESSION['cart'][$food_id] = $quantity;
    }
}

// Function to update quantity of food in cart
function updateCart($food_id, $quantity) {
    if ($quantity <= 0) {
        removeFromCart($food_id);
    } else {
        $_SESSION['cart'][$food_id] = $quantity;
    }
}

// Function to remove food from cart
function removeFromCart($food_id) {
    unset($_SESSION['cart'][$food_id]);
}

// Function to display food items in the cart
function displayCart() {
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $food_id => $quantity) {
            // Display food item details and quantity
            echo "Food ID: $food_id, Quantity: $quantity<br>";
        }
    } else {
        echo "Cart is empty";
    }
}

// Add food to cart (e.g., from form submission)
if (isset($_POST['add_to_cart'])) {
    $food_id = $_POST['food_id'];
    $quantity = $_POST['quantity'];
    addToCart($food_id, $quantity);
}

// Update quantity of food in cart (e.g., from form submission)
if (isset($_POST['update_cart'])) {
    $food_id = $_POST['food_id'];
    $quantity = $_POST['quantity'];
    updateCart($food_id, $quantity);
}

// Remove food from cart (e.g., from form submission)
if (isset($_POST['remove_from_cart'])) {
    $food_id = $_POST['food_id'];
    removeFromCart($food_id);
}

// Display cart contents
displayCart();
?>