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

    <title>List of city</title>
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
.city {
    font-size: 24px;
}
p {
    margin-bottom: 10px;
    font-family: product sans;
}
.alert {
    
    font-weight: bold;
}
.date {
    font-size: 24px;
}
.time {
    font-size: 27px;
    margin-bottom: 0px;
}
.stat {
    font-size: 17px;
}
h1 {
    font-weight: lighter !important;
    font-size: 45px !important;
    margin-bottom: 20px;  
    font-family :'product sans' !important;
    font-weight: bolder;
  }
.row {
    background-color: white;
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
        <h1 class="text-center text-black mt-4 mb-4">FLIGHT STATUS</h1>
        <main>
  
    <?php 
    $stmt_t = mysqli_stmt_init($conn);
    $sql_t = 'SELECT * FROM Ticket WHERE user_id=?';
    $stmt_t = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt_t,$sql_t)) {
        header('Location: ticket.php?error=sqlerror');
        exit();            
    } else {
        mysqli_stmt_bind_param($stmt_t,'i',$_SESSION['ID']);            
        mysqli_stmt_execute($stmt_t);
        $result_t = mysqli_stmt_get_result($stmt_t);
        while($row_t = mysqli_fetch_assoc($result_t)) {     
            $stmt = mysqli_stmt_init($conn);
            $sql = 'SELECT * FROM Passenger_profile WHERE passenger_id=?';
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql)) {
                header('Location: my_flights.php?error=sqlerror');
                exit();            
            } else {
                mysqli_stmt_bind_param($stmt,'i',$row_t['passenger_id']);            
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if ($row = mysqli_fetch_assoc($result)) {
                    $sql_f = 'SELECT * FROM Flight WHERE flight_id=? ';
                    $stmt_f = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt_f,$sql_f)) {
                        header('Location: my_flights.php?error=sqlerror');
                        exit();            
                    } else {
                        mysqli_stmt_bind_param($stmt_f,'i',$row_t['flight_id']);            
                        mysqli_stmt_execute($stmt_f);
                        $result_f = mysqli_stmt_get_result($stmt_f);
                        if($row_f = mysqli_fetch_assoc($result_f)) {
                            $date_time_dep = $row_f['departure'];
                            $date_dep = substr($date_time_dep,0,10);
                            $time_dep = substr($date_time_dep,10,6) ;    
                            $date_time_arr = $row_f['arrivale'];
                            $date_arr = substr($date_time_arr,0,10);
                            $time_arr = substr($date_time_arr,10,6) ;      
                            if($row_f['status'] === '') {
                                $status = "Not yet Departed";
                                $alert = 'alert-primary';
                            } else if($row_f['status'] === 'dep') {
                                $status = "Departed";
                                $alert = 'alert-info';
                            } else if($row_f['status'] === 'issue') {
                                $status = "Delayed";
                                $alert = 'alert-danger';
                            } else if($row_f['status'] === 'arr') {
                                $status = "Arrived";
                                $alert = 'alert-success';
                            }                           
                            echo '
                            <div class="row out mb-5 ">
                                <div class="col-md-4 order-lg-3 order-md-1"> ';    
                                if($row_f['status'] === 'arr') {
                                    echo '
                                    <div class="row">
                                        <div class="col-1 p-0 m-0">
                                            <i class="fa fa-circle mt-4 text-success"
                                                style="float: right;"></i>
                                        </div>                            
                                        <div class="col-10 p-0 m-0 mt-3" style="float: right;">
                                            <hr class="bg-success">
                                        </div>                            
                                        <div class="col-1 p-0 m-0">
                                            <i class="fa fa-2x fa-fighter-jet mt-3 text-success"
                                                ></i>
                                        </div>                                    
                                    </div>                            
                                    ';
                                } else {
                                    echo '
                                    <div class="row">
                                        <div class="col-1 p-0 m-0">
                                            <i class="fa fa-2x fa-fighter-jet mt-3 text-success"
                                                style="float: right;"></i>
                                        </div>
                                        <div class="col-10 p-0 m-0 mt-3" style="float: right;">
                                            <hr style="background-color: lightgrey;">
                                        </div>   
                                        <div class="col-1 p-0 m-0">
                                            <i class="fa fa-circle mt-4"
                                                style="color: lightgrey;"></i>
                                        </div>                             
                                    </div>                            
                                    ';
                                }                     
                                    echo '
                                </div>
                        
                                <div class="col-md-3 col-6 order-md-2 pl-0 text-center 
                                    order-lg-2 card-dep">
                                    <p class="city">'.$row_f['source'].'</p>
                                    <p class="stat">Scheduled Departure:</p>
                                    <p class="date">'.$date_dep.'</p>                
                                    <p class="time">'.$time_dep.'</p>
                                </div>        
                                <div class="col-md-3 col-6 order-md-4 pr-0 text-center 
                                    order-lg-4 card-arr" 
                                    style="float: right;">
                                    <p class="city">'.$row_f['Destination'].'</p>
                                    <p class="stat">Scheduled Arrival:</p>
                                    <p class="date">'.$date_arr.'</p>                
                                    <p class="time">'.$time_arr.'</p>          
                                </div>
                                <div class="col-lg-2 order-md-12">
                                    <div class="alert '.$alert.' mt-5 text-center" 
                                        role="alert">
                                        '.$status.'
                                    </div>
                                </div>          
                            </div> ';                     
                        }
                    }            
                }
            }    
        }
    }
    ?>    
</div>

</main>      

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