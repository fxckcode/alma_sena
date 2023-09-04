<?php



require("dbConection.php");

$usrName =               $_POST['uname'];
$usrId =                 $_POST['dni'];
$usrMail =               $_POST['email'];
$usrPass =           md5($_POST['pass']);
$tel = $_POST['telefono'];

$query = "INSERT INTO usuarios (id, user, telefono, password, email, rol) 
            VALUES ($usrId, '$usrName', '$tel', '$usrPass', '$usrMail', 'user')";

mysqli_query($conexion, $query);

echo "Funcionando";
