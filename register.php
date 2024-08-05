<?php

session_start();

// if(isset($_SESSION["user"])){
//     header("Location: home.php");
//     exit();
// }

// if(isset($_SESSION["admin"])){
//     header("Location: dashboard.php");
//     exit();
// }

require_once "components/db_connect.php";
require_once "components/file_upload.php";

$error = false;

$fname = $email = $pass = $picture = '';
$fnameError = $emailError = $passError = $picError = '';



if (isset($_POST['btn-signup'])) {

    $fname = cleanInput($_POST["fname"]);

    $password = cleanInput($_POST["password"]);

    $email = cleanInput($_POST["email"]);

    $picture = fileUpload($_FILES['picture']);

    # validation 
    # first name validation - can't be empty
    
    if (empty($fname)) {
        $error = true;
        $fnameError = "first name can't be empty!";
    } elseif (strlen($fname) < 3) {
        $error = true;
        $fnameError = "first name can't be less than 2 chars";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $fname)) {
        $error = true;
        $fnameError = "first name must contain only letters and spaces!";
    }

   

   


    if (empty($email)) {
        $error = true;
        $emailError = "Email is required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {  # jhfgk@jgj.aj
        $error = true;
        $emailError = "Please type a valid email!";
    } else {
        $searchIfEmailExists = "SELECT email FROM users WHERE email = '$email'";
        $result = mysqli_query($connect, $searchIfEmailExists);
        if (mysqli_num_rows($result) != 0) {
            $error = true;
            $emailError = "Email already exists!";
        }
    }

    if (empty($password)) {
        $error = true;
        $passError = "Password can't be empty!";
    } elseif (strlen($password) < 6) {
        $error = true;
        $passError = "Password can't be less than 6 Chars";
    }


    if (!$error) {  # if the $error is false (not true)
        ## hash it   (123123)    in database    lkh34jh2ök3j4g23hg5l2kj5h645k7l5j6k6b23hlj34
        $password = hash('sha256', $password);

        $sql = "INSERT INTO `users`(`fname`, `password`, `email`, `picture`) VALUES ('$fname','$password','$email','$picture[0]')";

        $result = mysqli_query($connect, $sql);

        if ($result) {
            echo "<div class='alert alert-success' role='alert'>
                    <h4 class='alert-heading'>Registered Successfully!</h4>
                    <p>Aww yeah, you successfully created a new account on our website!<br> enjoy it while it is free! ;)</p>
                    <hr>
                    <p class='mb-0'>$picture[1]</p>
                  </div>";
            $fname = $email = "";
        } else {
            echo "<div class='alert alert-danger' role='alert'>
            <h3>Something went wrong, please try again later!</h3>
          </div>";
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
</head>

<body>

    <div class="container my-5">

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data" method="POST" class="w-50 mx-auto">
            <h2 class="mb-3">Registration Form
            </h2>
            <div class="mb-3">
                <label for="name">First name</label>
                <input type="text" class="form-control" id="name" name="fname" value="<?= $fname ?>">
                <p class="text-danger"><?= $fnameError ?></p>
            </div>
            <div class="mb-3">
                <label for="picture">Picture</label>
                <input type="file" class="form-control" id="picture" name="picture">
            </div>
            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>">
                <p class="text-danger"><?= $emailError ?></p>

            </div>
            <div class="mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                <p class="text-danger"><?= $passError ?></p>

            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success" name="btn-signup">Register</button>
            </div>
        </form>
    </div>
</body>

</html>