<?php
// Include necessary files for database connection
include("database.php");
include("connection.php");
include("fetchorderdetails.php");
//$order = fetchOrderDetails();
// Check if order_id is set in $_GET
// if(isset($_GET['order_id'])) {
//     // Assuming you have some logic to fetch the order ID here, let's call it $orderId
//     $orderId = $_GET['order_id']; // Example: Fetching order ID from URL parameter

//     // Fetch order details based on order ID
//     $orderDetails = fetchOrderDetails($orderId);

//     // Check if $orderDetails is not empty
//     if (!empty($orderDetails)) {
//         // Assign $order array with the fetched order details
//         $order = $orderDetails;
//     } else {
//         // If no order details found, initialize $order as an empty array
//         $order = array();
//     }
// } else {
//     // If order_id is not set in $_GET, handle accordingly
//     echo "Order ID is not set.";
//     // You might want to redirect the user or display an error message
// }
// ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Order Status</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Your custom CSS -->
    <link href="your_custom.css" rel="stylesheet">
</head>
<body>
    <script>
        function on(value, id) {
        // Send AJAX request to update status
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Handle response here
                console.log(this.responseText);
            }
        };
        xhttp.open("GET", "updateorder.php?value=" + value + "&id=" + id, true);
        xhttp.send();
    }
    //     
    </script>
    <!-- Header -->
    <?php include("header.php"); ?>

    <div class="container mt-5">
        <h1>Update Order Status</h1>
        <!-- Form for editing order details -->
  <?php      
  $sql = "SELECT id,user_email, contact_number, status
  FROM orders
  WHERE status IN ('Cancelled', 'In Progress', 'Complete')";

$order2 = mysqli_query($conn, $sql);
if (mysqli_num_rows($order2) > 0) {
    // Output data of each row
    while ($order = mysqli_fetch_assoc($order2)) {
        $sql = "SELECT first_name FROM users WHERE email='" . $order['user_email'] . "'";
    // Execute the SQL query
    $name1=mysqli_query($conn, $sql);
    $name = mysqli_fetch_assoc($name1);
        ?>
        <form>
            <div class="form-row align-items-center mb-3">
                <div class="col-auto">
                    <label for="name" class="mr-2">Name:</label>
                    <!-- Check if $order array is not empty before accessing its properties -->
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $name['first_name']; ?>" readonly>
                </div>
                <div class="col-auto">
                    <label for="email" class="mr-2">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo  $order['user_email']; ?>" readonly>
                </div>
                <div class="col-auto">
                    <?php $id = $order['id'];?>
                    <select class="form-control" id="status" name="status" onchange="on(this.value,<?php echo $id;?>);">
                        <option value="Cancelled" <?php if($order['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
                        <option value="Complete" <?php if($order['status'] == 'Complete') echo 'selected'; ?>>Completed</option>
                        <option value="In Progress" <?php if($order['status'] == 'In Progress') echo 'selected'; ?>>In Progress</option>
                    </select>
                </div>

                
            </div>

            

            <button type="submit" class="btn btn-primary" id="updateButton" style="display: none;">Update Order</button>
        </form>
    
    <?php
    }
} else {
    echo "<tr><td colspan='3'>No orders found.</td></tr>";
}?>
</div>
    <!-- Footer -->
    <?php include("footer.php"); ?>
    <script>
        // function on(){
        //     print("dede");
        // }
    function updateOrderStatus(newStatus) {
        var orderId = <?php echo $order['order_id']; ?>;
        // Send an AJAX request to update the order status
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // If the request is successful, you can handle the response here
                console.log(this.responseText); // Log the response for debugging
            }
        };
        xhttp.open("GET", "update_order_status.php?order_id=" + orderId + "&status=" + newStatus, true);
        xhttp.send();
    }
</script>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Show/hide status options and update button on edit button click
        document.getElementById("editButton").addEventListener("click", function() {
            document.getElementById("statusOptions").style.display = "block";
            document.getElementById("updateButton").style.display = "block";
        });
    </script>
    </body>
</html>
