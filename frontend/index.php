<?php
include "../backend/MenuCard.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Café Bliss</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../styles/styles.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Café Bliss</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="#menu">Menu</a></li>
                        <li class="nav-item"><a class="nav-link" href="#reservation">Reservations</a></li>
                        <li class="nav-item"><a class="nav-link" href="#offers">Offers</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section id="hero" class="hero-section text-center py-5">
        <div class="container">
            <h1 class="display-4">Welcome to Café Bliss</h1>
            <p class="lead">Your Daily Dose of Bliss. Enjoy freshly brewed coffee and delicious treats!</p>
        </div>
    </section>

    <section id="menu" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Our Menu</h2>
            <div class="menu-grid">
                <?php
                foreach ($menuItems as $menuItem) {
                    echo $menuItem->generateCardHTML();
                }
                ?>
            </div>
        </div>
    </section>


    <section id="reservation" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4">Reserve a Table</h2>

            <form action="../backend/reservation.php" method="get" id="reservation-form">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <!-- Pre-filling the Name field with a cookie value if it exists -->
                    <input type="text" class="form-control" id="name" name="name"
                        value="<?php echo isset($_COOKIE['user_name']) ? htmlspecialchars($_COOKIE['user_name']) : ''; ?>"
                        required>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Reservation Date</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>
                <div class="mb-3">
                    <label for="time" class="form-label">Reservation Time</label>
                    <input type="time" class="form-control" id="time" name="time" required>
                </div>
                <div class="mb-3">
                    <label for="guests" class="form-label">Number of Guests</label>
                    <input type="number" class="form-control" id="guests" name="guests" min="1" required>
                </div>
                <button type="submit" class="btn btn-primary">Reserve Now</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </form>


        </div>
    </section>

    <section id="offers" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Special Offers</h2>
            <div class="d-flex flex-wrap justify-content-center">
                <div class="offer-card">
                    <img src="../images/Buy 1 Get 1 Free cofee poster .jpg" alt="Offer 1">
                    <h5>Buy 1 Get 1 Free</h5>
                    <p>Get a free coffee when you buy one of any size.</p>
                </div>
                <div class="offer-card">
                    <img src="../images/happyhour.jpg" alt="Offer 2">
                    <h5>Happy Hour</h5>
                    <p>Enjoy 50% off all desserts from 3 PM to 5 PM!</p>
                </div>
                <div class="offer-card">
                    <img src="../images/Free Pastry with Every Drink poster .jpg" alt="Offer 3">
                    <h5>Free Pastry with Every Drink</h5>
                    <p>Free pastry with every hot drink purchase.</p>
                </div>
            </div>
        </div>
    </section>


    <footer id="contact" class="py-5 text-white">
        <div class="container text-center">
            <h2>Contact Us</h2>
            <p>Email: info@cafebliss.com | Phone: (123) 456-7890</p>
        </div>
    </footer>
    <!-- Add a container for the success/failure message -->
    <div id="popup-message" class="popup-message" style="display:none;">
        <div id="popup-content" class="popup-content"></div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- adding script for the animation -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Function to handle the reservation form submission
        $(document).ready(function() {
            $('form').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission

                var formData = $(this).serialize(); // Serialize form data

                $.ajax({
                    url: '../backend/reservation.php', // PHP script to handle the reservation
                    type: 'GET', // Using GET for simplicity, you can switch to POST if needed
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        // Show the success/error message with animation
                        if (response.status === 'success') {
                            $('#popup-content').text(response.message);
                            $('#popup-message').removeClass('error').addClass('success');

                            // Reset the form on successful submission
                            $('#reservation-form')[0].reset();
                        } else {
                            $('#popup-content').text(response.message);
                            $('#popup-message').removeClass('success').addClass('error');
                        }

                        // Display the popup and animate it
                        $('#popup-message').fadeIn(500).delay(3000).fadeOut(500);
                    },
                    error: function() {
                        $('#popup-content').text('There was an error with your reservation. Please try again.');
                        $('#popup-message').removeClass('success').addClass('error');
                        $('#popup-message').fadeIn(500).delay(3000).fadeOut(500);
                    }
                });
            });
        });
    </script>


</body>

</html>