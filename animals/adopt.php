<?php



session_start();

if (!isset($_SESSION["user"]) && !isset($_SESSION["admin"])) {
    header("Location: ../login.php");
    exit();
}
if (isset($_SESSION["admin"])) {
    header("Location: ../dashboard.php");
    exit();
}


require_once "../components/db_connect.php";
require_once "../components/file_upload.php";




// HTML Form
if (isset($_GET["id"])) {
    $animalId = $_GET["id"];
    $userId = $_SESSION["user"]; // Assuming user ID is stored in session
   

  

    
} else {
    echo "No animal selected.";
}



// Handle form submission
if (isset($_POST["adopt"])) {
    $animalId = $_POST["animalId"];
    $userId = $_POST["userId"];
    $pickUp = $_POST["pick_up"];

    // Use prepared statements to prevent SQL injection
    $stmt = $connect->prepare("INSERT INTO `pet_adoption` (`user`, `animal`, `pick_up`) VALUES (?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("iis", $userId, $animalId, $pickUp);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            header("Location: ../home.php");
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: " . $connect->error;
    }
    exit();
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
    <div class="container">
    <form action="adopt.php" method="post">
        <input class="form-control mb-3" type="hidden" name="animalId" value="<?php echo $animalId; ?>">
        <input class="form-control mb-3" type="hidden" name="userId" value="<?php echo $userId; ?>">
        <label class="m-3" for="pick_up">Pick Up Date:</label>
        <input class="form-control mb-3" type="date" id="pick_up" name="pick_up" required>
        <button class="btn btn-primary my-3" type="submit" name="adopt">Adopt</button>
    </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>