<?php
session_start();

// Check if the session variables are set
if (!isset ($_SESSION['UN'])) {
    header("Location: ../index.php");
}
$servername = "localhost"; // Replace with your server name
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$database = "ticketsystem"; // Replace with your database name

// Create connection
$connection = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$connection) {
    die("Database connection error: " . mysqli_connect_error());
}
?>
<?php
require_once "../dbconnection.php";
require_once"heder.php";
// Fetch flight data from the database
$query = "SELECT * FROM flight";
$result = mysqli_query($connection, $query);

// Initialize the $flights array
$flights = array();

// Check if there are rows returned
if ($result && mysqli_num_rows($result) > 0) {
    // Fetch each row and store it in the $flights array
    while ($row = mysqli_fetch_assoc($result)) {
        $flights[] = $row;
    }
} else {
    echo "No flights found.";
}
// Check if flight deletion is requested
if (isset($_GET['id']) && !empty($_GET['id'])) {
  $flight_id = $_GET['id'];

  // Prepare a delete statement
  $query = "DELETE FROM flight WHERE flight_id = ?";

  if ($stmt = mysqli_prepare($connection, $query)) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "i", $param_id);

      // Set parameters
      $param_id = $flight_id;

      // Attempt to execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
          // Flight deleted successfully. You can handle the response as per your application's requirements.
          echo "Flight deleted successfully.";
      } else {
          echo "Oops! Something went wrong. Please try again later.";
      }

      // Close statement
      mysqli_stmt_close($stmt);
  }
}

// Close connection
mysqli_close($connection);
?>
<?php include_once 'heder.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Flights</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .delete-btn {
            background-color: #f44336;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <br>
   <div class="container">
   <h1 class="display-4 text-center "
              >AIRLINES LIST</h1>
   <br>
   <table class='table table-bordered table-hover'>
  
   
        <tr>
            <th>ID</th>
            <th>Arrival</th>
            <th>Departure</th>
            <th>Source</th>
            <th>Destination</th>
            <th>Airline</th>
            <th>Seats</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        <?php
        
            foreach ($flights as $flight) {
                echo "<tr>";
                echo "<td>{$flight['flight_id']}</td>";
                echo "<td>{$flight['arrivale']}</td>";
                echo "<td>{$flight['departure']}</td>";
                echo "<td>{$flight['source']}</td>";
                echo "<td>{$flight['Destination']}</td>";
                echo "<td>{$flight['airline']}</td>";
                echo "<td>{$flight['Seats']}</td>";
                echo "<td>{$flight['Price']}</td>";
                echo "<td><button class='delete-btn' onclick='deleteFlight({$flight['flight_id']})'>Delete</button></td>";
                echo "</tr>";
            }
        ?>
    </table>

   </div>
    <script>
    function deleteFlight(flight_id) {
        if (confirm("Are you sure you want to delete this flight?")) {
            // Make AJAX request to delete_flight.php
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "all_flights.php?id=" + flight_id, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // On successful deletion, you may want to reload the page or remove the row from the table
                    // For simplicity, let's reload the page
                    window.location.reload();
                }
            };
            xhr.send();
        }
    }
</script>
</body>
</html>
