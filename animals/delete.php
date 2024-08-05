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

$id = $_GET["id"];
$sql = "SELECT * FROM animals WHERE id = $id ";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);

if ($row["picture"] != "product.jpg") {
    unlink("../pictures/{$row["picture"]}");
}

$sqlDelete = "DELETE FROM `animals` WHERE id = $id ";
mysqli_query($connect, $sqlDelete);
header("Location: index.php");
