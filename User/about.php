<?php
session_start();

// Redirect if session variable is not set
if (!isset($_SESSION['UN'])) {
    header("Location: UserLogin.php");
    exit();
}

include_once '../dbconnection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Fly System</title>

    <!-- Bootstrap and CSS links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            
        }
        
        /* Navbar styling */
        .navbar {
            
        }
        .navbar-nav .nav-link {
            font-size: 18px;
            transition: color 0.3s;
        }
        .navbar-nav .nav-link:hover {
            color: #ff7f50;
        }

        /* About section styling */
        #about {
            background-image: url('../img/background.jpg');
            background-size: cover;
            background-position: center;
            color: #333;
        }
        .container {
            padding-top: 50px;
        }
        .lead {
            font-size: 1.2rem;
        }
        
        /* Animations for text */
        h2 {
            font-size: 2.5rem;
            animation: fadeIn 1.5s;
        }
        p {
            animation: fadeIn 2s;
        }

        /* Animation keyframes */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Additional styling */
        .container {
            text-align: center;
        }
        .section {
            padding: 20px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">FLY SYSTEM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="UserDashbord.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="my_flights.php">My Flights</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ticket.php">Tickets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Feedback</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="btn btn-danger" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- About section -->
    <section id="about" class="vh-100 py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>About Fly System</h2>
                    <p class="lead">Fly System is a leading online platform for booking flights. We offer a wide range of services including flight reservations, hotel bookings, car rentals, and more. Our mission is to make travel easy, convenient, and affordable for everyone.</p>
                    <p>With Fly System, you can easily search for flights, compare prices, and book your tickets securely. Whether you're planning a business trip, a family vacation, or a weekend getaway, we have everything you need to make your journey a success.</p>
                    <p>Our team of travel experts is dedicated to providing you with the best possible experience. We work tirelessly to ensure that you have access to the latest deals and promotions, as well as helpful travel tips and advice.</p>
                </div>
                <div class="col-md-6">
                    <!-- Image placeholder if required -->
                    <!-- <img src="img/sample.jpg" class="img-fluid rounded" alt="About Fly System"> -->
                </div>
            </div>
        </div>
    </section>

    <!-- JavaScript dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
