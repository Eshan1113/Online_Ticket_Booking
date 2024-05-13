<?php
// Start the session
session_start();

// Check if the session variables are set
if (!isset ($_SESSION['UN'])) {
    header("Location: ../index.php");
}

require_once "../dbconnection.php";

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty ($_POST['airline'])) {
        $errors[] = "Airlines Name is required";
    }
    if (empty ($_POST['seats'])) {
        $errors[] = "Total Seats is required";
    }


    if (empty ($errors)) {
        $airline = $_POST['airline'];
        $seats = $_POST['seats'];
        $sql = "INSERT INTO airlines (name,seats) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $airline, $seats);

        if ($stmt->execute()) {

            echo "<p>Data added successfully!</p>";
        } else {

            echo "<p>Error: " . $conn->error . "</p>";
        }

        $stmt->close();
        $conn->close();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

</head>

<body>
    <?php require_once "heder.php"; ?>
<br>

<h1 class="display-4 text-center "
              >Add Airlines </h1>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <?php if (!empty ($errors)) {
                    echo '<div class="alert alert-danger" role="alert">';
                    foreach ($errors as $error) {
                        echo "<p>$error</p>";
                    }
                    echo '</div>';
                } ?>
                <form class="px-2 py-2" action="add_airline.php" method="post">
                    <div class="form-group">
                        <label for="airline">Airlines Name</label>
                        <input type="text" id="airline" class="form-control" name="airline"
                            placeholder="Enter Airlines Name">
                    </div>
                    <div class="form-group">
                        <label for="seats">Total Seats</label>
                        <input type="number" id="seats" class="form-control" name="seats"
                            placeholder="Enter Total Seats">
                    </div>
                    <button type="submit" name="air_but" class="btn btn-success w-100 mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>