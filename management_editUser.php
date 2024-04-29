<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Staff</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    
</head>
<body id="background">
    <?php
        include("font.php");
        include('connection.php');
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
                $account_email = $_GET["email"];
                $sql_check_email = "SELECT COUNT(*) AS count FROM accounts WHERE email = '$account_email'";
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

            $sql = "SELECT * FROM users WHERE email = '$account_email'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_assoc($result);
                $account_email = $row["email"];
                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $dob = $row['dob'];
                $gender = $row['gender'];
                $contact_number = $row['contact_number'];
                $sql_accounts = "SELECT * FROM accounts WHERE email = '$account_email'";
                $result_account = mysqli_query($conn, $sql_accounts);
                if(mysqli_num_rows($result_account) == 1){
                    $row = mysqli_fetch_assoc($result_account);
                    $account_type = $row['type'];
                }
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $account_type = $_POST['type'];
                $update_sql = "UPDATE accounts SET type = '$account_type' WHERE email = '$account_email'";
                $result = mysqli_query($conn, $update_sql);
                if($result){
                    echo "<script>alert('Account type updated successfully');</script>";
                }else{
                    echo "<script>alert('Error updating account type');</script>";
                }
                echo '<script>window.location.href = "management_users.php";</script>';
                $conn->close();
            }
    ?>
    <div class="container border rounded mt-3 p-2  add-item-container">
    <h2 class="text-center fira-sans-black">Edit Staff Access</h2>
    <form action="management_editUser.php?email=<?php echo $account_email?>" class="playfair-display" method="POST" id='registrationForm' enctype="multipart/form-data">        
        <div class="form-row add_item_row mt-3">
            <div class="form-group col-12">
                <label for="email">Email</label>
                <input type="text" class="form-control w-100" placeholder="Staff Email" id="email" name="email" value="<?php echo $account_email ?>" disabled required>
            </div>
        </div><div class="form-row add_item_row mt-3">
            <div class="form-group col-6">
                <label for="first_name">Staff First Name</label>
                <input type="text" class="form-control w-100" placeholder="Staff Name" id="first_name" name="first_name"  value="<?php echo $first_name ?>" disabled required>
            </div>
            <div class="form-group col-6 mx-3">
                <label for="last_name">Staff Last Name</label>
                <input type="text" class="form-control w-100" value="<?php echo $last_name ?>" disabled placeholder="Staff Name" id="last_name" name="last_name" required>
            </div>
        </div>
        <div class="form-row add_item_row mt-3">
            <div class="form-group col-6">
                <label for="contact_number">Phone number</label>
                <input type="tel" class="form-control w-100 " value="<?php echo $contact_number ?>" disabled placeholder="0123456789" id="contact_number" name="contact_number" required>
            </div>
            <div class="form-group  col-6 mx-3">
                <label for="dob">Date Of Birth</label>
                <input type="date" class="form-control w-100 " value="<?php echo $dob ?>" disabled  id="dob" name="dob" max required>
            </div>
            
        </div>
        <div class="form-row mt-3 add_item_row ">
            <div class="form-group  col-6">
                <label for="gender">Gender</label>
                <select class="form-control" id="gender" name="gender" required>
                        <option value="male" <?php echo $gender === "male"?"selected":"disabled"; ?>>Male</option>
                    <option value="female" <?php echo $gender === "female"?"selected":"disabled" ?>>Female</option>
                </select>
            </div>
            <div class="form-group  col-6 mx-3">
                <label for="type">Account Type</label>
                <select class="form-control" id="type" name="type" required>
                    <?php
                    if ($account_type == "customer") {
                        echo '<option value="customer" selected>Customer</option>';
                    } else {
                        echo '<option value="management" ' . ($account_type == "management" ? "selected" : "") . '>Management</option>';
                        echo '<option value="operation" ' . ($account_type == "operation" ? "selected" : "") . '>Operation</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-row my-3 add_item_row ">
            
            
        </div>

        <div class="form-row my-3 add_item_row ">
            <div class="form-group col-12">
                <div class="d-flex justify-content-end">
                    <a href="management_users.php" class="btn btn-danger mr-3">Cancel</a>
                    <input type="submit" class="btn btn-primary mx-3" name="add_submit" value="Add Staff">
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    document.getElementById('registrationForm').onsubmit = function(e) {
        var password = document.getElementById('password').value;

        var f_name = document.getElementById('first_name').value;
        var l_name = document.getElementById('last_name').value;
        
        var contact_no = document.getElementById('contact_number').value;
        var gender = document.getElementById("gender").value; 
        var account_type = document.getElementById("type").value; 
        // Regular expression to match only digits
        var numericRegex = /^\d+$/;
        var alphabeticRegex = /^[A-Za-z]+$/;

        // Check if first name and last name contain only alphabetic characters
        if (!alphabeticRegex.test(f_name) || !alphabeticRegex.test(l_name)) {
            e.preventDefault(); // Prevent form submission
            alert('First name and last name must contain only alphabetic characters.');
            return;
        }

        var specialCharRegex = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;

        if (password.length < 6) {
            e.preventDefault(); // Prevent form submission
            alert("Password must be at least 6 characters long");
            return false;
        }

        if (!specialCharRegex.test(password)) {
            e.preventDefault(); // Prevent form submission
            alert("Password must contain at least one special character");
            return false;
        }

        
        // Check if contact_no contains only digits and is between 8 and 15 characters
        if (!numericRegex.test(contact_no) || contact_no.length < 8 || contact_no.length > 15) {
            e.preventDefault(); // Prevent form submission
            alert('Contact number must contain only digits and be between 8 and 15 characters.');
            return;
        }
        if(gender=="none"){
            e.preventDefault(); // Prevent form submission
            alert('Please select a gender');
            return; 
        }account_type
        if(account_type=="none"){
            e.preventDefault(); // Prevent form submission
            alert('Please select an account type');
            return; 
        }

    };
    var today = new Date().toISOString().split('T')[0];
    document.getElementById("dob").setAttribute('max', today);
</script>
</body>
</html>