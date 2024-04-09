<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        
        #carousel-section {
            background-color: #f0f0f0; 
            height: 50%; 
            overflow: hidden; 
        }

        .carousel-image-container {
            width: 100%; 
            height: 100%; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
        }

        .carousel-item img {
        height: 100%; 
        width: 100%; 
        object-fit: contain; 
        }

        #info-section {
            display: flex;
            align-items: center;
            padding: 20px;
        }

        #info-section .left-content {
            flex: 1;
        }

        #info-section .right-content img {
            max-width: 100%; 
            height: auto; 
            width: 200px; 
            height: auto; 
            margin-left: auto;
        }

    </style>
</head>
<body id="background">

    <?php
        include("font.php");
        include('connection.php');
        include("header.php");
    ?>

    <section id="carousel-section">
        <div id="carousel-container">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel"> 
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="carousel-image-container">
                            <img src="Images/web_resources/banner1.png" class="d-block img-fluid" alt="Banner 1">
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="carousel-image-container">
                            <img src="Images/web_resources/banner2.png" class="d-block img-fluid" alt="Banner 2">
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="carousel-image-container">
                            <img src="Images/web_resources/banner3.png" class="d-block img-fluid" alt="Banner 3">
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="carousel-image-container">
                            <img src="Images/web_resources/banner4.png" class="d-block img-fluid" alt="Banner 4">
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="carousel-image-container">
                            <img src="Images/web_resources/banner5.png" class="d-block img-fluid" alt="Banner 5">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="info-section">
        <div class="left-content">
        <h2>Welcome to FoodEdge Gourmet Catering!</h2>
        <p>
            At FoodEdge, we bring the flavors of culinary excellence to your fingertips, ensuring every event is a delectable experience. With a passion for quality ingredients and innovative recipes, we specialize in crafting unforgettable dining experiences for all occasions.
        </p>
        <p>
            From corporate luncheons to extravagant weddings, our team of talented chefs and event planners work tirelessly to exceed your expectations. We offer a diverse range of menu options, spanning from exquisite hors d'oeuvres to decadent desserts, all meticulously curated to tantalize your taste buds.
        </p>
        <a href="menu.php" class="btn btn-primary">Order Now</a>
    </div>
        <img src="Images/web_resources/salad.png" alt="salad">
    </div>

    <?php include("footer.php");?>

    <script>
        // Auto-rotate carousel every 5 seconds
        var carousel = document.querySelector('.carousel');
        var carouselItems = carousel.querySelectorAll('.carousel-item');
        var currentSlide = 0;

        setInterval(function() {
            carouselItems[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % carouselItems.length;
            carouselItems[currentSlide].classList.add('active');
        }, 5000);
    </script>
</body>
</html>

