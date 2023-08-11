<?php 
if (!empty($_POST['btnUpd'])){
    if (!empty($_POST['inputNam'])
    AND !empty($_POST['inputMail']) 
    // AND !empty($_POST['inputRol']) 
    ){
     
    $Id= $_POST['inputId'];  // ←llama el ide que recogió el input oculto en la vista
    $Name= $_POST['inputNam'];
    $Tel= $_POST['inputTel'];
    $Mail= $_POST['inputMail'];
    // $Rol= $_POST['inputRol'];
    

    $sqlUsr= $conexion->query("SELECT * FROM usuarios WHERE id= '$Id'");
    
    while ($dataUsr= $sqlUsr->fetch_object()){
      $Id= $dataUsr->id;
    }

  $sqlUpd= $conexion->query("UPDATE usuarios SET user='$Name', telefono='$Tel', email= '$Mail' WHERE id='$Id' "); 

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