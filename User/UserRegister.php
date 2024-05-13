<?php

require_once "../dbconnection.php";

$error = "";
$registration_success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if ($password !== $confirm_password) {
        $error = "Password and confirm password do not match";
    } else {
  
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $conn->prepare("CALL register_user(?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashed_password);
        $stmt->execute();

        
        if ($stmt->errno) {
            if ($stmt->errno == 1062) { 
                $error = "Username already exists";
            } else {
                $error = "Registration failed. Please try again later.";
            }
        } else {
            $registration_success = "Registration successful. You can now <a href='UserLogin.php'>Login</a>.";
        }
        $stmt->close();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>User Registration</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link type="text/css" rel="stylesheet" href="../../css/style.css" />
<style>
    body {
        background-image: url('../img/background.jpg');
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        max-width: 400px;
        width: 100%;
    }
    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }
    input[type="submit"] {
        background-color: #3366ff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }
    input[type="submit"]:hover {
        background-color: #2554cc;
    }
</style>
</head>
<body>
<form action="UserRegister.php" method="post">
    <h2>User Registration</h2>
    <?php if (!empty($error)) { ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php } ?>
    <?php if (!empty($registration_success)) { ?>
        <div class="alert alert-success"><?php echo $registration_success; ?></div>
    <?php } ?>
    <input type="text" name="username" placeholder="Username" required>
    <input type="text" name="email" placeholder="Enter Your Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
    
    <input type="submit" value="Register">
    <a href="#" onclick="history.back()" class="btn btn-secondary">Back</a>
    
   
</form>
</body>
</html>
