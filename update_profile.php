<?php

include 'database.php';

include 'connection.php';
session_start();
if($_SESSION["email"] == ""){
    echo '<script>alert("Please Login First");</script>';
    echo '<script>window.location.href = "log_in.php";</script>';
    exit();
}else{
    $user_email = $_SESSION["email"];
} 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contact_number = $_POST['contact_number'];
    if(!empty($_FILES["profile_image"]["name"])){
        echo "profile here";
        $problem = false;
        //Extract file_name, file_size and tmp_name
        $file_name = $_FILES["profile_image"]["name"];
        $file_size = $_FILES["profile_image"]["size"];
        $tmp_name = $_FILES["profile_image"]["tmp_name"];
        
        //Extract file extension
        $image_extension = explode(".", $file_name);
        $image_extension = strtolower(end($image_extension));
        $allowed_extensions = array("jpg", "jpeg", "png");
        
        //If extension is not jpg, jpeg or png or image is empty or image size is above 5mb it will return false;
        if(!in_array($image_extension, $allowed_extensions)) {
            echo  "<script>alert('Sorry, only JPG, JPEG, and PNG files are allowed.')</script>";
            $problem = true;
        }else if(isset($_POST["profile_image"])){
            echo  "<script>alert(No file uploaded)</script>";
            $problem = true;
        }else if ($_FILES["profile_image"]["size"] > 5000000) {
            echo  "<script>alert('Sorry, your file is too large.')</script>";
            $problem = true;
        }
        if(!$problem){
            //Have unique id for every photo
            $new_img_name = uniqid();
            //Add file extentsion
            $new_img_name .= '.'.$image_extension;
            //Move the file to images
            move_uploaded_file($tmp_name, 'Images/profile_image/'. $new_img_name);
            //Insert the data into event_table
            $sql = "UPDATE users
                SET contact_number='$contact_number',
                    profile_image = '$new_img_name'
                    WHERE email='$user_email'
            ";
            $result = mysqli_query($conn, $sql);

        }
    }else{
        $sql = "UPDATE users SET contact_number='$contact_number' WHERE email='$user_email'";
        $result = mysqli_query($conn, $sql);
    }

    if($result){
        echo '<script>alert("Profile edit succesfully.");</script>';
        echo '<script>window.location.href = "profile.php";</script>';
        mysqli_close($conn);
        exit();
    }else{
       echo '<script>alert("Profile edit unsuccessfully.");</script>';
       echo '<script>window.location.href = "profile.php";</script>';
       mysqli_close($conn);
       exit();
    }
    

}else{
    echo '<script>alert("Invalid Request");</script>';
    echo '<script>window.location.href = "index.php";</script>';
    exit();
}
?>
