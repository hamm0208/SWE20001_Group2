<?php
// Include the font.php file
include("font.php");
include('database.php');
if(isset($_GET['email'])) {
    $email = $_GET['email'];
    if(empty($email)) {
        //Implement this when LogIn is done;
        $email = "thenbeckham@gmail.com";
        
    }else{
        
    }
}else{
    $email = "thenbeckham@gmail.com";

    //Implement this when LogIn is done "empty";
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodEdge-Add Item</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/bootstrap.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    
    <style>
        /* Custom CSS for margin on the first row */
        .first-row-margin {
            margin-left: 0.5%; /* Adjust margin as needed */
        }
    </style>
</head>
<body id="background">
    <div class="container-fluid">
        <div class="row first-row-margin">
            <div class="col-2 mt-3 my-3  text-center nav_management">
                <img src="Images/web_resources/foodEdge_logo.png" alt="FoodEdge logo" class="logo img-fluid w-75">
                <br>
                <div class="nav mt-5">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="management_addItem.php" class='linkToManagementAddItem'>
                                <img src="Images/web_resources/inventory_logo.png" alt="Inventory Logo" class='w-20'>
                                <p class="playfair-display h4">Inventory</p>
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
                    <div class="col-2 mt-4 manange_profile text-center">
                        <?php
                            if($profile_data['profile_image'] == NULL || $profile_data['profile_image']  == ""){
                                echo '<img class="management_profile mt-5 w-33 " src="Images/web_resources/'.$profile_data['gender'].'_default.png" alt="'.$profile_data['fname'].' profile " >';
                            }else{
                                echo '<img class="mt-5 w-25" src="profile_images/'.$profile_data['img'].'" alt="'.$profile_data['fname'].' profile" >';
                            }
                        ?>
                    </div>
                </div>
                <div class="container-fluid inventory_container">
                    <button class='playfair-display' onclick="location.href='management_addItem.php';">Add new item</button>
                    <div class="table-responsive ">
                <table class="table table-striped table-dark table-hover mt-3">
                    <tr>
                        <th>Item ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </table>
            </div>
                </div>
                
            </div>
        </div>
    </div>
</body>
</html>
