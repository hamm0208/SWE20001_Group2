<?php
include 'header.php';

include "database.php";
if(!isset($_SESSION["cart_ids"]) || empty($_SESSION["cart_ids"])){
    echo "<script>alert('Your cart is empty, cannot proceed order.');</script>";
    echo '<script>window.location.href = "cart.php";</script>';
    exit();
}
if (!isset($_SESSION['email'])) {
    $_SESSION["email"] = "";
}
if (!isset($_SESSION['type'])) {
    $_SESSION["type"] = "";
}
if (!isset($_SESSION['cart_ids'])) {
    $_SESSION["cart_ids"] = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Catering Event Form</title>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="CSS/style.css">

<style>
    /* Additional inline styles */
    body {
        margin: 0;
        padding: 0; 
        height: 100vh; 
        box-sizing: border-box;
    }
</style>
</head>
<body style="background: url('Images/web_resources/background.jpg') no-repeat center center fixed; background-size: cover;">


    <div class="catering-form-wrapper">
        <form id="cateringEventForm" action="add_order.php" method="post">
            <h2>Catering Event Scheduling Form</h2>

            <br>

            <div class="payment-options">
                <label>Payment Method:</label>
                <div class="payment-option">
                    <input type="radio" id="bankTransfer" name="paymentMethod" value="Bank Transfer" onclick="togglePaymentMethod('bank')">
                    <label for="bankTransfer">Bank Transfer</label>
                    <div id="bankDetails" class="payment-details" style="display:none;">
                        <img src="Images/web_resources/bankdetails.jpg" alt="Bank Details" class="payment-image">
                    </div>
                </div>
                <div class="payment-option">
                    <input type="radio" id="duitNowQR" name="paymentMethod" value="DuitNow QR" onclick="togglePaymentMethod('qr')">
                    <label for="duitNowQR">DuitNow QR</label>
                    <div id="duitNowQRDetails" class="payment-details" style="display:none;">
                        <img src="Images/web_resources/duitnowqr.jpg" alt="DuitNow QR Code" class="payment-image">
                    </div>
                </div>
            </div>

            <br>

            <div class="form-group">
                <label for="receiverName">Receiver Name:</label>
                <input type="text" id="receiverName" name="receiverName" required>
            </div>

            <br>

            <div class="form-group">
                <label for="contactNumber">Receiver Contact Number:</label>
                <input type="tel" id="contactNumber" name="contactNumber" pattern="[0-9]{10,11}" title="Contact number must be 10 to 11 digits long." required>
            </div>

            <br>

            <div class="form-group">
                <label for="email">Receiver Email:</label>
                <input type="email" id="email" name="email" pattern="[^@]+@[^@]+\.(com)" title="Email must include '@' and end with '.com'" required>
            </div>

            <br>

            <div class="form-group">
                <label for="eventDate">Event Date:</label>
                <input type="date" id="eventDate" name="eventDate" min="<?= date('Y-m-d', strtotime('+1 day')); ?>" required>
            </div>

            <br>

            <div class="delivery-options">
                <label>Delivery/Pick Up:</label>
                <input type="radio" id="delivery" name="deliveryOption" value="Delivery" onclick="toggleDelivery(true)">
                <label for="delivery">Delivery</label>
                <input type="radio" id="pickUp" name="deliveryOption" value="Pick Up" onclick="toggleDelivery(false)">
                <label for="pickUp">Pick Up</label>
            </div>

            <div id="deliveryDetails" style="display:none;">
                <div class="form-group">
                    <label for="deliveryAddress">Delivery Address:</label>
                    <input type="text" id="deliveryAddress" name="deliveryAddress">
                </div>
                <div class="form-group">
                    <label for="deliveryTime">Delivery Time:</label>
                    <input type="time" id="deliveryTime" name="deliveryTime" step="900">
                </div>
            </div>

            <div id="pickUpDetails" style="display:none;">
                <div class="form-group">
                    <label for="pickUpTime">Pick Up Time:</label>
                    <input type="time" id="pickUpTime" name="pickUpTime" step="900">
                </div>
            </div>

            <br>

            <div class="form-group">
                <label for="specialRemark">Special Remark:</label>
                <textarea id="specialRemark" name="specialRemark"></textarea>
            </div>

            <br>

            <button type="submit" class="form-button">Checkout</button>
        </form>
    </div>

<script>
function toggleDelivery(isDelivery) {
    document.getElementById('deliveryDetails').style.display = isDelivery ? 'block' : 'none';
    document.getElementById('pickUpDetails').style.display = isDelivery ? 'none' : 'block';
}

function togglePaymentMethod(paymentType) {
    document.getElementById('bankDetails').style.display = paymentType === 'bank' ? 'block' : 'none';
    document.getElementById('duitNowQRDetails').style.display = paymentType === 'qr' ? 'block' : 'none';
}
</script>

<?php include 'footer.php'; ?>
</body>
</html>