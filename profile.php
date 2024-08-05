<?php
session_start();

# none users if they try to access the dashboard
if (!isset($_SESSION["user"]) && !isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}



require_once "components/db_connect.php";
require_once "components/file_upload.php";


if(isset($_SESSION["admin"])){
    $session = $_SESSION["admin"];
    $backTo = "dashboard.php";
} else {
    $session = $_SESSION["user"];
    $backTo = "home.php";
}


$sql = "SELECT * FROM users WHERE id = $session";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);

if(isset($_POST["edit"])){
    $fname = cleanInput($_POST["fname"]);
    $email = cleanInput($_POST["email"]);
  $picture = fileUpload($_FILES["picture"]);

   
    if($_FILES["picture"]["error"] == 4){
        $sqlUpdate = "UPDATE users SET fname = '$fname', email = '$email' WHERE id = $session";
    } else {
        if($row["picture"] != 'avatar.jpg'){
            unlink("pictures/".$row["picture"]);
        }
        $sqlUpdate = "UPDATE users SET fname = '$fname', email = '$email', picture ='$picture[0]' WHERE id = $session";
    }
    $result = mysqli_query($connect, $sqlUpdate);

    if($result){
        header("Loaction; " . $backTo);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello <?= $row["fname"] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Edit profile</h1>
        <form enctype="multipart/form-data" method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"])?>">
        <input type="text" name="fname" class="form-control mb-3" value="<?=$row["fname"]?>">
        <input type="email" name="email" class="form-control mb-3" value="<?=$row["email"]?>">
        <input type="file" name="picture" class="form-control mb-3">
        <input type="submit" name="edit" value="Update profile" class="btn btn-warning">
        </form>
    </div>
</body>

</html>