<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Items</title>
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
    ?>
    <script>
        function updateFileName(input) {
            var fileName = input.files[0].name;
            var fileNameElement = document.getElementById('file-name');
            fileNameElement.textContent = fileName;
        }
    </script>
    <div class="container border rounded mt-3 p-2  add-item-container">
    <h2 class="text-center fira-sans-black">Add Item</h2>
    <form action="add_item.php" class="playfair-display" method="POST" enctype="multipart/form-data">

                
        <div class="form-row add_item_row ">
            <div class="form-group col-12 ">
                <label for="itemName">Item Name</label>
                <input type="text" class="form-control" id="itemName" name="itemName"  style="width:101%" required>
            </div>
            
            
        </div>
        <div class="form-row add_item_row mt-3">
            <div class="form-group col-6">
                <label for="price">Price</label>
                <input type="number" class="form-control" placeholder="0" id="price" name="price" step="0.01" required>
            </div>
            <div class="form-group col-6 mx-3">
                <label for="stock_count">Stock Count</label>
                <input type="number" class="form-control" placeholder="0" id="stock_count" name="stock_count" required>
            </div>
        </div>
        <div class="form-row mt-3 add_item_row ">
            <div class="form-group  col-6">
                <label for="type">Type</label>
                <select class="form-control" id="type" name="type" required>
                    <option value="Food">Food</option>
                    <option value="Beverage">Beverage</option>
                </select>
            </div>
            <div class="form-group  col-6 mx-3">
                <label for="category">Category</label>
                <select class="form-control" id="category" name="category" required>
                    <option value="Western">Western</option>
                    <option value="Malaysian">Malaysian</option>
                    <option value="Korean">Korean</option>
                    <option value="Japanese">Japanese</option>
                </select>
            </div>
        </div>
        <div class="form-row my-3 add_item_row ">
            <div class="form-group col-6">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="form-group  col-6 mx-3">
                <label for="image" class="upload-btn">
                    Upload Item Image<br>
                    <img src="Images/web_resources/upload-image.png" alt="Upload Image" class="img-fluid" id="preview-image">
                    <input type="file" id="inputImage" name="image" accept="image/*" required onchange="updateFileName(this)">
                </label>
                <p id="file-name" class="file-name"></p>
            </div>
        </div>

        <div class="form-row my-3 add_item_row ">
            <div class="form-group col-12">
                <div class="d-flex justify-content-end">
                    <a href="management_manageInventory.php" class="btn btn-danger mr-3">Cancel</a>
                    <input type="submit" class="btn btn-primary mx-3" name="add_submit" value="Add Item">
                </div>
            </div>
        </div>
    </form>
</div>
<?php

?>
</body>
</html>