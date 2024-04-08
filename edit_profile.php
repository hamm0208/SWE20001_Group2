<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
    <h1>Edit Profile</h1>
    <div class="profile-info">
        <form action="update_profile.php" method="POST" enctype="multipart/form-data">
            <label for="first_name">First Name:</label><br>
            <input type="text" id="first_name" name="first_name" required pattern="[A-Za-z]+" title="Only letters allowed"><br>

            <label for="last_name">Last Name:</label><br>
            <input type="text" id="last_name" name="last_name" required pattern="[A-Za-z]+" title="Only letters allowed"><br>

            <label for="dob">Date of Birth:</label><br>
            <input type="date" id="dob" name="dob" max="<?php echo date('Y-m-d'); ?>" required><br>

            <label for="gender">Gender:</label><br>
            <select id="gender" name="gender" required>
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select><br>

            <label for="contact_number">Contact Number:</label><br>
            <input type="tel" id="contact_number" name="contact_number" pattern="[0-9]{10,15}" title="Please enter a valid phone number" required><br>

            <label for="profile_image">Profile Image:</label><br>
            <input type="file" id="profile_image" name="profile_image"><br>

            <input type="submit" value="Save Changes">
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>