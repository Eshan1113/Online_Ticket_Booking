<?php

require '../dbconnection.php';

if(!$conn){
    die("Connection Failed");
}

$sql = "SELECT SUM(cost) FROM ticket";
        $amountsum = mysqli_query($conn, $sql);
        $row_amountsum = mysqli_fetch_assoc($amountsum);
        $totalRows_amountsum = mysqli_num_rows($amountsum);
        echo $row_amountsum['SUM(cost)'];
?><!-- Visit codeastro.com for more projects -->