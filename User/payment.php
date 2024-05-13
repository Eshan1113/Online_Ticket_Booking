<?php
session_start();

// Redirect to login if not authenticated
if (!isset($_SESSION['UN'])) {
    header("Location: login.php");
    exit;
}

include_once '../dbconnection.php';

// Get flight_id from query parameter
$fid = $_GET['flight_id'] ?? null;

// Check if the form is submitted
if (isset($_POST['payment_btn'])) {
    // Validate card number
    $card_number = $_POST['card_number'];
    if (!preg_match('/^\d{16}$/', $card_number)) {
        echo "Invalid card number. It must be 16 digits.";
        exit;
    }

    // Validate expiry date (MM/YY)
    $expiry_date = $_POST['expiry_date'];
    if (!preg_match('/^\d{2}\/\d{2}$/', $expiry_date)) {
        echo "Invalid expiry date. It must be in MM/YY format.";
        exit;
    }

    // Validate CVV
    $cvv = $_POST['cvv'];
    if (!preg_match('/^\d{3,4}$/', $cvv)) {
        echo "Invalid CVV. It must be 3 or 4 digits.";
        exit;
    }

    // Retrieve user_id from session
    $user_id = $_SESSION['ID'];

    // Check if the flight_id is valid
    $flight_check_sql = "SELECT * FROM `flight` WHERE `flight_id` = '$fid'";
    $flight_check_result = mysqli_query($conn, $flight_check_sql);

    if ($flight_check_result && mysqli_num_rows($flight_check_result) > 0) {
        // Fetch the latest passenger_id
        $psg_check_sql = "SELECT `passenger_id` FROM `passenger_profile` ORDER BY `passenger_id` DESC LIMIT 1;";
        $psg_check_result = mysqli_query($conn, $psg_check_sql);

        if ($psg_check_result && mysqli_num_rows($psg_check_result) > 0) {
            $latest_passenger = mysqli_fetch_assoc($psg_check_result);
            $latest_passenger_id = $latest_passenger['passenger_id'];

            // Get the cost from flight
            $cost_query = "SELECT `Price` FROM `flight` WHERE `flight_id` = '$fid'";
            $cost_result = mysqli_query($conn, $cost_query);

            if ($cost_result && mysqli_num_rows($cost_result) > 0) {
                $cost = mysqli_fetch_assoc($cost_result)['Price'];

                // Insert into payment and ticket tables
                $sql_payment = "INSERT INTO `payment` (card_no, flight_id, user_id, expire_date, amount) 
                    VALUES ('$card_number', '$fid', '$user_id', '$expiry_date', '$cost')";
                $sql_ticket = "INSERT INTO `ticket` (passenger_id, flight_id, user_id, seat_no, class, cost) 
                    VALUES ('$latest_passenger_id', '$fid', '$user_id', '21A', 'A', '$cost')";

                if (mysqli_query($conn, $sql_payment) && mysqli_query($conn, $sql_ticket)) {
                    echo "<div style='color: green; font-weight: bold;'>Payment successful!</div>";
                    echo "<script>
                            setTimeout(function() {
                                window.location.href = 'ticket.php';
                            }, 3000);
                          </script>";
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            } else {
                echo "Error: Flight cost not found.";
            }
        } else {
            echo "Error: Passenger record not found.";
        }
    } else {
        echo "Error: Invalid flight ID.";
    }

    // Close the connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 500px;
            margin: 100px auto;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        .form-label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Payment Information</h1>
        <form method="POST" action="">
            <input type="text" name="flight_id" value="<?php echo htmlspecialchars($fid); ?>" hidden>
            <div class="mb-3">
                <label for="card_number" class="form-label">Card Number</label>
                <input type="text" class="form-control" id="card_number"
                    name="card_number" pattern="\d{16}" title="Card number must be 16 digits" required>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="expiry_date" class="form-label">Expiry Date</label>
                        <input type="text" class="form-control" id="expiry_date"
                            name="expiry_date" pattern="\d{2}/\d{2}" placeholder="MM/YY"
                            maxlength="5" title="Expiry date must be in MM/YY format" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="cvv" class="form-label">CVV</label>
                        <input type="text" class="form-control" id="cvv"
                            name="cvv" pattern="\d{3,4}" maxlength="4" title="CVV must be 3 or 4 digits" required>
                    </div>
                </div>
            </div>
            <button type="submit" name="payment_btn" class="btn btn-primary btn-block">Submit Payment</button>
        </form>
    </div>
</body>
</html>
