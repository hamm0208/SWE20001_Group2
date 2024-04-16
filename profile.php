<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Profile</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
    <h1>CUSTOMER PROFILE</h1>
    <div class="profile-container">
        <div class="profile-info">
            <?php
            
            session_start(); 
            
            if(isset($_SESSION['user_email'])) {
                include 'database.php'; 

                // Retrieve user email from session
                $user_email = $_SESSION['user_email'];

                // Fetch user information from the database
                $sql = "SELECT * FROM users WHERE email = '$user_email'"; 

                $result = mysqli_query($conn, $sql);

                // Check if user exists
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<p><strong>Email:</strong> " . $row["email"] . "</p>";
                        echo "<p><strong>Name:</strong> " . $row["first_name"] . " " . $row["last_name"] . "</p>";
                        echo "<p><strong>Date of Birth:</strong> " . $row["dob"] . "</p>";
                        echo "<p><strong>Gender:</strong> " . $row["gender"] . "</p>";
                        echo "<p><strong>Contact Number:</strong> " . $row["contact_number"] . "</p>";
                    }
                } else {
                    echo "<p>User not found.</p>";
                }
            } else {
                echo "<p>User not logged in.</p>";
            }

            ?>
            <button class="edit-profile-button" onclick="location.href='edit_profile.php'">Edit Profile</button>
        </div>
        
        <div class="profile-image">
            <?php
            // Check if the user has a custom profile image
            $profile_image_path = "images/profile_image/";

            if (!empty($row["profile_image"]) && file_exists($profile_image_path . $row["profile_image"])) {
                
                $profile_image = $profile_image_path . $row["profile_image"];
            } else {
                
                if ($row["gender"] == "male") {
                $profile_image = "images/profile_image/male_default.png";
                } else {
                $profile_image = "images/profile_image/female_default.png";
                }
            }

            // Display profile image
            echo "<img src='$profile_image' alt='Profile Image'>";
            ?>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
