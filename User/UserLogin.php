<?php
require_once "../dbconnection.php";

$error = "";
$login_success = "";


function clean_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = clean_input($_POST["username"]);
    $password = clean_input($_POST["password"]);


    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("SELECT user_id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($user_id,$stored_password);
    $stmt->fetch();
    $stmt->close();

    if ($stored_password && password_verify($password, $stored_password)) {
        session_start();
        $_SESSION['ID'] = $user_id;
        $_SESSION['UN'] =  $username ;
         $_SESSION['flight_id'] = $flight_id; 
        $login_success = "Login successful. Welcome!";
        header("Location: UserDashbord.php");
        exit();
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
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
    <form action="" method="post">
        <h2>User Login</h2>
        <?php if (!empty ($error)) { ?>
            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>
        <?php } ?>
        <?php if (!empty ($login_success)) { ?>
            <div class="alert alert-success">
                <?php echo $login_success; ?>
            </div>
        <?php } ?>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Login">
        <a href="#" onclick="history.back()" class="btn btn-secondary">Back</a>
        <div class="create-account">
            <p>Don't have an account? <a href="UserRegister.php">Create new account</a></p>
        </div>
    </form>
</body>

</html>