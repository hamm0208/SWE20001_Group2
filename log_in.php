<?php
// Include database configuration file
    session_start();
    require_once 'database.php';
    include "font.php";
    if(!isset($_SESSION['email'])){
        $_SESSION["email"] = "";
    }
    if(!isset($_SESSION['type'])){
        $_SESSION["type"] = "";
    }
    if(!isset($_SESSION['cart_ids'])){
        $_SESSION["cart_ids"] = [];
    }

    

    if(isset($_POST['log_in_submit'])){
        echo $_POST['log_in_submit'];
        $found = false;
        $input_email = $_POST["email"];
        $input_password = $_POST["password"];
        $find_email = "SELECT * FROM accounts where email = '$input_email'";
        if(mysqli_num_rows(mysqli_query($conn, $find_email)) == 1){
            $row = mysqli_fetch_assoc(mysqli_query($conn, $find_email));
            $found_email = $row['email'];
            $user = $row['type'];
            $found_password = $row['password'];
            $found = true;
        }

        if($found){
            if(password_verify($input_password,$found_password)){    
                $_SESSION['email'] = $found_email;

                if($user == 'management'){
                    $_SESSION['type'] = 'management';
                    header("Location: management_manageInventory.php");
                    exit(); 
                }else if($user == 'opearation'){
                    $_SESSION['type'] = 'opearation';
                }else{
                    $_SESSION['type'] = 'customer';
                    header("Location: index.php");
                    exit(); 
                }
            }else{
                echo "<script>alert('Login Failed. Invalid username or password. Please try again');</script>";
                $_POST['log_in_submit'] = '';
                $found = false;
            }
        }else{
            $_POST['log_in_submit'] = '';
            echo "<script>alert('Login Failed. Invalid username or password. Please try again');</script>";
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register New Profile</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/bootstrap.css">
</head>
<body id="background">

<div class="container-fluid">
    <div class="row">
        <div class="col-12 text-center my-3">
            <a href="index.php">
                <img src="Images/web_resources/foodEdge_logo.png" alt="FoodEdge Logo" class="img-fluid" style="max-width: 200px;">
            </a>
        </div>
    </div>
    <div class="registration_container">
    <div class="registration-form-container">
        <form action="log_in.php" method="post">
            <label for='email'>
                Email: 
                <input type="email" name='email'>
            </label>
            <br>
            <label for='email'>
                Password: 
                <input type="password" name='password'>
            </label>
            <br>
            <button type="submit" name='log_in_submit' class="form-button">Log In</button>
            <a href="index.php" class="form-button bg-danger">Cancel</a>
        </form>
        <span class='login.php' style='font-weight: 600;'>Don't have an account? <a href='registration.php'>Sign Up Here!</a></span>

    </div>
</div>
</div>


</body>
</html>
