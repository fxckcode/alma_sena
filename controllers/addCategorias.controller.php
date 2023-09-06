<?php

include("dbConection.php");


// Crear una categoria nueva
if (isset($_POST['nombre'])) {
    $nombre  = $_POST['nombre'];
    $conexion->query("INSERT INTO categorias SET `nombreCat`='$nombre'");
   echo "Categoria creada con exito";

}


if (isset($_POST['id'])){
    $id = intval($_POST['id']);
    $conexion->query("DELETE FROM categorias WHERE idCategoria=".$id);
    echo "Categoria eliminada";
}