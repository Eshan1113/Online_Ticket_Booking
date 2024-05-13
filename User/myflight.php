<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['UN'])) {
    header("Location: UserLogin.php");
    exit;
}

// Include the database connection file
include_once '../dbconnection.php';


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <title>Flight Search</title>
</head>
<style>
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
    body {
        background-image: url('../img/background.jpg');
        background-size: cover; /* This ensures that the background image covers the entire viewport */
        background-repeat: no-repeat; /* This prevents the background image from repeating */
    }

  </style>
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
                <ul class="navbar-nav me-auto">
                    <li class="nav-item me-2">
                        <a class="nav-link active" aria-current="page" href="UserDashbord.php">Home</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="my_flights.php">My Flights</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="ticket.php">Tickets</a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link" href="#">Feedback</a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item dropdown me-2">
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item me-2 ms-auto">
                        <a class="btn btn-success" href="UserDashbord.php">Back</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php
    $fid=
    include_once '../dbconnection.php';

    // Check if the form is submittedf
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $flyingFrom = $_POST['flying-from'];
        $flyingTo = $_POST['flying-to'];
        $departing = $_POST['departing'];
        $returning = isset($_POST['returning']) ? $_POST['returning'] : null; // Check if returning date is set
        $passenger = $_POST['passenger'];
        $travelClass = $_POST['travel-class'];

        $sql = "SELECT * FROM flight WHERE source = '$flyingFrom' AND Destination = '$flyingTo'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo '<br>';
            echo '<h1 class="display-4 text-center ">AVAILABLE FLIGHTS</h1>';
            echo '<br>';
            echo '<div class="container">';
            echo '<table class="table table-bordered table-hover" id="flight-table">';
            echo '<thead class="thead-dark">';
            echo '<tr><th>Airline</th><th>Departure</th><th>Arrival</th><th>Status</th><th>Fare</th><th>Buy</th></tr>';
            echo '</thead>';
            echo '<tbody>';
            while ($row = mysqli_fetch_assoc($result)) {
        
                echo '<tr>';
                echo '<td class="flight-name">' . $row["airline"] . '</td>';
                echo '<td>' . $row["departure"] . '</td>';
                echo '<td>' . $row["arrivale"] . '</td>';
                echo '<td>' . $row["status"] . '</td>';
                echo '<td>$' . $row["Price"] . '</td>';
             
                echo '<td><a href="pass_form.php?flight_id=' .$row["flight_id"]. '" class="btn btn-primary">Buy</a></td>';

                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
        } else {
            echo "No flights found";
        }

        // Close the database connection
        mysqli_close($conn);
    }
    ?>
    <script>
        // JavaScript to auto-populate flight ID based on selected flight name and fetch fare
        document.addEventListener("DOMContentLoaded", function () {
            const flightNameSelect = document.getElementById("flight-name");
            const flightIdInput = document.getElementById("flight-id");

            flightNameSelect.addEventListener("change", function () {
                // Assuming flight ID is stored as value in options
                flightIdInput.value = this.value;
                const selectedOption = this.options[this.selectedIndex];
                const fare = selectedOption.getAttribute("data-fare");
                // Assuming there's an input field for fare with id "fare"
                document.getElementById("fare").value = fare;
            });
        });
    </script>
</body>

</html>
