<!DOCTYPE html>
<html lang="en">
<?php include_once 'dbconnection.php'?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Booking </title>
 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
  <!-- Bootstrap -->
  <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

  <!-- Custom stlylesheet -->
  <link type="text/css" rel="stylesheet" href="css/style.css" />

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

<body>


<div id="booking" class="section">
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.html">FLY SYSTEM</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item me-3">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link" href="#">Feedback</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link" href="about.php">About</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
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

</nav>

  

  <div class="section-center">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="booking-cta">
            <h1>Book your flight today</h1>
            <p>
            </p>
          </div>
        </div>
        <div class="col-md-7 col-md-offset-1">
          <div class="booking-form">
            <form method="POST" action="book_flight.php">
              <div class="form-group">
                <div class="form-checkbox">
                  <label for="roundtrip">
                    <input type="radio" id="roundtrip" name="flight-type" value="roundtrip" checked>
                    <span></span>Roundtrip
                  </label>
                  <label for="one-way">
                    <input type="radio" id="one-way" name="flight-type" value="one-way">
                    <span></span>One way
                  </label>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <span class="form-label">Flying from</span>
                    <select class="form-control" name="flying-from">
                      <?php
                      // Fetch cities from the database
                      $sql = "SELECT * FROM cities";
                      $result = mysqli_query($conn, $sql);
                      if (mysqli_num_rows($result) > 0) {
                          while ($row = mysqli_fetch_assoc($result)) {
                              echo "<option value='" . $row['city'] . "'>" . $row['city'] . "</option>";
                          }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <span class="form-label">Flying to</span>
                    <select class="form-control" name="flying-to">
                      <?php
                      // Fetch cities from the database
                      $sql = "SELECT * FROM cities";
                      $result = mysqli_query($conn, $sql);
                      if (mysqli_num_rows($result) > 0) {
                          while ($row = mysqli_fetch_assoc($result)) {
                              echo "<option value='" . $row['city'] . "'>" . $row['city'] . "</option>";
                          }
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <span class="form-label">Departing</span>
                    <input class="form-control" type="date" name="departing" required>
                  </div>
                </div>
                <div class="col-md-6" id="returningField">
                  <div class="form-group">
                    <span class="form-label">Returning</span>
                    <input class="form-control" type="date" name="returning">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <span class="form-label">Passenger</span>
                    <input class="form-control" type="text" name="passenger" placeholder="Passenger">
                    <span class="select-arrow"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <span class="form-label">Travel class</span>
                    <select class="form-control" name="travel-class">
                      <option>Economy class</option>
                      <option>Business class</option>
                      <option>First class</option>
                      </select>
                    <span class="select-arrow"></span>
                  </div>
                </div>
              </div>
              <div class="form-btn">
                <button type="submit" class="submit-btn">Show flights</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    var oneWayRadio = document.getElementById("one-way");
    var returningField = document.getElementById("returningField");
    var roundtripRadio = document.getElementById("roundtrip");

    oneWayRadio.addEventListener("change", function () {
      if (oneWayRadio.checked) {
        returningField.style.display = "none";
      } else {
        returningField.style.display = "block";
      }
    });

    roundtripRadio.addEventListener("change", function () {
      if (roundtripRadio.checked) {
        returningField.style.display = "block";
      }
    });
    oneWayRadio.addEventListener("change", function () {
      if (oneWayRadio.checked) {
        returningField.style.display = "none";
      }
    });
  });
</script>

</body>
</html>

