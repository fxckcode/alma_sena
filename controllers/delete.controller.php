<?php
include("dbConection.php");
if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $conexion->query("DELETE FROM elementos WHERE id=$id");
}

?>