<?php

include("dbConection.php");


// Crear una categoria nueva
if (isset($_POST['nombre'])) {
    $nombre  = $_POST['nombre'];
    $sql = $conexion->query("INSERT INTO categorias SET `nombreCat`='$nombre'");
    
    if ($sql == 1) {
        header("Location: ../views/elementosGestionar.php");
        echo '<script>alert("Categoria creada con exito!!!")</script>';
    } else {
        header("Location: ../views/elementosGestionar.php");
        echo '<script>alert("Error al crear la categoría")</script>';
    }

} else {
    header("Location: ../views/elementosGestionar.php");
    echo '<script>alert("Error al crear la categoría")</script>';
}