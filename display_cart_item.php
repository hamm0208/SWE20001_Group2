<?php
session_start();

$total_price = 0;
?>
<div class="cart">
    <?php if (count($_SESSION['cart']) > 0): ?>
        <?php foreach ($_SESSION['cart'] as $index => $item): ?>
            <div class="cart-item">
                <h3><?php echo $item['name']; ?></h3>
                <p>Price: $<?php echo $item['price']; ?></p>
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" value="<?php echo isset($item['quantity']) ? $item['quantity'] : 1; ?>" min="1">
                <button onclick="editCartItem(<?php echo $index; ?>)">Update</button>
                <button onclick="removeCartItem(<?php echo $index; ?>)">Remove</button>
            </div>
            <?php $total_price += $item['price']; ?>
        <?php endforeach; ?>
        <p>Total Price: $<?php echo $total_price; ?></p>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</div>
