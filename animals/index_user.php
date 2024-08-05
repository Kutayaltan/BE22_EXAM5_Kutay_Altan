<?php

    session_start();

    if(!isset($_SESSION["user"]) && !isset($_SESSION["admin"])){
        header ("Location: ../login.php");
        exit();
    }

    

   
    require_once "../components/db_connect.php";

    $search = "";
    if (isset($_GET['search'])) {
        $search = mysqli_real_escape_string($connect, $_GET['search']);
        $sql = "SELECT * FROM animals WHERE breed LIKE '%$search%'";
    } else {
        $sql = "SELECT * FROM animals";
    }



    $sql = "SELECT * FROM `animals`";
    //  LEFT JOIN suppliers ON animals.fk_supplier_id = suppliers.supplierId";
    $result = mysqli_query($connect, $sql); 


    $layout = "";
    if(mysqli_num_rows($result) == 0){
        $layout .= "<p>No pets found</p>";
    } else {
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

        foreach ($rows as $key => $value) {
            // $supplierName = $value["sup_name"] ? $value["sup_name"] : 'No supplier provided!'; 
            // das unten einfügen -> <p class='card-text'>Supplier Info: {$supplierName}</p>
             // das auch <a href='publisher.php?publisher={$value["publisher_name"]}' class='btn btn-outline-danger btn-sm my-1'>{$value["publisher_name"]}</a>

            $layout .= "<div class='col-lg-3 col-md-4 col-sm-6 mb-4'><div class='card h-100 my-2'>
            <img src='../pictures/{$value['picture']}' class='card-img-top' height='300' alt='...'>

            
            <div class='card-body'>
            <h5 class='card-title'>{$value["fname"]}</h5>
            <p class='card-text'>Breed: {$value["breed"]}</p>
            <p class='card-text'>Size: {$value["size"]}</p>
            <p class='card-text'>Age: {$value["age"]}</p>
            <p class='card-text'>Vaccined: {$value["vaccine"]}</p>
            <a href='adopt.php?id={$value["id"]}' class='btn btn-success'>Adopt</a>

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
    <a class="navbar-brand" href="http://localhost:3000/animals/index_user.php">Animal shelter</a>
    <form class="d-flex" action="search.php" method="GET">
    <a href='senior.php?id={$value["id"]}' class='btn btn-warning'>Seniors</a>
    <input class="form-control me-2" type="text" name="search" placeholder="Search Breed" value="<?= htmlspecialchars($search) ?>">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
</form>

  </div>
</nav> 
    <div class="container justify-content-between ">
    
    <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-xs-1">
    
    <?= $layout ?>
    </div>
    </div>

    <footer class="navbar navbar-expand-sm bg-dark navbar-dark">
  
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>