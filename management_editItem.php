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
        if(isset($_GET['item_id'])){
            $item_id = $_GET["item_id"];
            $sql_check_id = "SELECT COUNT(*) AS count FROM inventory WHERE id = '$item_id'";
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
        $sql = "SELECT * FROM inventory WHERE id = '$item_id'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);
            $id_db = $row["id"];
            $item_name = $row["name"];
            $item_description = $row["description"];
            $item_type = $row["type"];
            $item_category = $row["category"];
            $item_inventory = $row["inventory"];
            $item_price = $row["price"];
            $item_image_name = $row["item_image_name"];
        }
    ?>
    <script>
    </script>
    <div class="container border rounded mt-3 p-2  add-item-container">
    <h2 class="text-center fira-sans-black">Edit Item</h2>
    <form action='edit_item.php' method="POST" enctype="multipart/form-data">
        <input type="number" value="<?php echo $id_db ?>" name="item_id" hidden>
        <div class="form-row add_item_row ">
            <div class="form-group col-12 ">
                <label for="itemName">Item Name</label>
                <input type="text" class="form-control" id="itemName" name="itemName"  style="width:101%" value="<?php echo $item_name?>" required>
            </div>
            
            
        </div>
        <div class="form-row add_item_row mt-3">
            <div class="form-group col-6">
                <label for="price">Price</label>
                <input type="number" class="form-control" placeholder="0" value="<?php echo $item_price?>" id="price" name="price" step="0.01" required>
            </div>
            <div class="form-group col-6 mx-3">
                <label for="stock_count">Stock Count</label>
                <input type="number" class="form-control" placeholder="0" id="stock_count" value="<?php echo $item_inventory?>" name="stock_count" required>
            </div>
        </div>
        <div class="form-row mt-3 add_item_row ">
            <div class="form-group  col-6">
                <label for="type">Type</label>
                <select class="form-control" id="type" name="type" required>
                    <option value="Food" <?php echo ($item_type === "Food") ? 'selected' : ''; ?>>Food</option>
                    <option value="Beverage" <?php echo ($item_type === "Beverage") ? 'selected' : ''; ?>>Beverage</option>
                </select>
            </div>
            <div class="form-group  col-6 mx-3">
                <label for="category">Category</label>
                    <select class="form-control" id="category" name="category" required>
                        <option value="Western" <?php echo ($item_category === "Western") ? 'selected' : ''; ?>>Western</option>
                        <option value="Malaysian" <?php echo ($item_category === "Malaysian") ? 'selected' : ''; ?>>Malaysian</option>
                        <option value="Korean" <?php echo ($item_category === "Korean") ? 'selected' : ''; ?>>Korean</option>
                        <option value="Japanese" <?php echo ($item_category === "Japanese") ? 'selected' : ''; ?>>Japanese</option>
                    </select>
            </div>
        </div>
        <div class="form-row my-3 add_item_row ">
            <div class="form-group col-md-6 col-12">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required><?php echo htmlspecialchars($item_description); ?></textarea>
            </div>

            <div class="form-group col-md-6  mx-3 d-md-block d-none">
                <label for="image" class="">
                Upload Item Image<br>
                <img src="Images/food_image/<?php echo htmlspecialchars($item_image_name); ?>" alt="Upload Image" class="img-fluid editItem_img">
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
                    <a href="management_manageInventory.php" class="btn btn-danger mr-3">Cancel</a>
                    <input type="submit" class="btn btn-primary mx-3" name="edit_submit" value="Edit Item">
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>