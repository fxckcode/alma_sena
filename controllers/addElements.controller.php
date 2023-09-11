<?php
include ("dbConection.php");
//↓para auto rellenar el formulario
if (isset($_POST['categoria'])) {
$categoria=$_POST['categoria'];
$sql="SELECT * FROM elementos as e, categorias as c, tallas AS t 
where e.fkCategoria=c.idCategoria AND e.fkTalla= t.idTalla AND fkCategoria='$categoria' AND e.estado='activo'";


$resultado=mysqli_query($conexion,$sql);
$cadena="<span class='input-group-text bg-success-subtle'>Elemento</span>
			<select class='listaElem form-select pe-5' id='lista2' name='lista2'>";

            while ($col=mysqli_fetch_row($resultado)) {
                $cadena=$cadena.'<option value='.$col[0].'>'.utf8_encode($col[3])." ".utf8_encode($col[11]).'</option>';
            }   
            echo  $cadena."</select>";
// Fin auto rellenar el formulario
}


//Agregar datos a la bd 
  if (isset($_POST["listaCat"])) {
    $categoria = intval($_POST['listaCat']);
    $nombre_elemento = $_POST['nombre_elemento'];
    $talla  = intval($_POST['talla']);
    $marca = $_POST['marca'];
    $color = $_POST['color'];
    $cantidad = intval($_POST['listaCant']);
    $nota = $_POST['nota'];
    $conexion->query("INSERT INTO elementos(fkCategoria, fkTalla, elemento, marca, color, existencias, observacion) VALUES (".$categoria.", ".$talla.", '".$nombre_elemento."', '".$marca."', '".$color."', ".$cantidad.", '".$nota."')");
}
