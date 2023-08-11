<?php
if (!empty($_POST['btnAdd'])) {
    if (!empty($_POST['elemTipo']) 
    and !empty($_POST['nombre']) 
    and !empty($_POST['talla']) 
    and !empty($_POST['marca']) 
    and !empty($_POST['color']) 
    and !empty($_POST['exist']) 
   ) {

        $tipo= $_POST['elemTipo'];
        $nombre= $_POST['nombre'];
        $talla= $_POST['talla'];
        $marca= $_POST['marca'];
        $color= $_POST['color'];
        $exist= $_POST['exist'];
        $nota= $_POST['nota'];

        $sql= $conexion->query ("insert into elementos (fkCategoria, fkTalla, elemento, marca, color, existencias, observacion)
        values('$tipo', '$talla', '$nombre', '$marca', '$color', '$exist', '$nota')");
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