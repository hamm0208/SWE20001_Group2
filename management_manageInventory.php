
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
    /*
    session_start();
    try{
    if(isset($_SESSION["email"]) && isset($_SESSION["user"])) {
            if($_SESSION["user"] == "user"){
                echo '<script>alert("Unauthorised Access!");</script>';
                echo '<script>window.location.href = "login.php";</script>';
                exit();
            }else{
                $email = $_SESSION['email'];
                $user = $_SESSION['user'];
            }
        }else{
            echo '<script>alert("Unauthorised Access!");</script>';
                echo '<script>window.location.href = "login.php";</script>';
                exit();
        }
    }catch(Exception $e){};
    */
    include("font.php");
    include('connection.php');
    if(isset($_GET['email'])) {
        $email = $_GET['email'];
        if(empty($email)) {
            //Implement this when LogIn is done;
            $email = "thenbeckham@gmail.com";
        }else{
            
        }
    }else{
        $email = "thenbeckham@gmail.com";
        //Implement this when LogIn is done;
    }
    $find_email = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $find_email);

    if(mysqli_num_rows($result) == 1){
        $profile_data = array();
        $row = mysqli_fetch_assoc($result);
        $profile_data['fname'] = $row['first_name'];
        $profile_data['lname'] = $row['last_name'];
        $profile_data['dob'] = $row['dob'];
        $profile_data['gender'] = $row['gender'];
        $profile_data['contact_number'] = $row['contact_number'];
        $profile_data['profile_image'] = $row['profile_image'];
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
                            <a href="index.php" class='linkToManagementAddItem'>
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
                        <h1 class="pt-5 fira-sans-black">Manage Inventory</h1>
                    </div>
                </div>
                <div class="container-fluid inventory_container">
                    <button class='playfair-display'  onclick="location.href='management_addItem.php';">Add new item</button>
                    <div class="table-responsive ">
                    <table class="table table-striped table-hover  mt-3">
                        <thead class="thead-dark">
                            <tr>
                                <th class='py-3 fira-sans-black align-middle text-center dark-header'>
                                    Item ID
                                </th>
                                <th class='py-3 fira-sans-black align-middle dark-header'>
                                    Name
                                </th>
                                <th class='py-3 fira-sans-black align-middle dark-header'>
                                    Type
                                </th>
                                <th class='py-3 fira-sans-black align-middle dark-header'>
                                    Category
                                </th>
                                <th class='py-3 fira-sans-black align-middle dark-header'>
                                    Inventory
                                </th>
                                <th class='py-3 fira-sans-black align-middle dark-header'>
                                    Edit
                                </th>
                                <th class='py-3 fira-sans-black align-middle dark-header'>
                                    Delete
                                </th>
                            </tr>
                        </thead>
                        <?php
                        $sql = "SELECT * FROM inventory";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                                $itemID = $row['id'];
                                $itemName = $row['name'];
                                $itemType = $row['type'];
                                $itemCategory = $row['category'];
                                $itemInventory = $row['inventory'];
                                echo "<tr>";
                                echo "<td class='playfair-display text-center align-middle'>", $itemID, "</td>";
                                echo "<td class='playfair-display align-middle'>", $itemName, "</td>";
                                echo "<td class='playfair-display align-middle'>", $itemType, "</td>";
                                echo "<td class='playfair-display align-middle'>", $itemCategory, "</td>";
                                echo "<td class='playfair-display align-middle'>", $itemInventory, "</td>";
                                echo "<td> <a href='management_editItem.php?item_id=" . $itemID . "'><img src='Images/web_resources/edit.png' alt='edit' class='event-logo'></a></td>";
                                echo "<td> <a href='management_deleteItem.php?item_id=" . $itemID . "'><img src='Images/web_resources/trash.png' alt='edit' class='event-logo'></a></td>";
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
