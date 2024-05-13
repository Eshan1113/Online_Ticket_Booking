<?php
// Start the session
session_start();

// Check if the session variables are set
if (!isset($_SESSION['UN'])) {
    header("Location: UserLogin.php");
}
include_once '../dbconnection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link
        href='//fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,700,700italic,800,800italic'
        rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css2?family=Italianno&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/44f557ccce.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="../css/style.css" />

    <style>
        @font-face {
            font-family: 'product sans';
            src: url('assets/css/Product Sans Bold.ttf');
        }

        h2.brand {
            /* font-style: italic; */
            font-size: 27px !important;
        }

        .vl {
            border-left: 6px solid #424242;
            height: 400px;
        }

        .text-light2 {
            color: #d9d9d9;
        }

        h3 {
            /* font-weight: lighter !important; */
            font-size: 21px !important;
            margin-bottom: 20px;
            font-family: Tahoma, sans-serif;
            font-weight: lighter;
        }

        p.head {
            text-transform: uppercase;
            font-family: arial;
            font-size: 17px;
            margin-bottom: 10px;
            color: grey;
        }

        p.txt {
            text-transform: uppercase;
            font-family: arial;
            font-size: 25px;
            font-weight: bolder;
        }

        .bord {
            border: 2px solid lightgray;
            /* border-left: 0px !important; */
        }

        .out {
            /* box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);   */
            background-color: white;
            padding-left: 25px;
            padding-right: 0px;
            padding-top: 20px;
            border: 2px solid lightgray;
            border-top-left-radius: 25px;
            border-bottom-left-radius: 25px;
        }

        h2 {
            font-weight: lighter !important;
            font-size: 35px !important;
            margin-bottom: 20px;
            font-family: 'product sans' !important;
            font-weight: bolder;
        }

        h1 {
            font-weight: lighter !important;
            font-size: 45px !important;
            margin-bottom: 20px;
            font-family: 'product sans' !important;
            font-weight: bolder;
        }

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
        .text-black {
    color: black;
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
                            <a class="nav-link" href="about.php">About</a>
                        </li>
                        <li class="nav-item dropdown me-2">
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item me-2 ms-auto">
                            <!-- Added ms-auto class to move logout button to the right -->
                            <a class="btn btn-danger" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container mb-5">
        <h1 class="text-center text-black mt-4 mb-4">E-TICKETS</h1>
            <?php
            // Check if the form was submitted
            if (isset($_POST['cancel_but'])) {
                // Get the ticket ID from the POST request
                $ticket_id = $_POST['ticket_id'];

                // Prepare and execute the DELETE statement
                $stmt = mysqli_stmt_init($conn);
                $sql = 'DELETE FROM ticket WHERE ticket_id = ?';

                if (mysqli_stmt_prepare($stmt, $sql)) {
                    mysqli_stmt_bind_param($stmt, 'i', $ticket_id); // Bind the ticket_id parameter
                    mysqli_stmt_execute($stmt); // Execute the DELETE statement
            
                    // Check if the ticket was successfully deleted
                    if (mysqli_stmt_affected_rows($stmt) > 0) {
                        echo "<div class='alert alert-success'>Ticket successfully canceled.</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Failed to cancel the ticket.</div>";
                    }

                    mysqli_stmt_close($stmt); // Close the statement
                } else {
                    echo "Error preparing SQL statement: " . mysqli_error($conn);
                }
            }
            ?>

            <?php
            $UID = $_SESSION['ID'];
            // Query to fetch all records from the source table
            $sql = "SELECT * FROM ticket WHERE user_id=$UID"; // Replace 'source_table' with your table name
            $result = mysqli_query($conn, $sql);

            // Check for errors in query execution
            if (!$result) {
                echo "Error executing query: " . mysqli_error($conn);
                exit;
            }

            // Fetch and process all records in a while loop
            while ($row = mysqli_fetch_assoc($result)) {
                // Perform any operations you need with the data
                // For example, inserting into another table
            
                $passenger_id = $row['passenger_id'];
                $flight_id = $row['flight_id'];
                $user_id = $row['user_id'];

                ?>
                <div class="row mb-5">
                    <div class="col-8 out">
                        <div class="row ">
                            <div class="col">
                                <h2 class="text-secondary mb-0 brand">
                                    Online Flight Booking</h2>
                            </div>
                            <div class="col">
                                <h2 class="mb-0">ECONOMY CLASS</h2>
                            </div>
                        </div>
                        <hr>
                        <?php
                        // Query to fetch all records from the source table
                        $sql2 = "SELECT airline,source,Destination,DATE(departure) as departureDATE,TIME(departure) as departureTIME, DATE(arrivale) as arrDATE, TIME(arrivale) as arrTIME FROM flight WHERE flight_id=$flight_id"; // Replace 'source_table' with your table name
                        $result2 = mysqli_query($conn, $sql2);

                        // Check for errors in query execution
                        if (!$result2) {
                            echo "Error executing query: " . mysqli_error($conn);
                            exit;
                        }

                        // Fetch and process all records in a while loop
                        while ($row = mysqli_fetch_assoc($result2)) {
                            // Perform any operations you need with the data
                            // For example, inserting into another table
                    
                            $airline = $row['airline'];
                            $source = $row['source'];
                            $des = $row['Destination'];
                            $departureDATE = $row['departureDATE'];
                            $departureTIME = $row['departureTIME'];
                            $arrDATE = $row['arrDATE'];
                            $arrTIME = $row['arrTIME'];

                            ?>
                            <div class="row mb-3">
                                <div class="col-4">
                                    <p class="head">Airline</p>
                                    <p class="txt"><?php echo ($airline); ?></p>
                                </div>
                                <div class="col-4">
                                    <p class="head">from</p>
                                    <p class="txt"><?php echo ($source); ?></p>
                                </div>
                                <div class="col-4">
                                    <p class="head">to</p>
                                    <p class="txt"><?php echo ($des); ?></p>
                                </div>
                            </div>

                            <?php
                            // Query to fetch all records from the source table
                            $sql3 = "SELECT * FROM passenger_profile WHERE passenger_id=$passenger_id"; // Replace 'source_table' with your table name
                            $result3 = mysqli_query($conn, $sql3);

                            // Check for errors in query execution
                            if (!$result3) {
                                echo "Error executing query: " . mysqli_error($conn);
                                exit;
                            }

                            // Fetch and process all records in a while loop
                            while ($row = mysqli_fetch_assoc($result3)) {
                                // Perform any operations you need with the data
                                // For example, inserting into another table
                    
                                $fname = $row['f_name'];
                                $lname = $row['l_name'];

                                ?>
                                <div class="row mb-3">
                                    <div class="col-8">
                                        <p class="head">Passenger</p>
                                        <p class=" h5 text-uppercase">
                                            <?php echo ($fname . " " . $lname); ?>
                                        </p>
                                    </div>
                                    <div class="col-4">
                                        <p class="head">board time</p>
                                        <p class="txt">12:45</p>
                                    </div>
                                </div>
                                <?php
                            }

                            ?>
                            <div class="row">
                                <div class="col-3">
                                    <p class="head">departure</p>
                                    <p class="txt mb-1"><?php echo ($departureDATE); ?></p>
                                    <p class="h1 font-weight-bold mb-3"><?php echo ($departureTIME); ?></p>
                                </div>
                                <div class="col-3">
                                    <p class="head">arrival</p>
                                    <p class="txt mb-1"><?php echo ($arrDATE); ?></p>
                                    <p class="h1 font-weight-bold mb-3"><?php echo ($arrTIME); ?></p>
                                </div>
                                <div class="col-3">
                                    <p class="head">gate</p>
                                    <p class="txt">A22</p>
                                </div>
                                <div class="col-3">
                                    <p class="head">seat</p>
                                    <p class="txt">21A</p>
                                </div>
                            </div>
                            <?php
                        }

                        ?>
                    </div>
                    <div class="col-3 pl-0" style="background-color:#376b8d !important;
                            padding:20px; border-top-right-radius: 25px; border-bottom-right-radius: 25px;">
                        <div class="row">
                            <div class="col">
                                <h2 class="text-light text-center brand">
                                    Online Flight Booking</h2>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <img src="../img/Untitled.jpeg" class="mx-auto d-block" height="200px" width="200px" alt="">
                            </div>
                        </div>
                        <div class="row">
                            <h3 class="text-light2 text-center mt-2 mb-0">
                                &nbsp; Thank you for choosing us. <br> <br>
                                Please be at the gate at boarding time</h3>
                        </div>
                    </div>

                    <div class="col-1">
                        <div class="dropdown">
                            <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                            </button>
                            <div class="dropdown-menu">
                                <form class="px-4 py-3" action="ticket.php" method="post">
                                    <!-- Pass the ticket_id to the server -->
                                    <input type="hidden" name="ticket_id" value="10">
                                    <button class="btn btn-danger btn-sm" name="cancel_but">
                                        <i class="fa fa-trash" aria-hidden="true"></i> &nbsp; Cancel Ticket
                                    </button>
                                </form>

                                <form class="px-4 py-3" action="#" method="post" onsubmit="return printTicket();">
                                    <!-- Hidden field to pass ticket ID -->
                                    <input type="hidden" name="ticket_id" value="10">

                                    <!-- Button that triggers the print action -->
                                    <button class="btn w-100 mb-3 btn-primary btn-sm" name="print_but">
                                        <i class="fa fa-print" aria-hidden="true"></i> &nbsp; Print Ticket
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }

            // Close the database connection
            mysqli_close($conn);
            ?>

        </div>
    </div>

    <!-- JavaScript Function to Handle Print -->
    <script>
        function printTicket() {
            // Call the browser's print function
            window.print();

            // Return false to prevent form submission
            return false;
        }
    </script>
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
</body>

</html>