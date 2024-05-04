<?php
include("database.php");
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

if(isset($_GET["item_id"])){
    $id = $_GET["item_id"];
    // Check if the provided item_id is within the table range
    $sql_check_id = "SELECT COUNT(*) AS count FROM inventory WHERE id = '$id'";
    $result_check_id = mysqli_query($conn, $sql_check_id);
    $row_check_id = mysqli_fetch_assoc($result_check_id);
    if($row_check_id['count'] == 0) {
        // If item_id is not within the table range, display an alert and redirect
        echo '<script>alert("Invalid ID");</script>';
        echo '<script>window.location.href = "management_manageInventory.php";</script>';
        exit();
    }
} else {
    // If item_id is not set, display an alert and redirect
    echo '<script>alert("Invalid ID");</script>';
    echo '<script>window.location.href = "management_manageInventory.php";</script>';
    exit();
}

// Proceed with deleting the item if the item_id is valid
$sql = "DELETE FROM inventory WHERE id = '$id'";
mysqli_query($conn, $sql);
echo "<script>alert('Item ID deleted successfully');</script>";
header("Location: management_manageInventory.php");
exit();
?>
