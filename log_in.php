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
    <title>Login</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/bootstrap.css">
    <style>
    body {
        background-color: #D8C3A5;
        margin: 0;
        padding: 0;
    }
    .registration_container {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        width: 90%;
        margin: 30px auto;
        display: flex;
    }
    .registration-form-container {
        text-align: center;
        flex: 1;
        padding-right: 20px;
        max-width: 50%;
    }
    .cuisine-image-container {
        flex: 1;
        background-image: url('Images/web_resources/logindeco.png');
        background-size: cover;
        border-radius: 10px;
        max-width: 50%;
    }
    input[type="email"],
    input[type="password"],
    button,
    a.form-button {
        display: block;
        width: calc(100% - 20px);
        margin-bottom: 15px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        transition: border-color 0.3s;
    }
    input[type="email"]:focus,
    input[type="password"]:focus {
        border-color: #007bff;
        background-color: #f0f0f0; 
    }
    button,
    a.form-button {
        background-color: #007bff;
        color: #fff;
        font-size: 16px;
        text-decoration: none;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
    }
    button:hover,
    a.form-button:hover {
        background-color: #0056b3;
    }
    span.login-link {
        font-weight: 600;
    }
</style>
</head>
<body>

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
            <form id="loginForm" action="log_in.php" method="POST">
                <input type="email" name="email" id="email" placeholder="Email">
                <input type="password" name="password" id="password" placeholder="Password">
                <button type="submit" name="log_in_submit" id="loginButton">Log In</button>
                <a href="index.php" class="form-button bg-danger">Cancel</a>
            </form>
            <span class="login-link">Don't have an account? <a href="registration.php">Sign Up Here!</a></span>
        </div>
        <div class="cuisine-image-container"></div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('loginForm');
        var loginButton = document.getElementById('loginButton');

        // Change background color of input fields when focused
        form.addEventListener('focusin', function(event) {
            if (event.target.matches('input')) {
                event.target.style.backgroundColor = '#f0f0f0';
            }
        });

        form.addEventListener('focusout', function(event) {
            if (event.target.matches('input')) {
                event.target.style.backgroundColor = ''; 
            }
        });

        // Show loading spinner when form is submitted
        form.addEventListener('submit', function(event) {
            var spinner = document.createElement('span');
            spinner.className = 'spinner-border spinner-border-sm';
            spinner.setAttribute('role', 'status');
            spinner.setAttribute('aria-hidden', 'true');
            loginButton.appendChild(spinner);
            });
    });
</script>

</body>
</html>





