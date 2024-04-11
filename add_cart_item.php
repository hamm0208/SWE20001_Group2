<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $item_name = $_POST['item_name'];
    $item_price = $_POST['item_price'];
    array_push($_SESSION['cart'], array('name' => $item_name, 'price' => $item_price));
}
?>
