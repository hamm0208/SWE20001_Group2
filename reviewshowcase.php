<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Feedback Showcase</title>
    <link rel="stylesheet" href="styles.css"> <!-- Assuming you have a separate CSS file -->
    <style>
        /* Additional CSS for styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('Images/web_resources/background1.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .title-box {
            background-color: #000;
            padding: 10px 20px; /* Adjust padding as needed */
            border-radius: 8px; /* Add border radius for rounded corners */
        }
        .title-text {
            color: #fff;
            margin: 0; /* Remove default margin */
            font-weight: bold;
            text-align: center;
        }
        .testimonial-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            grid-gap: 20px;
            justify-items: center;
        }

        .testimonial {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: transform 0.3s ease;
            overflow: hidden;
        }

        .testimonial:hover {
            transform: translateY(-5px);
        }

        .testimonial-heading {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 20px;
            color: #333;
        }

        .rating-container {
            margin-bottom: 10px;
        }

        .rating-label {
            font-weight: bold;
            color: #555;
        }

        .rating {
            color: #FFD700;
            font-size: 24px;
        }

        .star {
            cursor: default;
        }

        .feedback {
            margin-top: 10px;
            color: #555;
        }

        .button-container {
            text-align: center;
            margin-top: 30px;
        }

        .btn-back,
        .btn-next {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-back:hover,
        .btn-next:hover {
            background-color: #555;
        }

        .btn-next {
            margin-left: 10px;
        }
    </style>
</head>
<body>

<header>
    <?php
        include 'header.php';
        include 'font.php';
    ?>
</header>

<div class="container">
    <div class="title-box">
        <h2 class="title-text">Customer Feedback Showcase</h2>
    </div>

    <div class="testimonial-container" id="testimonial-container">
        <?php
        // Include the database connection file
        include 'connection.php';

        // Define pagination variables
        $limit = 4; // Number of reviews per page
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number
        $offset = ($currentPage - 1) * $limit; // Offset for SQL query

        // SQL query to fetch feedback data with pagination
        $sql = "SELECT name, eventType, foodRating, serviceRating, feedback FROM feedback LIMIT $limit OFFSET $offset";

        // Execute the query
        $result = mysqli_query($conn, $sql);

        // Check if there are any results
        if (mysqli_num_rows($result) > 0) {
            // Output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="testimonial">
                    <h3 class="testimonial-heading"><?php echo $row["name"] . " - " . $row["eventType"]; ?></h3>
                    <div class="rating-container">
                        <p class="rating-label"><strong>Food Quality:</strong></p>
                        <div class="rating">
                            <?php
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $row["foodRating"]) {
                                    echo "<span class='star'>&#9733;</span>";
                                } else {
                                    echo "<span class='star'>&#9734;</span>";
                                }
                            }
                            ?>
                        </div>
                        <p class="rating-label"><strong>Service Quality:</strong></p>
                        <div class="rating">
                            <?php
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $row["serviceRating"]) {
                                    echo "<span class='star'>&#9733;</span>";
                                } else {
                                    echo "<span class='star'>&#9734;</span>";
                                }
                            }
                            ?>
                        </div>
                        <p class="feedback"><?php echo $row["feedback"]; ?></p>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>No feedback available.</p>";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </div>

    <div class="button-container">
        <?php
        // Display "Previous" button if current page is greater than 1
        if ($currentPage > 1) {
            echo "<a href='?page=" . ($currentPage - 1) . "' class='btn-back'>Previous</a>";
        }

        // Display "Next" button if there are more reviews
        if (mysqli_num_rows($result) == $limit) {
            echo "<a href='?page=" . ($currentPage + 1) . "' class='btn-next'>Next</a>";
        }

        // Display "Back to Home Page" button
        echo "<a href='index.php' class='btn-back'>Back to Home Page</a>";
        ?>
    </div>
</div>

<footer>
    <?php include 'footer.php'; ?>
</footer>

</body>
</html>
