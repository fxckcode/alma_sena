<?php
require_once("dbConection.php");

if (isset($_POST['id'])) {
    $user = $conexion->query("SELECT * FROM usuarios WHERE id=".intval($_POST['id']));
    echo json_encode($user->fetch_assoc());
}

?>