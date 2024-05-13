<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Fly System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->

    <style>
        /* Add your custom CSS styles here */
        /* Increase font size */
        .navbar-nav .nav-link {
            font-size: 20px;
            transition: color 0.3s; /* Smooth transition */
        }
        
        /* Make navbar transparent */
        .navbar {
            background-color: #ADDFFF; /* Change navbar background color */
        }

        /* Adjust spacing between words */
        .navbar-brand,
        .navbar-nav .nav-link,
        .dropdown-menu .dropdown-item {
            padding-right: 15px; 
            padding-left: 15px; 
        }

        .bg-body-tertiary {
            background-color: #ADDFFF;
        }

        /* Change color on hover */
        .navbar-nav .nav-link:hover {
            color: #ff7f50; /* Adjust the color as needed */
        }
   
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">FLY SYSTEM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item me-3">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="#">Feedback</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item dropdown me-3">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Login
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="admin/admin.php">Admin</a></li>
                            <li><a class="dropdown-item" href="User/UserLogin.php">User</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- About Section with Background Image -->
    <section id="about" class="vh-100 py-5" style="background-image: url('img/background.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="display-4">About Fly System</h2>
                    <p class="lead">Fly System is a leading online platform for booking flights. We offer a wide range
                        of services including flight reservations, hotel bookings, car rentals, and more. Our mission is
                        to make travel easy, convenient, and affordable for everyone.</p>
                    <p>With Fly System, you can easily search for flights, compare prices, and book your tickets
                        securely. Whether you're planning a business trip, a family vacation, or a weekend getaway, we
                        have everything you need to make your journey a success.</p>
                    <p>Our team of travel experts is dedicated to providing you with the best possible experience. We
                        work tirelessly to ensure that you have access to the latest deals and promotions, as well as
                        helpful travel tips and advice.</p>
                </div>
                <div class="col-md-6">
                    <!-- Add an image related to your about section if desired -->
                    <!-- <img src="img/background.jpg" class="img-fluid rounded" alt="About Fly System"> -->
                </div>
            </div>
        </div>
    </section>
    <br>
    <br>
    <br>
    <br>
    

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
