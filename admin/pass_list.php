<php? include_once ?>
<?php
// Start the session
session_start();

// Check if the session variables are set
if (!isset($_SESSION['UN'])) {
    header("Location: ../index.php");
}
$servername = "localhost";
$username = "root";
$password = "";
$database = "ticketsystem";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Passenger List</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-color: #efefef;
    }

    .container-md {
      margin-top: 20px;
    }

    .table {
      background-color: #ffffff;
    }

    .table th,
    .table td {
      font-weight: bold;
      font-family: 'Assistant', sans-serif !important;
      vertical-align: middle;
    }

    .table th {
      font-size: 18px;
    }

    .table td {
      font-size: 16px;
    }

    .table-bordered th,
    .table-bordered td {
      border: 1px solid #dee2e6;
    }

    .thead-dark th {
      background-color: #343a40;
      color: #ffffff;
    }

    .table-bordered tbody tr:nth-of-type(odd) {
      background-color: #f8f9fa;
    }

    .table-bordered tbody tr:hover {
      background-color: #e2e6ea;
    }

    .text-center {
      text-align: center;
    }
  </style>
</head>
<body>
<main>
  <?php include_once 'heder.php';?>
  <div class="container-md">
    <h1 class="display-4 text-center text-secondary">Passenger List</h1>
    <br>
    <table class="table table-bordered">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">First Name</th>
          <th scope="col">Middle Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Contact</th>
          <th scope="col">D.O.B</th>
          <th scope="col">Paid By</th>
          <th scope="col">Amount</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $cnt = 1;
        $flight_id = $_GET['flight_id'];
        $stmt_t = mysqli_stmt_init($conn);
        $sql_t = 'SELECT * FROM ticket WHERE flight_id=?';
        $stmt_t = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt_t, $sql_t)) {
          header('Location: ticket.php?error=sqlerror');
          exit();
        } else {
          mysqli_stmt_bind_param($stmt_t, 'i', $flight_id);
          mysqli_stmt_execute($stmt_t);
          $result_t = mysqli_stmt_get_result($stmt_t);
          while ($row_t = mysqli_fetch_assoc($result_t)) {
            $sql = 'SELECT * FROM Passenger_profile WHERE passenger_id=?';
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt, $sql);
            mysqli_stmt_bind_param($stmt, 'i', $row_t['passenger_id']);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
              $sql_p = 'SELECT * FROM PAYMENT WHERE flight_id=? AND user_id=?';
              $stmt_p = mysqli_stmt_init($conn);
              mysqli_stmt_prepare($stmt_p, $sql_p);
              mysqli_stmt_bind_param($stmt_p, 'ii', $flight_id, $row['user_id']);
              mysqli_stmt_execute($stmt_p);
              $result_p = mysqli_stmt_get_result($stmt_p);
              if ($row_p = mysqli_fetch_assoc($result_p)) {
                $sql_u = 'SELECT * FROM Users WHERE user_id=?';
                $stmt_u = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt_u, $sql_u);
                mysqli_stmt_bind_param($stmt_u, 'i', $row['user_id']);
                mysqli_stmt_execute($stmt_u);
                $result_u = mysqli_stmt_get_result($stmt_u);
                if ($row_u = mysqli_fetch_assoc($result_u)) {
                  echo "
                    <tr class='text-center'>
                      <td>" . $cnt . "</td>
                      <td>" . $row['f_name'] . "</td>
                      <td>" . $row['m_name'] . "</td>
                      <td>" . $row['l_name'] . "</td>
                      <td>" . $row['mobile'] . "</td>
                      <td>" . $row['dob'] . "</td>
                      <td scope='row'>" . $row_u['username'] . "</td>
                      <td>$ " . $row_p['amount'] . "</td>
                    </tr>
                  ";
                }
              }
            }
            $cnt++;
          }
        }
        ?>
      </tbody>
    </table>
  </div>
</main>
</body>
</html>
