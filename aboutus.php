<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us Page</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        #our-story-section {
            padding: 50px 0;
            background-color: #f9f9f9;
        }

        #team-section .team-member {
            text-align: center; 
            margin-bottom: 30px; 
            }

        #team-section .team-member img {
            width: 150px; 
            height: 150px; 
            border-radius: 50%; 
            border: 2px solid #ddd; 
            margin-bottom: 15px;
            transition: transform 0.3s ease-in-out;
        }

        #team-section .team-member p {
            margin-bottom: 0; 
        }

        .service-box {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

    </style>
</head>
<body id="background">

    <?php
        include("font.php");
        include('connection.php');
        include("header.php");
    ?>

    <section id="our-story-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>About Us</h2>
                    <p>FoodEdge Gourmet Catering is a leading provider of food and beverage catering services in Kuching, specializing in corporate events, seminars, weddings, and various other occasions. With nearly 5 years of experience, FoodEdge is committed to delivering outstanding service, maintaining the highest standards of quality, safety, and health.</p>
                    <p>Whether catering for workplaces, schools, colleges, hospitals, leisure events, or remote environments, FoodEdge ensures an unforgettable dining experience for every event served. With a focus on excellence and attention to detail, FoodEdge aims to surpass expectations and provide unparalleled culinary delights for all occasions.</p>
                </div>
                <div class="col-md-6">
                    <h2>Our Services</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="service-box">Corporate Event Catering:
                                <p>Tailored catering solutions for corporate functions, including meetings, conferences, seminars, and office gatherings.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="service-box">Wedding Catering:
                                <p>Comprehensive catering services for weddings, ensuring that every aspect of the culinary experience matches the elegance and significance of the occasion.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="service-box">Seminar Catering:
                                <p>Customized catering packages designed to meet the unique needs of seminars, workshops, and training sessions, providing nourishing meals to fuel productivity and engagement.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="service-box">Special Events Catering:
                                <p>Versatile catering options for a variety of special events, such as birthdays, anniversaries, holiday parties, and celebrations, creating memorable dining experiences for guests to cherish.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="team-section">
    <div class="container">
        <h2>Our Team</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="team-member">
                    <img src="Images/web_resources/manager.png" alt="Manager" class="rounded-circle">
                    <p>Manager</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="team-member">
                    <img src="Images/web_resources/chef.png" alt="Head Chef" class="rounded-circle">
                    <p>Head Chef</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="team-member">
                    <img src="Images/web_resources/souschef.png" alt="Sous Chef" class="rounded-circle">
                    <p>Sous Chef</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="team-member">
                    <img src="Images/web_resources/cateringcoordinator.png" alt="Catering Coordinator" class="rounded-circle">
                    <p>Catering Coordinator</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="team-member">
                    <img src="Images/web_resources/eventplanner.png" alt="Event Planner" class="rounded-circle">
                    <p>Event Planner</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="team-member">
                    <img src="Images/web_resources/marketingcoordinator.png" alt="Marketing Coordinator" class="rounded-circle">
                    <p>Marketing Coordinator</p>
                </div>
            </div>
        </div>
    </div>
</section>

    <?php include("footer.php");?>

    <script>
        const teamMembers = document.querySelectorAll('.team-member img');
        teamMembers.forEach(member => {
            member.addEventListener('mouseover', () => {
                member.style.transform = 'scale(1.1)'; 
            });
            member.addEventListener('mouseleave', () => {
                member.style.transform = 'scale(1)'; 
            });
        });
    </script>

</body>
</html>

