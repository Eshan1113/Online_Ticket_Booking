<?php
if(isset($_POST['air_but'])) {
    require '../dbconnection.php'; 
    $airline = $_POST['airline'];
    $seats = $_POST['seats'];
    $sql = 'INSERT INTO  airlines (name,seats) VALUES (?,?)';
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)) {
        header('Location: ../feedback.php?error=sqlerror');
        exit();            
    } else {
        mysqli_stmt_bind_param($stmt,'si',$airline,$seats);            
        mysqli_stmt_execute($stmt); 
        header('Location: adminPage.php');
        exit();       
    
       
    }

} else {
    header('Location:adminPage.php');
    exit();  
}
