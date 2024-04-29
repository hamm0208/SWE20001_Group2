<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodEdge-Users</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/bootstrap.css">    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    
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

    if(isset($_GET['orderID'])){
        $order_ID = $_GET["orderID"];
        $sql_check_id = "SELECT COUNT(*) AS count FROM orders WHERE id = '$order_ID'";
        $result_check_id = mysqli_query($conn, $sql_check_id);
        $row_check_id = mysqli_fetch_assoc($result_check_id);
        if($row_check_id['count'] == 0) {
            echo '<script>alert("Invalid ID");</script>';
            echo '<script>window.location.href = "management_orders.php";</script>';
            exit();
        }
    }
    if(isset($_GET['email'])){
        $email = $_GET['email'];
    }
    if(isset($_GET['name'])){
        $name = $_GET['name'];
    }
    if(isset($_GET['type'])){
        $type = $_GET['type'];
    }
    
    ?>
    <div class="container-fluid">
        <div class="row first-row-margin">
            <?php include("management_navbar.php")?>

            <div class="col-10 ">
                <div class="row">
                    <div class="col-10 pt-5 mx-3">
                        <h1 class="pt-5 fira-sans-black">Users</h1>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button class='playfair-display management_btn mt-4'  onclick="location.href='management_addStaff.php';">Add new staff</button>
                        </div>
                    </div>
                </div>
                <div class="container-fluid order_container">
                    <form action="management_users.php" method="get">
                        <div class="row">
                            <div class="col">
                                <label for="email" class='fira-sans-black'>Email:</label>
                                <input type="text" name='email' placeholder="Search for email" class="w-75" value='<?php echo isset($_GET['email'])? $email: ""?>'>
                            </div>
                            <div class="col">
                                <label for="name" class='fira-sans-black'>Name:</label>
                                <input type="text" name='name' placeholder="Search for name" class="w-75" value='<?php echo isset($_GET['name'])? $name: ""?>'>
                            </div>
                            <div class="col">
                                <label for="type" class='fira-sans-black'>User Type:</label>
                                <select id="type" name="type" class="w-50">
                                    <option value="All" <?php echo ($_GET['type'] ?? '') === 'All' ? 'selected' : ''; ?>>All</option>
                                    <option value="customer" <?php echo ($_GET['type'] ?? '') === 'customer' ? 'selected' : ''; ?>>Customer</option>
                                    <option value="management" <?php echo ($_GET['type'] ?? '') === 'management' ? 'selected' : ''; ?>>Management</option>
                                    <option value="operation" <?php echo ($_GET['type'] ?? '') === 'operation' ? 'selected' : ''; ?>>Operation</option>
                                </select>
                            </div>
                            <div class="col">
                                <button types='submit' class='management_btn w-25'>Search</button>
                                <button type='reset' class='management_btn w-25' onclick="window.location.href = 'management_users.php'">Reset</button>
                            </div>
                        </div>
                    </form>
                    
                    <div class="table-responsive">
                        <table class='table table-striped table-hover mt-3'>
                            <thead>
                                <tr>
                                    <th class='py-3 fira-sans-black text-center align-middle bg-dark text-light'>Email</th>
                                    <th class='py-3 fira-sans-black  align-middle bg-dark text-light'>Name</th>
                                    <th class='py-3 fira-sans-black  align-middle bg-dark text-light'>User Type</th>
                                    <th class='py-3 fira-sans-black  align-middle bg-dark text-light'>Phone Number</th>
                                    <th class='py-3 fira-sans-black  align-middle bg-dark text-light'>Edit</th>
                                    <th class='py-3 fira-sans-black  align-middle bg-dark text-light'>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $sql = "SELECT * FROM users";
                                if(isset($_GET['email'])){
                                    $email = $_GET['email'];
                                    if(!empty($email)){
                                        $sql .= " WHERE email LIKE '%$email%'";                                
                                    }
                                }
                                if(isset($_GET['name'])){
                                    $name = $_GET['name'];
                                    if(!empty($name)){
                                        $sql .= isset($_GET['email']) && $_GET['email'] !== "" || isset($_GET['type']) && $_GET['type'] === "" 
                                        ? " AND CONCAT(first_name, ' ', last_name) LIKE '%$name%'" 
                                        : " WHERE CONCAT(first_name, ' ', last_name) LIKE '%$name%'";

                                    }
                                }
                                $result_users = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result_users) > 0) {
                                    while ($row_users = mysqli_fetch_array($result_users)) {
                                        $userEmail = $row_users['email'];
                                        $userFName = $row_users['first_name'];
                                        $userLName = $row_users['last_name'];
                                        $userNumber = $row_users['contact_number'];
                                        $sql_accounts = "SELECT * FROM accounts WHERE email = '$userEmail'";
                                        if(isset($_GET['type'])){
                                            $type = $_GET['type'];
                                            if($type !== 'All') {
                                                $sql_accounts = "SELECT * FROM accounts WHERE  email = '$userEmail' AND type = '$type'";
                                            }else{
                                                $sql_accounts = "SELECT * FROM accounts WHERE email = '$userEmail'";
                                            }
                                        }else{
                                            $sql_accounts = "SELECT * FROM accounts WHERE email = '$userEmail'"; 
                                        }
                                        $result_accounts = mysqli_query($conn, $sql_accounts);
                                        if (mysqli_num_rows($result_accounts) > 0) {
                                            while ($row_accounts = mysqli_fetch_array($result_accounts)) {
                                                if ($row_accounts['type'] == "customer") {
                                                    $userType = "Customer";
                                                } else if ($row_accounts['type'] == "management") {
                                                    $userType = "Management";
                                                } else if ($row_accounts['type'] == "operation") {
                                                    $userType = "Operation";
                                                }
                                                echo "<tr>";
                                                echo "<td class='p-3 text-center align-middle'>", $userEmail, "</td>";
                                                echo "<td class='p-3 align-middle'>", $userFName . " " . $userLName, "</td>";
                                                echo "<td class='p-3 align-middle'>", $userType, "</td>";
                                                echo "<td class='p-3 align-middle'>", $userNumber, "</td>";
                                                echo "<td> <a href='management_editUser.php?email=" . $userEmail . "'><img src='Images/web_resources/edit.png' alt='edit' class='event-logo'></a></td>";
                                                if($userType == "Customer"){
                                                    echo "<td></td>";
                                                }else{
                                                    echo "<td> <a href='management_deleteUser.php?email=" . $userEmail . "'><img src='Images/web_resources/trash.png' alt='edit' class='event-logo'></a></td>";
                                                }
                                                echo "</tr>";
                                                break;
                                            }
                                        }
                                        
                                    }
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
