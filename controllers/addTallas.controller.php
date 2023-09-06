<?php

include("dbConection.php");

if (isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
    $conexion->query("INSERT INTO tallas SET tallas='".$nombre."'");
    echo "Talla creada con exito";
}

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $conexion->query("DELETE FROM tallas WHERE idTalla=".$id);
    echo "Talla eliminada con exito";
}