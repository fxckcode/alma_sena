<?php
if (!empty($_POST['btnSend'])) {
    if (!empty($_POST['Prueba']) 
   ) {
        $Prueba= $_POST['Prueba'];

        $sql= $conexion->query ("insert into tests (campoTest)
        values('$Prueba')");
        if ($sql==1) {
            echo '<div class="alert alert-success text-center"><strong>Elementos agregados.</strong></div>';
        } else {
            echo '<div class="alert alert-danger text-center"><strong>ERROR No se agregaron los elementos.</strong></div>';
        }

    }else {
        echo '<div class="alert alert-warning text-center"><strong>Todos los campos son obligatorios.</strong></div>';
    }
}

?>