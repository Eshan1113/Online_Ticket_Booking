<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Booking Form HTML Template</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@200&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->

    <script src="https://kit.fontawesome.com/44f557ccce.js"></script>
    <title>Online Flight Booking</title>
    <style>
        /* Increase font size */
        .navbar-nav .nav-link {
            font-size: 20px;
            transition: color 0.3s;
            /* Smooth transition */
        }

        /* Make navbar transparent */
        .navbar {
            background-color: #ADDFFF;
            /* Change navbar background color */
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
            color: #ff7f50;
            /* Adjust the color as needed */
        }
    </style>
</head>

<div id="booking" class="section">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">FLY SYSTEM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item me-3">
                        <a class="nav-link active" aria-current="page" href="adminPage.php">Dashboard</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="filightadd.php">Add Flight</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="add_airline.php">Add Airlines</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="all_flights.php">List Flights</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="list_airlines.php">Manage Airlines</a>
                    </li>
                   
                </ul>
                <ul class="navbar-nav">
                    
                    
                    <li class="nav-item me-3">
                        <a class="btn btn-danger" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Custom JavaScript -->
    <script>
        // Function to switch between panels
        function switchPanel(panelId) {
            $('.dashboard, #addFlight, #listFlight, #manageAirlines').hide();
            $('#' + panelId).show();
        }



        // Form submission for adding airline
        $('#addAirlineForm').submit(function (event) {
            event.preventDefault();
            // Add your code to handle form submission (e.g., send data to backend)
            alert('Airline added successfully!');
        });

        // Initialize default panel (Dashboard)
        switchPanel('dashboard');
    </script>