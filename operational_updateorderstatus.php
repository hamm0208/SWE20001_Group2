<?php
// Include necessary files for database connection
include("database.php");
include("connection.php");
include("font.php");
    session_start();
    try{
    if(isset($_SESSION["email"]) && isset($_SESSION["type"])) {
            if($_SESSION["type"] == "operation"){
                $email = $_SESSION['email'];
                $user = $_SESSION['type'];
            }else{
                echo '<script>alert("Unauthorised Access!");</script>';
                echo '<script>window.location.href = "log_in.php";</script>';
                exit();
            }
        }else{
            echo '<script>alert("Unauthorised Access!");</script>';
                echo '<script>window.location.href = "log_in.php";</script>';
                exit();
        }
    }catch(Exception $e){};
    
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodEdge-Management Order History</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<script>
    function on(value, id) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                location.reload(); // Reload the page after the request is completed
            }
        };
        xhttp.open("GET", "updateorder.php?value=" + value + "&id=" + id, true);
        xhttp.send();
    }
</script>
<style>
        .first-row-margin {
            margin-left: 0.5%; 
        }
    </style>
<body  id="background">
<div class="container-fluid">
    <div class="row first-row-margin">
        <?php include("operational_navbar.php")?>
        <div class="col-10">
            <div class="row">
                <div class="col-10 pt-5">
                    <h1 class="pt-5 fira-sans-black">Update Order Status</h1>
                </div>
            </div>
            <div class="container-fluid order_container">
                <table class="table table-striped table-hover  mt-3">
                    <thead class="thead-dark">
                        <tr>
                            
                            <th class='py-3 fira-sans-black align-middle dark-header bg-dark text-light'>
                                Order ID
                            </th>
                            <th class='py-3 fira-sans-black align-middle dark-header bg-dark text-light'>
                                Email
                            </th>
                            <th class='py-3 fira-sans-black align-middle dark-header bg-dark text-light'>
                                Order Date & Time
                            </th>
                            
                            <th class='py-3 fira-sans-black align-middle dark-header bg-dark text-light'>
                                Total
                            </th>
                            <th class='py-3 fira-sans-black align-middle dark-header bg-dark text-light'>
                                Status
                            </th>
                            <th class='py-3 fira-sans-black align-middle dark-header bg-dark text-light'>
                                Update Order Details
                            </th>
                        </tr>
                    </thead>
                    <?php      
                    $sql = "SELECT * FROM orders";

                    $order2 = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($order2) > 0) {
                        // Output data of each row
                        while ($order = mysqli_fetch_assoc($order2)) {
                            $sql = "SELECT first_name FROM users WHERE email='" . $order['user_email'] . "'";
                            // Execute the SQL query
                            $name1=mysqli_query($conn, $sql);
                            $name = mysqli_fetch_assoc($name1);
                            $orderStatus = $order['status'];
                            $bg_color = '';
                            $text_color = '';
                            
                        switch ($orderStatus) {
                            case 'In Progress':
                                $bg_color = 'bg-warning';
                                $text_color = 'text-dark';
                                break;
                                case 'Cancelled':
                                    $bg_color = 'bg-danger';
                                    $text_color = 'text-white';
                                    break;
                                    case 'Complete':
                                        $bg_color = 'bg-success';
                                        $text_color = 'text-white';
                                        break;
                                        default:
                                        $bg_color = '';
                                        $text_color = '';
                                    }
                                    $orderID = $order['id'];
                                    $orderEmail = $order['user_email'];
                        $orderDate = $order['order_date'];
                        $orderTotal = $order['total'];
                        echo "<tr>";
                        echo "<td class='p-3 text-center align-middle'>", $orderID, "</td>";
                        echo "<td class='p-3 align-middle'>", $orderEmail, "</td>";
                        echo "<td class='p-3 align-middle'>", $orderDate, "</td>";
                        echo "<td class='p-3 align-middle'> RM", $orderTotal, "</td>";
                        echo "<td class='p-3 align-middle'> <span class='status-span p-2 $bg_color $text_color'>" . $orderStatus . "</span></td>";
                        echo "<td class='p-3 align-middle'>";
                        
                        // Open form tag here
                        echo "<form id='form_$orderID'>"; // Append order ID to make it unique
                        
                        echo "<select class='form-control' name='status' onchange='on(this.value, $orderID);'>";
                        echo "<option value='In Progress' ", ($orderStatus == 'In Progress') ? 'selected' : '', ">In Progress</option>";
                        echo "<option value='Complete' ", ($orderStatus == 'Complete') ? 'selected' : '', ">Completed</option>";
                        echo "<option value='Cancelled' ", ($orderStatus == 'Cancelled') ? 'selected' : '', ">Cancelled</option>";
                        echo "</select>";
                        echo "<button type='submit' class='btn btn-primary' id='updateButton' style='display: none;'>Update Order</button>";
                        // Close form tag here
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No orders found.</td></tr>";
                }?>
                </table>
            </div>
        </div>
    </div>
</div>
    <script>
    function updateOrderStatus(newStatus) {
        var orderId = <?php echo $order['order_id']; ?>;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText); // Log the response for debugging
            }
        };
        xhttp.open("GET", "update_order_status.php?order_id=" + orderId + "&status=" + newStatus, true);
        xhttp.send();
    }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.getElementById("editButton").addEventListener("click", function() {
            document.getElementById("statusOptions").style.display = "block";
            document.getElementById("updateButton").style.display = "block";
        });
    </script>
    </body>
</html>
