
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodEdge-Manage Inventory</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/bootstrap.css">    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    
    <style>
        .first-row-margin {
            margin-left: 0.5%; 
        }
        .link_logo{
            width: 75px;
        }
    </style>
</head>
<body id="background">
    <?php
    include("font.php");
    include('connection.php');
    session_start();
    try{
    if(isset($_SESSION["email"]) && isset($_SESSION["type"])) {
            if($_SESSION["type"] == "management"){
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
    $id_sort_asc = true;
    if(isset($_GET['ID_sort'])){
        if($_GET['ID_sort'] == 0){
            $id_sort_asc = false;
        }else{
            $id_sort_asc = true;
        }
    }
    $total_sort_asc = null;
    if(isset($_GET['total_sort'])){
        if($_GET['total_sort'] == 0){
            $total_sort_asc = false;
        }else if($_GET['total_sort'] == 1){
            $total_sort_asc = true;
        }
    }
    ?>
    <div class="container-fluid">
        <div class="row first-row-margin">
            <div class="col-2 mt-3 my-3  text-center nav_management">
                <a href='management_manageInventory.php'>
                    <img src="Images/web_resources/foodEdge_logo.png" alt="FoodEdge logo" class="logo img-fluid w-75">
                </a>
                <br>
                <div class="nav mt-5 d-flex justify-content-center">
                    <ul class="list-inline ">
                        <li class="list-inline-item">
                            <a href="management_manageInventory.php" class='linkToManagementAddItem'>
                                <img src="Images/web_resources/inventory_logo.png" alt="Inventory Logo" class=' link_logo'>
                                <p class="playfair-display h4">Inventory</p>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="nav mt-5 d-flex justify-content-center">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="management_orders.php" class='linkToManagementAddItem'>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" height="60" viewBox="0 -960 960 960" width="60"><path d="M280-80q-33 0-56.5-23.5T200-160q0-33 23.5-56.5T280-240q33 0 56.5 23.5T360-160q0 33-23.5 56.5T280-80Zm400 0q-33 0-56.5-23.5T600-160q0-33 23.5-56.5T680-240q33 0 56.5 23.5T760-160q0 33-23.5 56.5T680-80ZM246-720l96 200h280l110-200H246Zm-38-80h590q23 0 35 20.5t1 41.5L692-482q-11 20-29.5 31T622-440H324l-44 80h480v80H280q-45 0-68-39.5t-2-78.5l54-98-144-304H40v-80h130l38 80Zm134 280h280-280Z"/></svg>    
                                <p class="playfair-display h4">Orders</p>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="nav mt-5 d-flex justify-content-center">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="" class='linkToManagementAddItem'>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" height="60" viewBox="0 -960 960 960" width="60"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z"/></svg>
                                <p class="playfair-display h4">Users</p>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="nav mt-5 d-flex justify-content-center">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="log_out.php" class='linkToManagementAddItem'>
                                <img src="Images/web_resources/sigout_img.png" alt="Log out Logo" class='link_logo'>
                                <p class="playfair-display h4">Log Out</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-10 ">
                <div class="row">
                    <div class="col-10 pt-5">
                        <h1 class="pt-5 fira-sans-black">Order History</h1>
                    </div>
                </div>
                <div class="container-fluid inventory_container">
                    <div class="table-responsive ">
                    <table class="table table-striped table-hover  mt-3">
                        <thead class="thead-dark">
                            <tr>
                                <th class='py-3 fira-sans-black align-middle text-center dark-header'>
                                    <a class='text-dark' href="management_orders.php?ID_sort=<?php echo $id_sort_asc ? '0' : '1'; ?>">Order ID</a>
                                    <?php  echo $id_sort_asc ? '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m280-400 200-200 200 200H280Z"/></svg>' : '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-360 280-560h400L480-360Z"/></svg>' ?>
                                </th>
                                <th class='py-3 fira-sans-black align-middle dark-header'>
                                    Email
                                </th>
                                <th class='py-3 fira-sans-black align-middle dark-header'>
                                    Order Date & Time
                                </th>
                                <th class='py-3 fira-sans-black align-middle dark-header'>
                                    <a class='text-dark' href="management_orders.php?total_sort=<?php echo $total_sort_asc ? '0' : '1'; ?>">Total</a>
                                    
                                    <?php 
                                    if($total_sort_asc === true){
                                        echo '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m280-400 200-200 200 200H280Z"/></svg>'; 
                                    }else if($total_sort_asc === false){
                                        echo '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-360 280-560h400L480-360Z"/></svg>' ;
                                    }
                                    ?>

                                </th>
                                <th class='py-3 fira-sans-black align-middle dark-header'>
                                    Status
                                </th>
                                <th class='py-3 fira-sans-black align-middle dark-header'>
                                    Order Details
                                </th>
                            </tr>
                        </thead>
                        <?php
                        if($id_sort_asc){
                            $sql = "SELECT * FROM orders";
                        }else{
                            $sql = "SELECT * FROM orders ORDER BY id DESC";
                        }
                        if($total_sort_asc != null){
                            if($total_sort_asc){
                                $sql = "SELECT * FROM orders ORDER BY total DESC";
                            }else{
                                $sql = "SELECT * FROM orders ORDER BY total DESC";
                            }
                        }
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                                $orderStatus = $row['status'];
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
                                $orderID = $row['id'];
                                $orderEmail = $row['user_email'];
                                $orderDate = $row['order_date'];
                                $orderStatus = $row['status'];
                                $orderTotal = $row['total'];
                                echo "<tr>";
                                echo "<td class='p-3 text-center align-middle'>", $orderID, "</td>";
                                echo "<td class='p-3 align-middle'>", $orderEmail, "</td>";
                                echo "<td class='p-3 align-middle'>", $orderDate, "</td>";
                                echo "<td class='p-3 align-middle'> RM", $orderTotal, "</td>";
                                echo "<td class='p-3 align-middle'> <span class='status-span p-2 $bg_color $text_color'>" . $orderStatus . "</span></td>";
                                echo "<td class= 'p-3 align-middle'><a href='management_orderDetails.php?orderID=" . $orderID . "'>More Details</a></td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
                
            </div>
        </div>
    </div>
</body>
</html>
