<?php

session_start();

    if(!isset($_SESSION["user"]) && !isset($_SESSION["admin"])){
        header ("Location: ../login.php");
        exit();
    }

    if(isset($_SESSION["user"])){
        header("Location: ../home.php");
        exit();
    }

require_once "../components/db_connect.php";
    

$layout = "";
$id = $_GET["id"];

 $sql = "SELECT * FROM animals WHERE id = $id";


// $search = "";
// if (isset($_GET['search'])) {
//     $search = mysqli_real_escape_string($connect, $_GET['search']);
//     $sql = "SELECT * FROM library WHERE title LIKE '%$search%'";
// } else {
//     $sql = "SELECT * FROM library";
// }

$result = mysqli_query($connect, $sql);

$value = mysqli_fetch_assoc($result);

$layout = "<div><div class='card' style='width: 100%;'>
<div>
  <div class='card-body '>
  <div class='picture'>
    <img src='../pictures/{$value['picture']}' class='card-img-top'  alt='...'>
</div>
    <h5 class='card-title'>{$value["fname"]}</h5>
            <p class='card-text'>Breed: {$value["breed"]}</p>
            <p class='card-text'>Size: {$value["size"]}</p>
            <p class='card-text'>Age: {$value["age"]}</p>
            <p class='card-text'>Vaccined: {$value["vaccine"]}</p>
    
  </div>
  </div>
</div>";

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
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="http://localhost:3000/dashboard.php">BigLibrary</a>
    <form class="d-flex" action="index.php" method="GET">
    <input class="form-control me-2" type="text" name="search" placeholder="Search Title" value="<?= htmlspecialchars($search) ?>">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
</form>

  </div>
</nav> 
    <div class="container">
    <?= $layout ?>
    
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>