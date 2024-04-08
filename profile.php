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
    <h1>Customer Profile</h1>
    <div class="profile-info">
        <?php
        
        include 'database.php';
        
        include 'connection.php';

        // Retrieve the username 
        $customer_username = "Anjanaa Lyan"; 

        // Display the username
        echo "<p><strong>Username:</strong> $customer_username</p>";

        
        $user_email = "anjanaalyann@gmail.com"; 
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
                // Display profile image if available
                if (!empty($row["profile_image"])) {
                    echo "<p><img src='" . $row["profile_image"] . "' alt='Profile Image'></p>";
                }
            }
        } else {
            echo "<p>User not found.</p>";
        }

        
        mysqli_close($conn);
        ?>
    </div>
    <button onclick="location.href='edit_profile.php'">Edit Profile</button>
</div>

<?php include 'footer.php'; ?>

</body>
</html>