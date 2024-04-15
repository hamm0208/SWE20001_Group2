<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="keywords" content="FoodEge, catering, food, beverage">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Beckham Then">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Order History</title>
</head>

<body style='background-color:#d8c3a5;'>
<?php
    include "header.php";
    include "connection.php";
    $email = "thenbeckham@gmail.com"
    /*
    if(isset($_SESSION["email"]) && isset($_SESSION["type"])) {
        if($_SESSION["type"] != "customer"){

        }
    }
    */
    ?>

    <div class="container-fluid  w-75  mt-3">
        <h1 class='fira-sans mb-0 order-h1 display-4'>My Orders</h1>
        <div class='order-table-wrapper p-3 mt-3'>
        <table class="table text-center">
            <thead class="thead-dark thead">
                <tr>
                    <th style='width: 22%;'>Order ID</th>
                    <th style='width: 22%;'>Order Date & Time</th>
                    <th style='width: 22%;'>Total</th>
                    <th style='width: 22%;'>Status</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM orders WHERE user_email = '$email'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        $status = $row['status'];
                        $bg_color = '';
                        $text_color = '';

                        switch ($status) {
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

                        echo "<tr>";
                        echo "<td class='p-3'>" . $row['id'] . "</td>";
                        echo "<td class='p-3'>" . $row['order_date'] . "</td>";
                        echo "<td class='p-3'> RM" . $row['total'] . "</td>";
                        echo "<td class='p-3'> <span class='status-span p-2 $bg_color $text_color'>" . $status . "</span></td>";
                        echo "<td class='p-3'><a href='order_details.php?orderID=".$row['id']."'>More Details</a></td>"; // Link to more details page
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No orders found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    </div>
    <?php
    include "footer.php"
    ?>
</body>
</html>