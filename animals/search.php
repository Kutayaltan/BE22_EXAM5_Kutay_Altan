<?php
    require_once "../components/db_connect.php";

    $search = $_GET["search"];

    $sql = "SELECT * FROM animals WHERE breed like '$search%'";

    $result = mysqli_query($connect, $sql);

    $layout = "";
    if(mysqli_num_rows($result) == 0){
        $layout .= "<p>No pets found</p>";
    } else {
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

        foreach ($rows as $key => $value) {
            $layout .= "<div><div class='card' style='width: 18rem;'>
            <img src='../pictures/{$value['picture']}' class='card-img-top' alt='...'>
            <div class='card-body'>
            <h5 class='card-title'>{$value["fname"]}</h5>
            <p class='card-text'>{$value["breed"]}</p>
            <p class='card-text'>{$value["size"]}</p>
            <p class='card-text'>{$value["age"]}</p>
            <a href='details.php?id={$value["id"]}' class='btn btn-success'>Details</a>
        </div>
    </div>
</div>";
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
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="http://localhost:3000/index.php">BigLibrary</a>
    
</form>

  </div>
</nav> 
    <div class="container justify-content-between ">
    
    <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-xs-1">
    <?= $layout ?>
    </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>