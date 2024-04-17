<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>

<?php include 'header.php';
include "connection.php";
if($_SESSION["email"] == ""){
    echo '<script>alert("Please Login First");</script>';
    echo '<script>window.location.href = "log_in.php";</script>';
    exit();
}else{
    $email = $_SESSION["email"];
} 

$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $dob = $row['dob'];
        $gender = $row['gender'];
        $contactNo = $row['contact_number'];
        $profile_img = $row['profile_image'];
    }
}
?>
<style>
    .disabled-input{
        background-color: #f0f0f0;
    }
    .disabled-input:disabled {
    background-color: #f0f0f0;
}

</style>
<div class="profile-wrapper">
<h1>EDIT PROFILE</h1>
    <div class="profile-form-container">
        <div class="profile-info">
            <form action="update_profile.php" method="POST" enctype="multipart/form-data">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" required pattern="[A-Za-z]+" class="disabled-input"  value='<?php echo $first_name?>' disabled title="Only letters allowed">

                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" required pattern="[A-Za-z]+" class="disabled-input"  value='<?php echo $last_name?>' disabled title="Only letters allowed">

                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" class="disabled-input"  value='<?php echo $dob?>' disabled  max="<?php echo date('Y-m-d'); ?>" required>

                <label for="gender">Gender:</label>
                <input type="text" id="gender" name="gender" class="disabled-input" value='<?php echo ($gender === "male") ? "Male" : "Female"; ?>' disabled required>


                <label for="contact_number">Contact Number:</label>
                <input type="tel" id="contact_number" name="contact_number" pattern="[0-9]{10,15}" value="<?php echo $contactNo ?>" title="Please enter a valid phone number" required>

                <label for="profile_image">Profile Image:</label>
                <input type="file" id="profile_image" name="profile_image">

                <input type="submit" value="Save Changes" class="edit-submit-button">
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
