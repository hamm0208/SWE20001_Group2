<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Items</title>
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
        if(isset($_GET['package_id'])){
            $package_id = $_GET["package_id"];
            $sql_check_id = "SELECT COUNT(*) AS count FROM packages WHERE package_id = '$package_id'";
            $result_check_id = mysqli_query($conn, $sql_check_id);
            $row_check_id = mysqli_fetch_assoc($result_check_id);
            if($row_check_id['count'] == 0) {
                echo '<script>alert("Invalid ID");</script>';
                echo '<script>window.location.href = "management_manageInventory.php";</script>';
                exit();
            }
        }else{
            echo '<script>alert("Invalid ID");</script>';
            echo '<script>window.location.href = "management_manageInventory.php";</script>';
            exit();
        }
        $sql = "SELECT * FROM packages WHERE package_id = '$package_id'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);
            $package_id = $row["package_id"];
            $package_name = $row["name"];
            $package_availability = $row["availability"];
            $package_price = $row["price"];
            $package_img = $row["image"];
        }
    ?>
    <script>
    </script>
    <div class="container border rounded mt-3 p-2  add-item-container">
    <h2 class="text-center fira-sans-black">Edit Packages</h2>
    <form action='edit_package.php' method="POST" enctype="multipart/form-data" class="playfair-display">
        <input type="text" value="<?php echo $package_id ?>" name="package_id" hidden>
        <div class="form-row add_item_row ">
            <div class="form-group col-12 ">
                <label for="packageName">Package Name</label>
                <input type="text" class="form-control" id="packageName" name="packageName"  style="width:101%" value="<?php echo $package_name?>" required>
            </div>
            
            
        </div>
        <div class="form-row add_item_row mt-3">
            <div class="form-group col-6">
                <label for="price">Price</label>
                <input type="number" class="form-control" placeholder="0" value="<?php echo $package_price?>" id="price" name="price" step="0.01" required>
            </div>
            <div class="form-group mx-3 col-6">
                <label for="type">Availability</label>
                <select class="form-control" id="type" name="type" required>
                    <option value="1" <?php echo ($package_availability === "1") ? 'selected' : ''; ?>>Available</option>
                    <option value="0" <?php echo ($package_availability === "0") ? 'selected' : ''; ?>>Not Available</option>
                </select>
            </div>
        </div>
        <div class="form-row mt-3 add_item_row ">
            <div class="form-group col-6">
                <label for="category" class='fs-4'>Items in package</label>
                <ol class='p-0'>
                    <?php
                        $sql = "SELECT * FROM package_items WHERE package_id = '$package_id'";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                                $itemID = $row['item_id'];
                                $quantity = $row['quantity'];
                                $sql_package_item = "SELECT * FROM inventory WHERE id = '$itemID'";
                                $result_package_item = mysqli_query($conn, $sql_package_item);
                                if (mysqli_num_rows($result_package_item) > 0) {
                                $row_item = mysqli_fetch_array($result_package_item);
                                $item_name = $row_item["name"];
                                    echo "<li class='my-2'>". $item_name. " - ". $quantity."</li>" ;
                                }
                            }
                        }
                    ?>
                </ol>
            </div>
            <div class="form-group col-md-6 d-md-block d-none">
                <label for="image" class="">
                Upload Package Image<br>
                <img src="Images/food_image/<?php echo htmlspecialchars($package_img); ?>" alt="Upload Image" class="img-fluid editItem_img">
                <input type="file" id="inputImage" name="image" accept="image/*">
                </label>
            </div>
        </div>
        <div class="form-row my-3 add_item_row text-center">
            <div class="form-group col-md-6  mx-3 d-block d-md-none ">
                <label for="image" class="">
                Upload new Image<br>
                <img src="Images/food_image/<?php echo htmlspecialchars($item_image_name); ?>" alt="Upload Image" class="img-fluid editItem_img"><br>
            </label>
            <div class="div">
                <input type="file" id="inputImage" name="image" accept="image/*" style="left:15%; position:relative">
            </div>
            </div>
        </div>

        <div class="form-row my-3 add_item_row ">
            <div class="form-group col-12">
                <div class="d-flex justify-content-end">
                    <input type="submit" class="btn btn-primary mx-3" name="edit_submit" value="Edit Package">
                    <a href="management_packages.php" class="btn btn-danger mr-3">Cancel</a>
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>