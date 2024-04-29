<?php
include("connection.php");

session_start();
try{
    if(isset($_SESSION["email"]) && isset($_SESSION["type"])) {
            if($_SESSION["type"] == "management"){
                $email = $_SESSION['email'];
                $user = $_SESSION['type'];
            }else{
                echo '<script>alert("Unauthorised Access!");</script>';
                echo '<script>window.location.href = "log_in.php";</script>';
                exit();
            }
        }else{
            echo '<script>alert("Unauthorised Access!");</script>';
                echo '<script>window.location.href = "log_in.php";</script>';
                exit();
        }
}catch(Exception $e){};

if(isset($_GET["email"])){
    $email = $_GET["email"];
    $sql_check_email = "SELECT COUNT(*) AS count FROM accounts WHERE email = '$email'";
    $result_check_email = mysqli_query($conn, $sql_check_email);
    $row_check_email = mysqli_fetch_assoc($result_check_email);
    if($row_check_email['count'] == 0) {
        echo '<script>alert("Email not found");</script>';
        echo '<script>window.location.href = "management_users.php";</script>';
        exit();
    }
} else {
    echo '<script>alert("Email not found");</script>';
    echo '<script>window.location.href = "management_users.php";</script>';
    exit();
}

// Proceed with deleting the item if the item_id is valid
$sql = "DELETE FROM users WHERE email = '$email'";
mysqli_query($conn, $sql);
echo "<script>alert('Account with email deleted successfully');</script>";
header("Location: management_users.php");
exit();
?>
