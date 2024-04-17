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
            if($_SESSION["email"] == ""){
                echo '<script>alert("Please Login First");</script>';
                echo '<script>window.location.href = "log_in.php";</script>';
                exit();
            }else{
                $email = $_SESSION["email"];
            }
            
            if(isset($_SESSION['email'])) {
                include 'database.php'; 

                // Retrieve user email from session
                $user_email = $_SESSION['email'];

                // Fetch user information from the database
                $sql = "SELECT * FROM users WHERE email = '$user_email'"; 

                $result = mysqli_query($conn, $sql);

                // Check if user exists
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $gender = $row['gender'];
                        $profile_image = $row['profile_image'];
                        echo "<p><strong>Email:</strong> " . $row["email"] . "</p>";
                        echo "<p><strong>Name:</strong> " . $row["first_name"] . " " . $row["last_name"] . "</p>";
                        echo "<p><strong>Date of Birth:</strong> " . $row["dob"] . "</p>";
                        $gender_display = ($row["gender"] === "male") ? "Male" : "Female";
                        echo "<p><strong>Gender:</strong> $gender_display</p>";
                        echo "<p><strong>Contact Number:</strong> " . $row["contact_number"] . "</p>";
                    }
                } else {
                    echo "<p>User not found.</p>";
                }
            } else {
                echo "<p>User not logged in.</p>";
            }

            ?>
            <div class="buttons-container">
                <button class="edit-profile-button" onclick="location.href='edit_profile.php'">Edit Profile</button>
                <button class="logout-button" onclick="location.href='log_out.php'">Logout</button>
            </div>
        </div>
        
        <div class="profile-image">
            <?php
            // Check if the user has a custom profile image
            $profile_image_path = "images/profile_image/";
            if (!empty($profile_image) && file_exists($profile_image_path . $profile_image)){
                $profile_image_pic = "images/profile_image/".$profile_image;
            } else {
                if ($gender == "male") {
                    $profile_image_pic = "images/profile_image/male_default.png";
                } else {
                    $profile_image_pic = "images/profile_image/female_default.png";
                }
            }

            // Display profile image
            echo "<img src='$profile_image_pic' alt='Profile Image'>";
            ?>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
