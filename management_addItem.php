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
    <form action="management_addItem.php" class="playfair-display" method="POST" enctype="multipart/form-data">

                
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
 if(isset($_POST['add_submit'])){
        $itemName = $_POST['itemName'];
        $itemDescription = $_POST['description'];
        $itemType = $_POST['type'];
        $itemCategory = $_POST['category'];
        $itemStock = $_POST['stock_count'];
        $itemPrice = $_POST['price'];
        $result = false;

        if(!empty($_FILES["image"]["name"])){
            $problem = false;
            //Extract file_name, file_size and tmp_name
            $file_name = $_FILES["image"]["name"];
            $file_size = $_FILES["image"]["size"];
            $tmp_name = $_FILES["image"]["tmp_name"];
            
            //Extract file extension
            $image_extension = explode(".", $file_name);
            $image_extension = strtolower(end($image_extension));
            $allowed_extensions = array("jpg", "jpeg", "png");

            //If extension is not jpg, jpeg or png or image is empty or image size is above 5mb it will return false;
            if(!in_array($image_extension, $allowed_extensions)) {
                echo  "<script>alert('Sorry, only JPG, JPEG, and PNG files are allowed.')</script>";
                $problem = true;
            }else if(isset($_POST["image"])){
                echo  "<script>alert(No file uploaded)</script>";
                $problem = true;
            }else if ($_FILES["image"]["size"] > 5000000) {
                echo  "<script>alert('Sorry, your file is too large.')</script>";
                $problem = true;
            }
            if(!$problem){
                //Have unique id for every photo
                $new_img_name = uniqid();
                //Add file extentsion
                $new_img_name .= '.'.$image_extension;
                //Move the file to images
                move_uploaded_file($tmp_name, 'Images/food_image/'. $new_img_name);
                //Insert the data into event_table
                $sql = "INSERT INTO inventory
                SET
                name = '$itemName',
                description = '$itemDescription',
                type = '$itemType',
                category = '$itemCategory',
                inventory = '$itemStock',
                price = '$itemPrice',
                item_image_name = '$new_img_name'"
                ;
                $result = mysqli_query($conn, $sql);
            }
        }
        if($result){
            echo '<script>alert("Item added succesfully.");</script>';
            echo '<script>window.location.href = "management_manageInventory.php";</script>';
            exit();
        }else{
            echo '<script>alert("Item added unsuccessfully.");</script>';
            echo '<script>window.location.href = "management_manageInventory.php";</script>';
            exit();
        }
    
}
?>
</body>
</html>