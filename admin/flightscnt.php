<?php

require '../dbconnection.php';

if(!$conn){
    die("Connection Failed");
}

$sql = "SELECT * FROM flight";
                $query = $conn->query($sql);

                echo "$query->num_rows";
?><!-- Visit codeastro.com for more projects -->