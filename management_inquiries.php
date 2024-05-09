<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Inquiries</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px; /* Added margin to center the table */
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .first-row-margin {
            margin-left: 0.5%; 
        }
    </style>
</head>
<body id="background">
    <?php
        include("font.php");
        include('connection.php');
        session_start();
        try {
            if(isset($_SESSION["email"]) && isset($_SESSION["type"])) {
                if($_SESSION["type"] == "management") {
                    $email = $_SESSION['email'];
                    $user = $_SESSION['type'];
                } else {
                    echo '<script>alert("Unauthorised Access!");</script>';
                    echo '<script>window.location.href = "log_in.php";</script>';
                    exit();
                }
            } else {
                echo '<script>alert("Unauthorised Access!");</script>';
                echo '<script>window.location.href = "log_in.php";</script>';
                exit();
            }
        } catch(Exception $e) {
            // Handle exception
        }
    ?>

    <div class="container-fluid">
        <div class="row first-row-margin">
            <?php include("management_navbar.php")?>
            <div class="col-10 ">
                <div class="container">
                    <h2>Inquiries</h2>
                        <?php
                            $sql = "SELECT * FROM inquiries";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                echo "<table>";
                            echo "<tr><th>Inquiry ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Subject</th><th>Message</th><th>Created At</th><th>Resolved</th></tr>";
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>".$row["id"]."</td>";
                                echo "<td>".$row["name"]."</td>";
                                echo "<td>".$row["email"]."</td>";
                                echo "<td>".$row["phone"]."</td>";
                                echo "<td>".$row["subject"]."</td>";
                                echo "<td>".$row["message"]."</td>";
                                echo "<td>".$row["created_at"]."</td>";
                                $resolved = isset($_POST['resolved']) && in_array($row['id'], $_POST['resolved']) ? "checked" : "";
                                echo "<td><input type='checkbox' name='resolved[]' value='".$row["id"]."' $resolved onchange='updateResolvedState(this)'></td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                            } else {
                                echo "No inquiries found.";
                            }
                            mysqli_close($conn);
                        ?>
                    </div>
            </div>
        </div> 
    </div>

    <script>
        function updateResolvedState(checkbox) {
            const inquiryId = checkbox.value;
            const resolved = checkbox.checked;
            localStorage.setItem('inquiry_' + inquiryId, resolved);
        }

        function restoreResolvedState() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(function(checkbox) {
                const inquiryId = checkbox.value;
                const resolved = localStorage.getItem('inquiry_' + inquiryId);
                if (resolved === 'true') {
                    checkbox.checked = true;
                }
            });
        }

        window.onload = restoreResolvedState;
    </script>
</body>
</html>
