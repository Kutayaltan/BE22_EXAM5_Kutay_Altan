<?php
session_start();

if(!isset($_SESSION["user"]) && !isset($_SESSION["admin"])){
header("Location: login.php");
exit();

}

if(isset($_SESSION["user"]) ){
    header("Location: home.php");
    exit();
}

require_once "components/db_connect.php";

$sql = "SELECT * FROM users WHERE id = " . $_SESSION["admin"];
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello <?= $row["fname"] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
</head>
<body>
<div class="container">
    <img height="200" src="../pictures/<?= $row["picture"] ?>" alt="">
<h1>Welcome <?=$row["fname"] . "" . $row["email"]?></h1>
<a href="profile.php" class="btn btn-success">Edit profile</a>
<a href="animals/index.php" class="btn btn-success">Products dashboard</a>
<a href="logout.php?logout" class="btn btn-success">Logout</a>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>