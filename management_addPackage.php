<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Packages</title>
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
    ?>
    <script>
        function updateFileName(input) {
            var fileName = input.files[0].name;
            var fileNameElement = document.getElementById('file-name');
            fileNameElement.textContent = fileName;
        }
    </script>
    <div class="container border rounded mt-3 p-2  add-item-container">
    <h2 class="text-center fira-sans-black">Add Packages</h2>
    <form action='add_package.php' method="POST" enctype="multipart/form-data">
        <div class="form-row add_item_row ">
            <div class="form-group col-12 ">
                <label for="packageName">Package Name</label>
                <input type="text" class="form-control" id="packageName" name="packageName"  style="width:101%" required>
            </div>
            
            
        </div>
        <div class="form-row add_item_row mt-3">
            <div class="form-group col-6">
                <label for="price">Price</label>
                <input type="number" class="form-control" placeholder="0" id="price" name="price"  value='0' min='0' required>
            </div>
            <div class="form-group mx-3 col-6">
                <label for="type">Availability</label>
                <select class="form-control" id="type" name="type" required>
                    <option value="1">Available</option>
                    <option value="0">Not Available</option>
                </select>
            </div>
        </div>
        <div class="form-row mt-3 add_item_row ">
            <div class="form-group col-6">
                <label for="category" class='fs-4'>Items in package</label>
                <div class='p-0'>
                    <div class="row">
                        <div class="col">
                        <?php
                            $sql = "SELECT * FROM inventory where type = 'Food'";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    $item_id = $row['id']; // Assuming you have an ID for each item in the database
                                    $item_name = $row['name'];
                                    echo "<div class='form-group my-2'>";
                                    echo "<label for='quantity_$item_id'>$item_name</label>";
                                    echo "<div class='input-group'>";
                                    echo "<span class='input-group-text'>Quantity</span>";
                                    echo "<input class='form-control' type='number' name='items[$item_id][quantity]' id='quantity_$item_id' value='0' min='0'>";
                                    echo "<div class='input-group-append'>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                            }
                        ?>
                        </div>
                        <div class="col">
                        <?php
                            $sql = "SELECT * FROM inventory where type = 'Beverage'";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    $item_id = $row['id']; // Assuming you have an ID for each item in the database
                                    $item_name = $row['name'];
                                    echo "<div class='form-group'>";
                                    echo "<label for='quantity_$item_id'>$item_name</label>";
                                    echo "<div class='input-group'>";
                                    echo "<span class='input-group-text'>Quantity</span>";
                                    echo "<input class='form-control' type='number' name='items[$item_id][quantity]' id='quantity_$item_id' value='0' min='0'>";
                                    echo "<div class='input-group-append'>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                            }
                        ?>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="form-group  col-6 mx-3">
                    <label for="image" class="upload-btn">
                        Upload Item Image<br>
                        <img src="Images/web_resources/upload-image.png" alt="Upload Image" class="img-fluid" id="preview-image">
                        <input type="file" id="inputImage" name="image" accept="image/*" required onchange="updateFileName(this)">
                    </label>
                    <p id="file-name" class="file-name"></p>
                </div>
            </div>

            <div class="form-row my-3 add_item_row ">
                <div class="form-group col-12">
                    <div class="d-flex justify-content-end">
                        <input type="submit" class="btn btn-primary mx-3" name="add_submit" value="Add Package">
                        <a href="management_packages.php" class="btn btn-danger mr-3">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>