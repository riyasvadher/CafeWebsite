<?php 
include("../backend/MenuCard.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Café Bliss</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            <div class="row row-cols-1 row-cols-md-3 g-4">
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

            <form action="../backend/reservation.php" method="get">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
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
            </form>
        </div>
    </section>

    <section id="offers" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Special Offers</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="../images/Buy 1 Get 1 Free cofee poster .jpg" class="card-img-top" alt="Offer 1">
                        <div class="card-body">
                            <h5 class="card-title">Buy 1 Get 1 Free</h5>
                            <p class="card-text">Get a free coffee when you buy one of any size.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="../images/happyhour.jpg" class="card-img-top" alt="Offer 2">
                        <div class="card-body">
                            <h5 class="card-title">Happy Hour</h5>
                            <p class="card-text">Enjoy 50% off all desserts from 3 PM to 5 PM!</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="../images/Free Pastry with Every Drink poster .jpg" class="card-img-top" alt="Offer 3">
                        <div class="card-body">
                            <h5 class="card-title">Free Pastry with Every Drink</h5>
                            <p class="card-text">Free pastry with every hot drink purchase.</p>
                        </div>
                    </div>
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

    <div id="popup" class="alert alert-success position-fixed bottom-0 end-0 m-3" style="display: none;">
        <span id="popup-message"></span>
    </div>

    <script>
    $(document).ready(function () {
        const urlParams = new URLSearchParams(window.location.search);
        const message = urlParams.get('message');
        if (message) {
            $('#popup-message').text(message);
            $('#popup').fadeIn('slow', function () {
                setTimeout(function () {
                    $('#popup').fadeOut('slow');
                }, 3000);
            });

            const newURL = window.location.href.split('?')[0];
            history.replaceState({}, document.title, newURL);
        }
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>


