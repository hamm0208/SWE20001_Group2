<?php

include 'database.php';

include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $contact_number = $_POST['contact_number'];
    
    
    $user_email = "anjanaalyann@gmail.com"; 
    $sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', dob='$dob', gender='$gender', contact_number='$contact_number' WHERE email='$user_email'";
    
    
    if (mysqli_query($conn, $sql)) {
        echo "Profile updated successfully";
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
    }
    
    
    mysqli_close($conn);
}
?>