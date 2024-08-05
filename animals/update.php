<?php
session_start();

# if you are no one (not user or admin) i will redirect you to the login page
if (!isset($_SESSION["user"]) && !isset($_SESSION["admin"])) {
    header("Location: ../login.php");
    exit();
}

# if a user tried to access this page, will be redirected to the home.php
if (isset($_SESSION["user"])) {
    header("Location: ../home.php");
    exit();
}

require_once "../components/db_connect.php";
require_once "../components/file_upload.php";

$id = $_GET["id"];
$sql = "SELECT * from animals WHERE id = $id";
$result = mysqli_query($connect, $sql); # go btn execute the query
$row = mysqli_fetch_assoc($result);



// $sqlS = "SELECT * FROM suppliers";
// $resultS = mysqli_query($connect, $sqlS);
// $suppliers = mysqli_fetch_all($resultS, MYSQLI_ASSOC);

// $options = "";
// foreach ($suppliers as $value) {
//     if ($row["fk_supplier_id"] == $value["supplierId"]) {
//         $options .= "<option value='{$value["supplierId"]}' selected>{$value["sup_name"]}</option>";
//     } else {
//         $options .= "<option value='{$value["supplierId"]}'>{$value["sup_name"]}</option>";
//     }
// }

if (isset($_POST["update"])) {
    $fname = $_POST["fname"];
    $breed = $_POST["breed"];
    $size = $_POST["size"];
    $age = $_POST["age"];
    $vaccine = $_POST["vaccine"];
    $picture = fileUpload($_FILES["picture"], "animals");
    // $supplier = $_POST["supplier"];
    if ($_FILES["picture"]["error"] == 4) {
        # you didn't change the picture at all
        $sqlUpdate = "UPDATE `animals` SET `fname`='{$fname}',`breed`='{$breed}', `size` = '{$size}'  WHERE id = $id";
    } else {
        # remove the old picture (but keep in mind the product.jpg is the default)
        if ($row["picture"] != "product.jpg") {
            unlink("../pictures/{$row["picture"]}"); # helps you to remove a file (delete a file)
        }
        $sqlUpdate = "UPDATE `animals` SET `fname`='{$fname}',`breed`='{$breed}', picture = '{$picture[0]}', `size` = '{$size}'  WHERE id = $id";
        //, fk_supplier_id = {$supplier}
//fk_supplier_id = {$supplier}
    }

    $resultUpdate = mysqli_query($connect, $sqlUpdate);


    header("Location: index.php");
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
        <h1>Update pet</h1>
        <form method="post" enctype="multipart/form-data">
            <label for="fname" class="form-label">Name</label>
            <input  type="text" placeholder="Name" class="form-control my-3" name="fname" value="<?= $row["fname"] ?>">
            <label  class="form-label">Breed</label>
            <input  type="text"  placeholder="Breed" class="form-control my-3" name="breed" value="<?= $row["breed"] ?>">
            <label  class="form-label">Size</label>
            <input  type="text"  placeholder="Size" class="form-control my-3" name="size" value="<?= $row["size"] ?>">
            <label for="type" class="form-label">Age</label>
            <input  type="text"  placeholder="Age" class="form-control my-3" name="age" value="<?= $row["age"] ?>">
            <label for="vaccine" class="form-label">Vaccined: </label>
            <input  type="text"  placeholder="Vaccined" class="form-control my-3" name="vaccine" value="<?= $row["vaccine"] ?>">

            
            
            <!-- for price use this <input id="type" type="number" step="0.1" placeholder="Product type" class="form-control my-3" name="type" value=" ?>"> --> 

            <input type="file" placeholder="Product picture" class="form-control my-3" name="picture">
          
            <input type="submit" class="btn btn-primary my-3" value="Update product" name="update">
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>