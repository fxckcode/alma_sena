<?php 
if (!empty($_POST['btnUpd'])){
    if (!empty($_POST['inputCat'])
    AND !empty($_POST['inputName']) 
    AND !empty($_POST['inputTalla']) 
    AND !empty($_POST['inputMarca'])
    AND !empty($_POST['inputColor'])
    AND !empty($_POST['inputExists'])){
     
    $Id= $_POST['inputId'];  // ←llama el ide que recogió el input oculto en la vista
    $Cat= $_POST['inputCat'];
    $Name= $_POST['inputName'];
    $Talla= $_POST['inputTalla'];
    $Marca= $_POST['inputMarca'];
    $Color= $_POST['inputColor'];
    $Exists= $_POST['inputExists'];
    $Nota= $_POST['inputNota'];

    $sqlCts= $conexion->query("SELECT * FROM categorias, tallas WHERE nombreCat= '$Cat' and tallas= '$Talla'");
    
    while ($dataCts= $sqlCts->fetch_object()){
      $idCt= $dataCts->idCategoria;
      $idTll= $dataCts->idTalla;
    }

  $sqlUpd= $conexion->query("UPDATE elementos AS e 
    SET e.fkCategoria='$idCt', e.elemento= '$Name', e.fkTalla= '$idTll', e.marca= '$Marca', e.color= '$Color', e.existencias= '$Exists', e.observacion='$Nota' 
    WHERE idElemento='$Id' "); 

if ($sqlUpd==1) {
  // header ("Location:../views/entradas.php");
  echo '<div class="alert alert-success text-center"><strong>Elemento actualizado.</strong></div>';
   
} else {
  header ("Location:../views/entradas.php");
  echo '<div class="alert alert-danger text-center"><strong>ERROR, Revise los parámetros.</strong></div>';
}
    }else {
        echo '<div class="alert alert-warning text-center"><strong>Todos los campos son obligatorios.</strong></div>';
    }
}

?>