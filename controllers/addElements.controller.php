<?php
include ("dbConection.php");
//↓para auto rellenar el formulario

if (isset($_POST['categoria'])) {
$categoria=$_POST['categoria'];
$sql="SELECT * FROM elementos as e, categorias as c, tallas AS t 
where e.fkCategoria=c.idCategoria AND e.fkTalla= t.idTalla AND fkCategoria='$categoria'";


$resultado=mysqli_query($conexion,$sql);
$cadena="<span class='input-group-text bg-success-subtle border-primary'>Elemento</span>
			<select class='listaElem form-select pe-5 border-primary' id='lista2' name='lista2'>";

            while ($col=mysqli_fetch_row($resultado)) {
                $cadena=$cadena.'<option value='.$col[0].'>'.utf8_encode($col[3])." ".utf8_encode($col[11]).'</option>';
            }   
            echo  $cadena."</select>";
// Fin auto rellenar el formulario
}
//Agregar datos a la bd 
if (!empty($_POST["btnAdd"])) {
  if (!empty($_POST["listaCant"])) {
    // echo $_POST["lista2"];
    $idC= $_POST["lista2"];
    $cant= $_POST["listaCant"];
    $nota= $_POST["nota"];
    // echo $idC;
    $sqlId= $conexion->query ("UPDATE `elementos` SET `existencias`= `existencias`+$cant, `observacion` = '$nota' WHERE `elementos`.`idElemento` = $idC");
    if ($sqlId==1) {
      header ("Location:../views/entradas.php");
      echo '<div class="alert alert-success text-center"><strong>Elementos agregados.</strong></div>';
      } else {
        header ("Location:../views/entradas.php");
        echo '<div class="alert alert-danger text-center"><strong>ERROR No se agregaron los elementos.</strong></div>';
  }
  
  }
  else {
    header ("Location:../views/entradas.php");
    echo '<div class="alert alert-danger text-center"><strong>Nada para actualizar.</strong></div>';
}

}
