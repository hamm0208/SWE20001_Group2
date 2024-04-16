<?php
include("connection.php");
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

 if(isset($_POST['add_submit'])){
        $itemName = $_POST['itemName'];
        $itemDescription = $_POST['description'];
        $itemType = $_POST['type'];
        $itemCategory = $_POST['category'];
        $itemStock = $_POST['stock_count'];
        $itemPrice = $_POST['price'];
        $result = false;
        $error_msg = "";
        if($itemPrice < 0) {
            $error_msg .= "Item price cannot be negative.\\n";
        }

        if($itemStock <= 0) {
            $error_msg .= "Stock count must be greater than zero.\\n";
        }

        if(!empty($error_msg)) {            
            echo '<script>alert("' . $error_msg . '");</script>';
            echo '<script>window.location.href = "management_addItem.php";</script>';
            exit();
        }
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
}else{
    echo '<script>alert("Invalid ID");</script>';
    echo '<script>window.location.href = "management_manageInventory.php";</script>';
    exit();
}
?>