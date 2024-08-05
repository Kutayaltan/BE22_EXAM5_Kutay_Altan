<?php
session_start();

if(isset($_SESSION["user"])){
    header("Location: home.php");
    exit();
}

if(isset($_SESSION["admin"])){
    header("Location: dashboard.php");
    exit();
}

require_once "components/db_connect.php";


$error = false;
$email = $emailError = $passError = "";

if(isset($_POST["login-btn"])){
    $email = cleanInput($_POST["email"]);
    $password = cleanInput($_POST["password"]);
    
    if(empty($email)){
        $error = true;
        $emailError = "Email is required";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = true;
        $emailError = "not a valid email!";
    }

    if(empty($password)){

        $error = true;
        $passError = "password is required";
    }

    if(!$error){
        $password = hash("sha256", $password);
        
        $sql = "SELECT * FROM `users` WHERE email = '$email' AND PASSWORD = '$password' ";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result)==1){
              # you can login 
            # we need to check if the whoever logged in is a user or adm 
            if($row["status"] == "admin"){
                # send you to the dashboard
                $_SESSION["admin"] = $row["id"];
                header("Location: dashboard.php");
          } else {
            # send you to the home page
            $_SESSION["user"] = $row["id"];
            header("Location: home.php");
          }
        }else {
            
            echo "incorrect credentials!";
        }
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
    <form method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" autocomplete="off">
    <input type="text" placeholder="something@gmail.com" class="form-control mt-3" name="email" value="<?=$email ?>">
    <p class="text-danger"><?=$emailError?></p>
    <input type="password" placeholder="your password!" class="form-control mt-3" name="password">
    <p class="text-danger"><?=$passError ?></p>
    <input type="submit" value="Login" name="login-btn" class="btn btn-info mt-3">
    </form>
    </div>
</body>
</html>