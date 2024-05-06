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
        $packageName = $_POST['packageName'];
        $packageAvailability = $_POST['type'];
        $packagePrice = $_POST['price'];
        $packageItems = $_POST['items'];
        $filteredItems = array_filter($packageItems, function($item) {
            return $item['quantity'] > 0;
        });
        $new_package = array(
            'name' => $packageName,
            'price' => $packagePrice,
            'items' => $filteredItems,
        );
        var_dump($new_package);
        $result = false;
        $error_msg = "";
        if($packagePrice < 0) {
            $error_msg .= "Item price cannot be negative.\\n";
        }

        if(count($filteredItems) <= 1) {
            $error_msg .= "Please select more than 1 item for the package.\\n";
        }

        if(!empty($error_msg)) {            
            echo '<script>alert("' . $error_msg . '");</script>';
            echo '<script>window.location.href = "management_addPackage.php";</script>';
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
                $sql_check_empty = "SELECT COUNT(*) FROM packages";
                $new_package['image'] = $new_img_name;

                $result = mysqli_query($conn, $sql_check_empty);
                $row = mysqli_fetch_array($result);
                $count = $row[0];

                $sql_get_max_id = "SELECT MAX(CAST(SUBSTRING(package_id, 2) AS UNSIGNED)) FROM packages";
                $result = mysqli_query($conn, $sql_get_max_id);
                $row = mysqli_fetch_array($result);
                $max_id = $row[0];
                $max_id = $max_id ? $max_id : 0; 
                $package_id = "P" . ($max_id + 1); 
                $sql = "INSERT INTO packages (package_id, name, availability, price, image) VALUES ('$package_id', '{$new_package['name']}', true ,'{$new_package['price']}', '{$new_package['image']}')";
                mysqli_query($conn, $sql);
                
                // Insert package items into the package_items table
                var_dump($new_package['items']);
                if (isset($new_package['items']) && is_array($new_package['items'])) {
                    foreach ($new_package['items'] as $item_id => $item) {
                        $quantity = $item['quantity'];
                        echo $item_id;
                        $sql = "INSERT INTO package_items (package_id, item_id, quantity) VALUES ('$package_id', '$item_id', '$quantity')";
                        mysqli_query($conn, $sql);
                    }
                }
            }else{
                echo '<script>alert("Package added unsuccessfully.");</script>';
                echo '<script>window.location.href = "management_packages.php";</script>';
                exit();
            }
        }
        if($result){
            echo '<script>alert("Package added succesfully.");</script>';
            echo '<script>window.location.href = "management_packages.php";</script>';
            exit();
        }else{
            echo '<script>alert("Package added unsuccessfully.");</script>';
            echo '<script>window.location.href = "management_packages.php";</script>';
            exit();
        }   
}else{
    echo '<script>alert("Invalid ID");</script>';
    echo '<script>window.location.href = "management_packages.php";</script>';
    exit();
}
?>