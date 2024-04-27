
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
