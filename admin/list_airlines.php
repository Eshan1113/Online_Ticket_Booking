<?php

// Start the session
session_start();

// Check if the session variables are set
if (!isset ($_SESSION['UN'])) {
    header("Location: ../index.php");
}
ob_start(); // Start output buffering

require_once "../dbconnection.php";


// Check if airline_id is set and is a valid number
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $airline_id = $_GET['id'];

    // Prepare a DELETE statement
    $sql = "DELETE FROM airlines WHERE airline_id = ?";
    $stmt = mysqli_stmt_init($conn);

    // Check if the statement can be prepared
    if(mysqli_stmt_prepare($stmt, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $airline_id);

        // Execute the statement
        if(mysqli_stmt_execute($stmt)) {
            // Redirect to the list of airlines page after deletion
            header("Location: list_airlines.php?delete=success");
            exit();
        } else {
            // Redirect with an error if the deletion fails
            header("Location: list_airlines.php?error=delete_failed");
            exit();
        }
    } else {
        // Redirect if the statement cannot be prepared
        header("Location: list_airlines.php?error=sql_error");
        exit();
    }
} else {
    // Fetch data from the airlines table
    $sql = "SELECT * FROM airlines";
    $result = mysqli_query($conn, $sql);

    // Check if there are any rows returned
    if (mysqli_num_rows($result) > 0) {
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>List of Airlines</title>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
</head>

<body>
 <?php include_once 'heder.php'; ?>
    <div class='container '>
        <h2></h2>
        <h1 class="display-4 text-center "
              >List of Airlines</h1>
        <table class='table table-bordered table-hover'>
  
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Seats</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
<?php
        while ($row = mysqli_fetch_assoc($result)) {
?>
                <tr>
                    <td><?php echo $row["airline_id"]; ?></td>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["seats"]; ?></td>
                    <td><a href='list_airlines.php?id=<?php echo $row["airline_id"]; ?>' class='btn btn-danger'>Delete</a></td>
                </tr>
<?php
        }
?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
    } else {
        echo "<div class='container mt-5'>0 results</div>";
    }

    // Close the database connection
    mysqli_close($conn);
}

ob_end_flush(); // Flush the output buffer and turn off output buffering
?>
