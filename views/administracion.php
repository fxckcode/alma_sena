<?php
session_start();
if (empty($_SESSION['id'])) {
  header("Location:../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/senaGreen.png" type="image/x-icon">
    <title>Document</title>
</head>
<body>
    hi
    <div>
        <button class="btn btn-danger w-100 mt-4 shadow-sm "><a class="text-decoration-none text-white"
            href="../controllers/logout.php">Salir</a></button>
        <i class="bi bi-box-arrow-left"></i>
      </div>
</body>
</html>