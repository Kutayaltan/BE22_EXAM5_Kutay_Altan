<?php

session_start();
if(!isset($_SESSION["user"]) && !isset($_SESSION["admin"])) {
    header("Location: ../login.php");
    exit();
}
if(isset($_SESSION["user"])) {
    header("Location: ../home.php");
    exit();
}

require_once "../components/db_connect.php";
require_once "../components/file_upload.php";


if (isset($_POST["create"])) {
    $fname = $_POST["fname"];
    $breed = $_POST["breed"];
    $size = $_POST["size"];
    $age = $_POST["age"];
    $vaccine = $_POST["vaccine"];
    $picture = fileUpload($_FILES["picture"], "animals");

   
    $sql = "INSERT INTO `animals` (`fname`, `picture`, `breed`, `size`, `age`, `vaccine`) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ssssss", $fname, $picture[0], $breed, $size, $age, $vaccine);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success' role='alert'>
                Pet {$fname} has been added, {$picture[1]}
              </div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>
                Something went wrong, please try again later
              </div>";
    }

    $stmt->close();
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">BigLibrary</a>
    <form class="d-flex" action="index.php" method="GET">
    <input class="form-control me-2" type="text" name="search" placeholder="Search Title" value="<?= htmlspecialchars($search ?? '') ?>">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
</form>

  </div>
</nav> 
    <h1>Create Pet</h1>
    <div class="container">
    <form method="post" enctype="multipart/form-data">
     <input name="fname" type="text" placeholder="Name" class="form-control my-1" required>
     <input name="breed" type="text" placeholder="Breed" class="form-control my-1" required>
     <input name="size" type="text" placeholder="Size" class="form-control my-1" required>
     <input name="age" type="text" placeholder="Age" class="form-control my-1" required>
     <input name="vaccine" type="text" placeholder="Vaccine" class="form-control my-1" required>
     <input type="file" name="picture" class="form-control mb-3" required>
     <input name="create" type="submit" class="btn btn-primary" value="Create">
     </form>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html> 
