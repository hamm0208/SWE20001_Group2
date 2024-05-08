<?php
include("connection.php");
if(isset($_POST['edit_submit'])){
        $package_id = $_POST["package_id"];
        $packageName = $_POST['packageName'];
        $packageAvailability = $_POST['type'];
        $packagePrice = $_POST['price'];
        $result = false;
        $error_msg = "";
        if($packagePrice < 0) {
            $error_msg .= "Item price cannot be negative.\\n";
        }
        if(!empty($error_msg)) {            
            echo '<script>alert("' . $error_msg . '");</script>';
            echo '<script>window.location.href = "management_editPackage.php?package_id=" . $package_id . "";</script>';
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
                $sql = "UPDATE packages
                        SET name = '$packageName',
                        availability = '$packageAvailability',
                        price = '$packagePrice',
                        image = '$new_img_name'
                        WHERE package_id = '$package_id'";
                $result = mysqli_query($conn, $sql);
            }
        }else{
            $sql = "UPDATE packages
                        SET name = '$packageName',
                        availability = '$packageAvailability',
                        price = '$packagePrice'
                        WHERE package_id = '$package_id'";
            $result = mysqli_query($conn, $sql);
        
        }
        if($result){
            echo '<script>alert("Package edit succesfully.");</script>';
            echo '<script>window.location.href = "management_packages.php";</script>';
            exit();
        }else{
            echo '<script>alert("Package edit unsuccessfully.");</script>';
            echo '<script>window.location.href = "management_packages.php";</script>';
            exit();
        }
}else{
    echo '<script>alert("Invalid ID");</script>';
    echo '<script>window.location.href = "management_packages.php";</script>';
    exit();
}