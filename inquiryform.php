<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquiry Form</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('Images/web_resources/background2.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            color: #555;
        }
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            margin-top: 5px;
        }
        textarea {
            resize: vertical;
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .form-control:focus {
            border-color: #4caf50;
            box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.25);
        }
    </style>
</head>
<body>

<header>
    <?php include 'header.php'; ?>
</header>

<?php include 'font.php'; ?>

<div class="container">
    <h2>Send Us Your Inquiry! 😊</h2>
    <form id="inquiryForm" action="submit_inquiry.php" method="post">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" class="form-control" pattern="[0-9]{10}" title="Please enter a valid 10-digit phone number" required>
            <small class="form-text text-muted">Please enter a 10-digit phone number without any spaces or special characters.</small>
        </div>
        <div class="form-group">
            <label for="subject">Subject:</label>
            <select id="subject" name="subject" class="form-control" required onchange="toggleCustomSubject()">
                <option value="">Select Subject</option>
                <option value="General Inquiry">General Inquiry</option>
                <option value="Product Information Request">Product Information Request</option>
                <option value="Service Inquiry">Service Inquiry</option>
                <option value="Technical Support">Technical Support</option>
                <option value="Partnership Opportunities">Partnership Opportunities</option>
                <option value="Billing or Payment Inquiry">Billing or Payment Inquiry</option>
                <option value="Website Feedback">Website Feedback</option>
                <option value="Employment Opportunities">Employment Opportunities</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea id="message" name="message" class="form-control" rows="5" required></textarea>
        </div>
        <div class="form-group">
            <input type="submit" value="Submit Inquiry" class="btn btn-success btn-block">
        </div>
    </form>
</div>

<footer>
    <?php include 'footer.php'; ?>
</footer>

<script>
    document.getElementById('inquiryForm').addEventListener('submit', function(event) {
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const subject = document.getElementById('subject').value.trim();
        const message = document.getElementById('message').value.trim();

        if (name === '' || email === '' || subject === '' || message === '') {
            event.preventDefault();
            alert('Please fill in all fields.');
        }
    });
</script>

</body>
</html>
