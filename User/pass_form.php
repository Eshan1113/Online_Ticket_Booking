<?php
session_start();

include_once '../dbconnection.php';
// $flight_id = isset($_SESSION['flight_id']) ? $_SESSION['flight_id'] : null;
$fid = $_GET['flight_id'];



if (isset($_POST['pass_btn'])) {

    $mobile = $_POST['mobile'];
    $dob = $_POST['dob'];
    $f_name = $_POST['f_name'];
    $m_name = $_POST['m_name'];
    $l_name = $_POST['l_name'];

    if (isset($_SESSION['UN'])) {
        $user_id = $_SESSION['ID'];

        $sql = "INSERT INTO passenger_profile (user_id, flight_id, mobile, dob, f_name, m_name, l_name) VALUES ('$user_id', '$fid', '$mobile', '$dob', '$f_name', '$m_name', '$l_name')";

        if (mysqli_query($conn, $sql)) {
            header("Location: payment.php?flight_id=$fid");
            exit;
        } else {
            echo mysqli_error($conn);
        }
    } else {
        echo "Error: User ID not found in session";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Booking Form HTML Template</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!-- Bootstrap -->

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
            background-size: cover;
            /* This ensures that the background image covers the entire viewport */
            background-repeat: no-repeat;
            /* This prevents the background image from repeating */
        }
    </style>

</head>

<body>
    <div id="booking" class="section">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">FLY SYSTEM</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav me-auto"> <!-- Added me-auto class to move other nav items to the left -->
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
                            <a class="nav-link" href="../../about.php">About</a>
                        </li>
                        <li class="nav-item dropdown me-2">
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item me-2 ms-auto">
                            <a class="btn btn-success" href="myflight.php">Back</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <br>
            <h1 class="display-4 text-center ">Passenger Details</h1>
            <form method="POST">
                <input type="text" value="<?php echo ($fid); ?>" name="fid" hidden>
                <div class="mb-3">
                    <label for="mobile" class="form-label">Mobile Number</label>
                    <input type="text" class="form-control" id="mobile" name="mobile" required>
                </div>
                <div class="mb-3">
                    <label for="dob" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="dob" name="dob" required>
                </div>
                <div class="mb-3">
                    <label for="f_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="f_name" name="f_name" required>
                </div>
                <div class="mb-3">
                    <label for="m_name" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" id="m_name" name="m_name">
                </div>
                <div class="mb-3">
                    <label for="l_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="l_name" name="l_name" required>
                </div>
                <button type="submit" name="pass_btn" class="btn btn-primary">Submit</button>
            </form>
        </div>
</body>

</html>