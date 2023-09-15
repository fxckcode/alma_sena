<?php

include("dbConection.php");


// Crear una categoria nueva
if (isset($_POST['nombre'])) {
    $nombre  = $_POST['nombre'];
    $conexion->query("INSERT INTO categorias SET `nombre`='$nombre'");
   echo "Categoria creada con exito";

}


if (isset($_POST['id'])){
    $id = intval($_POST['id']);
    $conexion->query("DELETE FROM categorias WHERE id=".$id);
    echo "Categoria eliminada";
}