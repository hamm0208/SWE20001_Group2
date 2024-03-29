<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Items</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    
</head>
<body id="background">
    <?php
        include("font.php");
        include('connection.php');

    ?>
    <script>
        function updateFileName(input) {
            var fileName = input.files[0].name;
            var fileNameElement = document.getElementById('file-name');
            fileNameElement.textContent = fileName;
        }
    </script>
    <div class="container border rounded mt-3 p-2">
    <h2>Add Item</h2>
    <form action="management_addItem.php" method="POST" enctype="multipart/form-data">
        <div class="form-row mt-3 test ">
            <div class="form-group col-md-8 mb-3">
                <label for="name">Item Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            
        </div>
        <div class="form-row test ">
            <div class="form-group col-md-6 mb-2">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
            </div>
            <div class="form-group col-md-6mb-2">
                <label for="stock_count">Stock Count</label>
                <input type="number" class="form-control" id="stock_count" name="stock_count" required>
            </div>
        </div>
        <div class="form-row mt-3 test ">
            <div class="form-group col-md-4 mb-2">
                <label for="type">Type</label>
                <select class="form-control" id="type" name="type" required>
                    <option value="food">Food</option>
                    <option value="beverage">Beverage</option>
                </select>
            </div>
            <div class="form-group col-md-6 mb-2">
                <label for="category">Category</label>
                <select class="form-control" id="category" name="category" required>
                    <option value="western">Western</option>
                    <option value="malaysian">Malaysian</option>
                    <option value="korean">Korean</option>
                    <option value="japanese">Japanese</option>
                </select>
            </div>
            <div class="form-group col-md-6 mx-3 mb-2">
                <label for="image" class="upload-btn">
                    Upload Item Image<br>
                    <img src="Images/web_resources/upload-image.png" alt="Upload Image" class="img-fluid" id="preview-image">
                    <input type="file" id="image" name="image" accept="image/*" required onchange="updateFileName(this)">
                </label>
                <p id="file-name" class="file-name"></p>
            </div>
        </div>
        <div class="form-row mt-3 test ">
            <div class="form-group col-md-12 mb-3">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
            </div>
        </div>
        
        <a href="management_manageInventory.php" class="btn btn-danger">Cancel</a>
        <input type="submit" class="btn btn-primary" name="add_submit" value="Add Item">
        
    </form>
</div>

</body>
</html>