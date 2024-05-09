
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodEdge-Management Order History</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/bootstrap.css">    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    
    <style>
        .first-row-margin {
            margin-left: 0.5%; 
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

    if(isset($_GET['email'])){
        $email = $_GET['email'];
    }
    if(isset($_GET['date'])){
        $date = $_GET['date'];
    }
    if(isset($_GET['status'])){
        $status = $_GET['status'];
    }
    ?>
    <div class="container-fluid">
        <div class="row first-row-margin">
        <?php include("management_navbar.php")?>
            <div class="col-10 ">
                <div class="row">
                    <div class="col-10 pt-5">
                        <h1 class="pt-5 fira-sans-black">Order History</h1>
                    </div>
                </div>
                <div class="container-fluid order_container">
                    <form action="management_orders.php" method="GET">
                        <div class="row">
                            <div class="col">
                                <label for="email" class='fira-sans-black'>Email:</label>
                                <input type="text" name='email' placeholder="Search for email" class="w-75" value='<?php echo isset($_GET['email'])? $email: ""?>'>
                            </div>
                            <div class="col">
                                <label for="date" class='fira-sans-black'>Order Date:</label>
                                <input type="date" name='date'  class="w-50" value='<?php echo isset($_GET['date'])? $date: ""?>'>
                            </div>
                            <div class="col">
                                <label for="status" class='fira-sans-black'>Status:</label>
                                <select id="status" name="status" class="w-75">
                                    <option value="All" <?php echo ($_GET['status'] ?? '') === 'All' ? 'selected' : ''; ?>>All</option>
                                    <option value="Cancelled" <?php echo ($_GET['status'] ?? '') === 'Cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                                    <option value="In Progress" <?php echo ($_GET['status'] ?? '') === 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
                                    <option value="Complete" <?php echo ($_GET['status'] ?? '') === 'Complete' ? 'selected' : ''; ?>>Complete</option>
                                </select>
                            </div>
                            <div class="col">
                            <button types='submit' class='w-25 management_btn'>Search</button>
                            <button type='reset' class='w-25 management_btn' onclick="window.location.href = 'management_orders.php'">Reset</button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive ">
                        <table class="table table-striped table-hover  mt-3">
                            <thead class="thead-dark">
                                <tr>
                                    <th class='py-3 fira-sans-black align-middle text-center dark-header bg-dark text-light'>
                                        
                                        <?php 
                                            $getVariable = "";

                                            if(isset($_GET['email'])){
                                                if($_GET['email'] != ""){
                                                    $getVariable .= "email=" . $_GET['email'] . "&";
                                                }
                                            }
                                            
                                            if(isset($_GET['date'])){
                                                if($_GET['date'] != ""){
                                                    $getVariable .= "date=" . $_GET['date'] . "&";
                                                }
                                            }
                                            
                                            if(isset($_GET['status'])){
                                                if($_GET['status'] != ""){
                                                    $getVariable .= "status=" . $_GET['status'] . "&";
                                                }
                                            }
                                           $getVariable = rtrim($getVariable, "&");
                                            echo "<a class='text-light' href=\"management_orders.php?" . $getVariable . "&ID_sort=" . ($id_sort_asc ? '0' : '1') . "\">Order ID</a>";
                                            echo $id_sort_asc ? '<svg xmlns="http://www.w3.org/2000/svg" fill="#ffffff" height="24" viewBox="0 -960 960 960" width="24"><path d="m280-400 200-200 200 200H280Z"/></svg>' : '<svg  fill="#ffffff" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-360 280-560h400L480-360Z"/></svg>'
                                        ?>
                                    </th>
                                    <th class='py-3 fira-sans-black align-middle dark-header bg-dark text-light'>
                                        Email
                                    </th>
                                    <th class='py-3 fira-sans-black align-middle dark-header bg-dark text-light'>
                                        Order Date & Time
                                    </th>
                                    <th class='py-3 fira-sans-black align-middle dark-header bg-dark text-light'>
                                        <?php
                                           $getVariable = "";

                                           if(isset($_GET['email'])){
                                                if($_GET['email'] != ""){
                                                    $getVariable .= "email=" . $_GET['email'] . "&";
                                                }
                                           }
                                           
                                           if(isset($_GET['date'])){
                                                if($_GET['date'] != ""){
                                                    $getVariable .= "date=" . $_GET['date'] . "&";
                                                }
                                           }
                                           
                                           if(isset($_GET['status'])){
                                                if($_GET['status'] != ""){
                                                    $getVariable .= "status=" . $_GET['status'] . "&";
                                                }
                                           }
                                           $getVariable = rtrim($getVariable, "&");
                                           
                                           echo "<a class='text-light' href=\"management_orders.php?" . $getVariable . "&total_sort=" . ($total_sort_asc ? '0' : '1') . "\">Total</a>";
                                            if($total_sort_asc === true){
                                                echo '<svg xmlns="http://www.w3.org/2000/svg" height="24" fill="#ffffff" viewBox="0 -960 960 960" width="24"><path d="m280-400 200-200 200 200H280Z"/></svg>'; 
                                            }else if($total_sort_asc === false){
                                                echo '<svg xmlns="http://www.w3.org/2000/svg" height="24"  fill="#ffffff" viewBox="0 -960 960 960" width="24"><path d="M480-360 280-560h400L480-360Z"/></svg>' ;
                                            }
                                        ?>

                                    </th>
                                    <th class='py-3 fira-sans-black align-middle dark-header bg-dark text-light'>
                                        Status
                                    </th>
                                    <th class='py-3 fira-sans-black align-middle dark-header bg-dark text-light'>
                                        Order Details
                                    </th>
                                </tr>
                            </thead>
                            <?php
                            $sql ="SELECT * FROM orders";

                            if(isset($_GET["email"])){  
                                $email = $_GET['email'];
                                if(!empty($email)){
                                    $sql .= " WHERE user_email LIKE '%$email%'";                                
                                }
                            }
                            if(isset($_GET['date'])){
                                $date = $_GET['date'];
                                if($date != ""){
                                    $sql .= ($_GET['email']) != "" || $_GET['status'] == "" ? " AND DATE(order_date) = '$date'" : " WHERE DATE(order_date) = '$date'";
                                }
                            }
                            
                            if(isset($_GET['status'])){
                                $status = $_GET['status'];
                                if($status !== 'All') {
                                    $sql .= ($_GET['email']) != "" || $_GET['status'] == "" ? " AND status = '$status'" : " WHERE status = '$status'";
                                }
                            }
                            if ($total_sort_asc !== null) {
                                $sql .= " ORDER BY total " . ($total_sort_asc ? "ASC" : "DESC");
                            }else{
                                if ($id_sort_asc) {
                                    $sql .= " ORDER BY id ASC";
                                } else {
                                    $sql .= " ORDER BY id DESC";
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
