<?php
// Include database configuration file
require_once 'database.php'; // Adjust the path as necessary

// Initialize variables
$email = $first_name = $last_name = $dob = $gender = $contact_number = $password = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assign POST values to variables
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $contact_number = $_POST['contact_number'];
    $password = $_POST['password'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare an insert statement
    $sql = "INSERT INTO users (email, first_name, last_name, dob, gender, contact_number, profile_image) VALUES (?, ?, ?, ?, ?, ?, NULL)";
    
    if($stmt = $conn->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("ssssss", $email, $first_name, $last_name, $dob, $gender, $contact_number);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            echo "<script>alert('Registration successful.');</script>";
            // Redirect to login page or home page
            // header("location: login.php"); // Uncomment and adjust as necessary
        } else{
            echo "<script>alert('Something went wrong. Please try again later.');</script>";
        }
        
        // Close statement
        $stmt->close();
    }
    
    // Close connection
    $conn->close();
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
        <div class="col-12 text-center mt-3">
            <img src="Images/web_resources/foodEdge_logo.png" alt="FoodEdge Logo" class="img-fluid" style="max-width: 200px;">
        </div>
    </div>
</div>

<div class="registration_container">
    <form action="registration.php" method="post" id="registrationForm">
        <h2>Create New Profile</h2>
        
        <div class="registration-form-container">
            <div class="registration_row">
                <label>Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="registration_row">
                <label>First Name:</label>
                <input type="text" id="first_name" name="first_name" required>
            </div>
            
            <div class="registration_row">
                <label>Last Name:</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>
            
            <div class="registration_row">
                <label>Date of Birth:</label>
                <input type="date" id="dob" name="dob" max="">
            </div>
            
            <div class="registration_row">
                <label>Gender:</label>
                <div>
                    <input type="radio" id="male" name="gender" value="Male" required>
                    <label for="male">Male</label>
                </div>
                <div>
                    <input type="radio" id="female" name="gender" value="Female" required>
                    <label for="female">Female</label>
                </div>
                <div>
                    <input type="radio" id="other" name="gender" value="Other" required>
                    <label for="other">Other</label>
                </div>
            </div>
            
            <div class="registration_row">
                <label>Contact Number:</label>
                <input type="tel" id="contact_number" name="contact_number" pattern="\+?[0-9]+" title="Only numbers and a leading plus sign are allowed.">
            </div>
            
            <div class="registration_row">
                <label>Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <div class="registration_row">
                <label>Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            
            <div class="registration_row button-group">
                <button type="submit" class="form-button">Register</button>
                <button type="reset" class="form-button">Reset</button>
            </div>
        </div>
    </form>
</div>

<script>
    document.getElementById('registrationForm').onsubmit = function(e) {
        var password = document.getElementById('password').value;
        var confirmPassword = document.getElementById('confirm_password').value;
        if (password !== confirmPassword) {
            e.preventDefault(); // Prevent form submission
            alert('Passwords do not match.');
        }
    };
    
    // Set max DOB to today's date
    var today = new Date().toISOString().split('T')[0];
    document.getElementById("dob").setAttribute('max', today);
</script>

</body>
</html>
