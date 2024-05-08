<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('Images/web_resources/background.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: rgba(255, 255, 255, 0.8); /* Adding opacity to the container */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        textarea {
            resize: vertical;
        }
        .rating {
            display: flex;
            justify-content: center; /* Align stars in the middle */
            margin-bottom: 15px;
        }
        .rating input[type="radio"] {
            display: none;
        }
        .rating label {
            font-size: 30px;
            color: #ccc;
            cursor: pointer;
            transition: color 0.3s;
            margin: 0 3px; 
        }
        .rating input[type="radio"]:checked + label {
            color: #ffcc00;
        }
        .submit-btn {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }

        .submit-btn:hover {
            background-color: #45a049;
        }

        .btn-secondary {
            width: auto; 
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            background-color: #ccc; 
            color: #000; 
        }

        .btn-secondary:hover {
            background-color: #bbb; 
        }

    </style>
</head>
<body>

<?php
    include("font.php");
?>

<div class="container">
    <h2>Feedback Form</h2>
    <form id="feedbackForm" action="submit_feedback.php" method="post">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="eventType">Type of Event:</label>
            <select id="eventType" name="eventType" required>
                <option value="">Select...</option>
                <option value="Corporate Event Catering">Corporate Event Catering</option>
                <option value="Wedding Catering">Wedding Catering</option>
                <option value="Seminar Catering">Seminar Catering</option>
                <option value="Other Special Event Catering">Other Special Event Catering</option>
            </select>
        </div>
        <div class="form-group">
            <label>Food Quality:</label>
            <div class="rating">
                <input type="radio" id="foodStar1" name="foodRating" value="1">
                <label for="foodStar1">&#9733;</label>
                <input type="radio" id="foodStar2" name="foodRating" value="2">
                <label for="foodStar2">&#9733;</label>
                <input type="radio" id="foodStar3" name="foodRating" value="3">
                <label for="foodStar3">&#9733;</label>
                <input type="radio" id="foodStar4" name="foodRating" value="4">
                <label for="foodStar4">&#9733;</label>
                <input type="radio" id="foodStar5" name="foodRating" value="5">
                <label for="foodStar5">&#9733;</label>
            </div>
        </div>
        <div class="form-group">
            <label>Service Quality:</label>
            <div class="rating">
                <input type="radio" id="serviceStar1" name="serviceRating" value="1">
                <label for="serviceStar1">&#9733;</label>
                <input type="radio" id="serviceStar2" name="serviceRating" value="2">
                <label for="serviceStar2">&#9733;</label>
                <input type="radio" id="serviceStar3" name="serviceRating" value="3">
                <label for="serviceStar3">&#9733;</label>
                <input type="radio" id="serviceStar4" name="serviceRating" value="4">
                <label for="serviceStar4">&#9733;</label>
                <input type="radio" id="serviceStar5" name="serviceRating" value="5">
                <label for="serviceStar5">&#9733;</label>
            </div>
        </div>
        <div class="form-group">
            <label for="feedback">Feedback:</label>
            <textarea id="feedback" name="feedback" rows="5" required></textarea>
        </div>
        <div class="form-group">
            <input type="submit" value="Submit Feedback" class="submit-btn"> <a href="index.php" class="btn btn-secondary">Back to Home Page</a>
        </div>
    </form>
</div>

<script>
    // Add event listeners to each star radio button for food quality
    const foodStars = document.querySelectorAll('.rating input[name="foodRating"]');
    foodStars.forEach(star => {
        star.addEventListener('change', function() {
            foodStars.forEach(s => s.nextElementSibling.style.color = '#ccc');
            let selectedStar = this;
            while (selectedStar) {
                selectedStar.nextElementSibling.style.color = '#ffcc00';
                selectedStar = selectedStar.previousElementSibling;
            }
        });
    });

    // Add event listeners to each star radio button for service quality
    const serviceStars = document.querySelectorAll('.rating input[name="serviceRating"]');
    serviceStars.forEach(star => {
        star.addEventListener('change', function() {
            serviceStars.forEach(s => s.nextElementSibling.style.color = '#ccc');
            let selectedStar = this;
            while (selectedStar) {
                selectedStar.nextElementSibling.style.color = '#ffcc00';
                selectedStar = selectedStar.previousElementSibling;
            }
        });
    });
</script>

</body>
</html>
