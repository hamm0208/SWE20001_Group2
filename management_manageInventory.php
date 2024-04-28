
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
            <?php include("management_navbar.php")?>
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
                                <th class='py-3 fira-sans-black align-middle text-center dark-header bg-dark text-light'>
                                    Item ID
                                </th>
                                <th class='py-3 fira-sans-black align-middle dark-header bg-dark text-light'>
                                    Name
                                </th>
                                <th class='py-3 fira-sans-black align-middle dark-header bg-dark text-light'>
                                    Type
                                </th>
                                <th class='py-3 fira-sans-black align-middle dark-header bg-dark text-light'>
                                    Category
                                </th>
                                <th class='py-3 fira-sans-black align-middle dark-header bg-dark text-light'>
                                    Inventory
                                </th>
                                <th class='py-3 fira-sans-black align-middle dark-header bg-dark text-light'>
                                    Edit
                                </th>
                                <th class='py-3 fira-sans-black align-middle dark-header bg-dark text-light'>
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
