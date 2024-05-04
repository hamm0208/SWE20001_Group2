
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
    include "database.php";
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
    $id_sort_asc = true;
    if(isset($_GET['ID_sort'])){
        if($_GET['ID_sort'] == 0){
            $id_sort_asc = false;
        }else{
            $id_sort_asc = true;
        }
    }
    $inventory_sort_asc = null;
    if(isset($_GET['inventory_sort'])){
        if($_GET['inventory_sort'] == 0){
            $inventory_sort_asc = false;
        }else if($_GET['inventory_sort'] == 1){
            $inventory_sort_asc = true;
        }
    }

    if(isset($_GET['name'])){
        $name = $_GET['name'];
    }
    if(isset($_GET['type'])){
        $type = $_GET['type'];
    }
    if(isset($_GET['category'])){
        $category = $_GET['category'];
    }
    ?>
    <div class="container-fluid">
        <div class="row first-row-margin">
            <?php include("management_navbar.php")?>
            <div class="col-10 ">
                <div class="row">
                    <div class="col-10 pt-5">
                        <h1 class="pt-5 fira-sans-black">Manage Inventory</h1>
                    <button class='playfair-display management_btn mt-4'  onclick="location.href='management_addItem.php';">Add new item</button>

                    </div>
                </div>
                <div class="container-fluid inventory_container">
                    <form action="management_manageInventory.php" method="GET">
                        <div class="row">
                            <div class="col-4">
                                <label for="name" class='fira-sans-black'>Item Name:</label>
                                <input type="text" name='name' placeholder="Search for item name" class="w-75" value='<?php echo isset($_GET['name'])? $name: ""?>'>
                            </div>
                            <div class="col">
                                <label for="type" class='fira-sans-black'>Type:</label>
                                <select id="type" name="type" class="w-50">
                                    <option value="All" <?php echo ($_GET['type'] ?? '') === 'All' ? 'selected' : ''; ?>>All</option>
                                    <option value="Food" <?php echo ($_GET['type'] ?? '') === 'Food' ? 'selected' : ''; ?>>Food</option>
                                    <option value="Beverage" <?php echo ($_GET['type'] ?? '') === 'Beverage' ? 'selected' : ''; ?>>Beverage</option>
                             </select>
                            </div>
                            <div class="col">
                                <label for="category" class='fira-sans-black'>Status:</label>
                                <select id="category" name="category" class="w-75">
                                    <option value="All" <?php echo ($_GET['category'] ?? '') === 'All' ? 'selected' : ''; ?>>All</option>
                                    <option value="Western" <?php echo ($_GET['category'] ?? '') === 'Western' ? 'selected' : ''; ?>>Western</option>
                                    <option value="Malaysian" <?php echo ($_GET['category'] ?? '') === 'Malaysian' ? 'selected' : ''; ?>>Malaysian</option>
                                    <option value="Korean" <?php echo ($_GET['category'] ?? '') === 'Korean' ? 'selected' : ''; ?>>Korean</option>
                                    <option value="Japanese" <?php echo ($_GET['category'] ?? '') === 'Japanese' ? 'selected' : ''; ?>>Japanese</option>
                                </select>
                            </div>
                            <div class="col">
                            <button types='submit' class='w-25 management_btn'>Search</button>
                            <button type='reset' class='w-25 management_btn' onclick="window.location.href = 'management_manageInventory.php'">Reset</button>
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
                                        if(isset($_GET['name'])){
                                            if($_GET['name'] != ""){
                                                $getVariable .= "email=" . $_GET['name'] . "&";
                                            }
                                        }
                                        
                                        if(isset($_GET['type'])){
                                            if($_GET['type'] != ""){
                                                $getVariable .= "date=" . $_GET['type'] . "&";
                                            }
                                        }
                                        
                                        if(isset($_GET['category'])){
                                            if($_GET['category'] != ""){
                                                $getVariable .= "status=" . $_GET['category'] . "&";
                                            }
                                        }
                                       $getVariable = rtrim($getVariable, "&");
                                        echo "<a class='text-light' href=\"management_manageInventory.php?" . $getVariable . "&ID_sort=" . ($id_sort_asc ? '0' : '1') . "\">Item ID</a>";
                                        echo $id_sort_asc ? '<svg xmlns="http://www.w3.org/2000/svg" fill="#ffffff" height="24" viewBox="0 -960 960 960" width="24"><path d="m280-400 200-200 200 200H280Z"/></svg>' : '<svg  fill="#ffffff" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-360 280-560h400L480-360Z"/></svg>'
                                    ?>
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
                                    <?php
                                           $getVariable = "";
                                           if(isset($_GET['name'])){
                                               if($_GET['name'] != ""){
                                                   $getVariable .= "email=" . $_GET['name'] . "&";
                                               }
                                           }
                                           
                                           if(isset($_GET['type'])){
                                               if($_GET['type'] != ""){
                                                   $getVariable .= "date=" . $_GET['type'] . "&";
                                               }
                                           }
                                           
                                           if(isset($_GET['category'])){
                                               if($_GET['category'] != ""){
                                                   $getVariable .= "status=" . $_GET['category'] . "&";
                                               }
                                           }
                                          $getVariable = rtrim($getVariable, "&");
                                            
                                            echo "<a class='text-light' href=\"management_manageInventory.php?" . $getVariable . "&inventory_sort=" . ($inventory_sort_asc ? '0' : '1') . "\">Total</a>";
                                                if($inventory_sort_asc === true){
                                                    echo '<svg xmlns="http://www.w3.org/2000/svg" height="24" fill="#ffffff" viewBox="0 -960 960 960" width="24"><path d="m280-400 200-200 200 200H280Z"/></svg>'; 
                                                }else if($inventory_sort_asc === false){
                                                    echo '<svg xmlns="http://www.w3.org/2000/svg" height="24"  fill="#ffffff" viewBox="0 -960 960 960" width="24"><path d="M480-360 280-560h400L480-360Z"/></svg>' ;
                                                }
                                        ?>
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
                       $sql ="SELECT * FROM inventory";

                       if(isset($_GET["name"])){  
                           $name = $_GET['name'];
                           if(!empty($name)){
                               $sql .= " WHERE name LIKE '%$name%'";                                
                           }
                       }
                       
                       if(isset($_GET['type'])){
                           $type = $_GET['type'];
                           if($type !== 'All') {
                               $sql .= strpos($sql, 'WHERE') !== false ? " AND type = '$type'" : " WHERE type = '$type'";
                           }
                       }
                       
                       if(isset($_GET['category'])){
                           $category = $_GET['category'];
                           if($category !== 'All') {
                               $sql .= strpos($sql, 'WHERE') !== false ? " AND category = '$category'" : " WHERE category = '$category'";
                           }
                       }

                    if ($inventory_sort_asc !== null) {
                        $sql .= " ORDER BY inventory " . ($inventory_sort_asc ? "ASC" : "DESC");
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
