<?php 
// ↓Recoge el id enviado por el botón borrar de la vista entradas
if (!empty($_GET['usrId'])) {
    $id= $_GET['id'];
    $sqlDel= $conexion->query ("DELETE FROM elementos WHERE idElemento= '$id'");

    if ($sqlDel==1) {
        echo '<div class="alert alert-success text-center"><strong>Elemento eliminado.</strong></div>';
    } else {
        echo '<div class="alert alert-danger text-center"><strong>ERROR, Revise los parámetros.</strong></div>';
    }
}
?>