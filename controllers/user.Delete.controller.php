<?php 
// ↓Recoge el id enviado por el botón borrar de la vista entradas
if (isset($_POST['usrId'])) {
    include("dbConection.php");
    $id= intval($_POST['usrId']);
    $sqlDel= $conexion->query ("DELETE FROM usuarios WHERE  id=".$id);

    if ($sqlDel==1) {
        echo '<div class="alert alert-success text-center"><strong>Elemento eliminado.</strong></div>';
    } else {
        echo '<div class="alert alert-danger text-center"><strong>ERROR, Revise los parámetros.</strong></div>';
    }
}
?>