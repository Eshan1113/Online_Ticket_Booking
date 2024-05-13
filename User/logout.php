<?php
// Start the session
session_start();

// Check if the session variables are set
if (isset($_SESSION['UN'])) {
    session_destroy();
    header("Location: ../index.php");
}
?>