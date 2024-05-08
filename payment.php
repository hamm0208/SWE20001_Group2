<?php
session_start();
include "database.php";
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
</head>
<body>
<?php include 'header.php'; ?>

<div class="catering-form-wrapper">
    <form id="cateringEventForm">
        <h2>Catering Event Scheduling Form</h2>
        
        <div class="form-group">
            <label for="receiverName">Receiver Name:</label>
            <input type="text" id="receiverName" name="receiverName" required>
        </div>

        <div class="form-group">
            <label for="contactNumber">Receiver Contact Number:</label>
            <input type="tel" id="contactNumber" name="contactNumber" pattern="[0-9]{10,11}" title="Contact number must be 10 to 11 digits long." required>
        </div>

        <div class="form-group">
            <label for="email">Receiver Email:</label>
            <input type="email" id="email" name="email" pattern="[^@]+@[^@]+\.(com)" title="Email must include '@' and end with '.com'" required>
        </div>

        <div class="form-group">
            <label for="eventDate">Event Date:</label>
            <input type="date" id="eventDate" name="eventDate" max="<?= date('Y-m-d'); ?>" required>
        </div>

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

        <div class="form-group">
            <label for="specialRemark">Special Remark:</label>
            <textarea id="specialRemark" name="specialRemark"></textarea>
        </div>

        <button type="submit" class="form-button">Submit</button>
    </form>
</div>

<script>
function toggleDelivery(isDelivery) {
    document.getElementById('deliveryDetails').style.display = isDelivery ? 'block' : 'none';
    document.getElementById('pickUpDetails').style.display = isDelivery ? 'none' : 'block';
}
</script>

<?php include 'footer.php'; ?>
</body>
</html>