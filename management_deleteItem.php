<?php
    include("connection.php");
    if(isset($_GET["item_id"])){
        $id = $_GET["item_id"];
        $sql = "DELETE FROM inventory WHERE id = '$id'";
    
        mysqli_query($conn, $sql);
        echo "<script>alert('Item ID deleted successfully');</script>";
        header("Location: management_manageInventory.php");
        exit();
    }
?>