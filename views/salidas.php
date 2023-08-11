<?php
session_start();
if (empty($_SESSION['id'])) {
  header("Location:../index.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../assets/senaGreen.png" type="image/x-icon">
  <link rel="stylesheet" href="../csss/bootstrap/css/bootstrap.min.css">
  <title>Movimientos</title>
</head>

<body>
  <div class="container-fluid">
    
    <div class="row">
      <div class="btn border-info bg-success text-white mt-4 shadow-sm  col-2">
        <?php 
          echo $_SESSION["nombre"]
        ?>
        <?php
$conexion=mysqli_connect("localhost","root","","almasenadb"); 
$where="";

if(isset($_GET['enviar'])){
  $busqueda = $_GET['busqueda'];


	if (isset($_GET['busqueda']))
	{
		$where="WHERE user.correo LIKE'%".$busqueda."%' OR nombre  LIKE'%".$busqueda."%'
    OR telefono  LIKE'%".$busqueda."%'";
	}
  
}
?>
      </div>

      <div class="col-9">
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link nav-link border-primary-subtle bg-info-subtle" aria-current="page" href="entradas.php">Entradas</a>
          </li>
          <li class="nav-item">
            <p class="nav-link active">Salidas</p>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link border-primary-subtle bg-info-subtle" href="cambios.php">Cambios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link border-primary-subtle bg-info-subtle" href="usuariosGestionar.php">Gestionar Usuarios Cliente</a>
          </li>
        </ul>
      </div>
      <div class="col-1">
        <div>
          <button class="btn btn-danger w-100 mt-4 shadow-sm "><a class="text-decoration-none text-white"
              href="../controllers/logout.php">Salir</a></button>
          <i class="bi bi-box-arrow-left"></i>
        </div>
      </div>
    </div>
  
<hr>
  <div class="form-floating input-group mt-1 justify-content-center align-items-center">
    <H2>A quién se entregarán los elementos?</H2>
  </div>

  <div class="d-flex justify-content-center align-items-center vh-800">
    <div class=" p-5 rounded-5 text-secondary shadow" style="width: 70rem">

<!-- Buscar usuario -->
<form class="d-flex">
      <input class="form-control me-2 light-table-filter" data-table="table_id" type="text" 
      placeholder="Buscar usuario para nueva entrega">
      <hr>
      </form>
      <br>


      <table class="table table-striped table_id ">

                  
                        <thead>    
                        <tr>
                        <th>Nombre</th>
                        <th>Identificación</th>
                        <th>Correo</th>
                        <th>Telefono</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

$conexion=mysqli_connect("localhost","root","","almasenadb");               
$SQL="SELECT usuarios.id, usuarios.user, usuarios.email, usuarios.telefono, usuarios.rol FROM usuarios
$where";
$dato = mysqli_query($conexion, $SQL);

if($dato -> num_rows >0){
    while($fila=mysqli_fetch_array($dato)){
    
?>
<tr>
<td><a class="text-black text-uppercase text-decoration-none" href="salidasPage2.php?usrId=<?= $fila['user']?>"><?php echo $fila['user']; ?></a></td>
<td><a class="text-black text-uppercase text-decoration-none" href="salidasPage2.php?usrId=<?= $fila['user']?>"><?php echo $fila['id']; ?></a></td>
<td><a class="text-black text-uppercase text-decoration-none" href="salidasPage2.php?usrId=<?= $fila['user']?>"><?php echo $fila['email']; ?></a></td>
<td><a class="text-black text-uppercase text-decoration-none" href="salidasPage2.php?usrId=<?= $fila['user']?>"><?php echo $fila['telefono']; ?></a></td>




</tr>


<?php
}
}else{

    ?>
    <tr class="text-center">
    <td colspan="16">No existen registros</td>
    </tr>

    
    <?php
    
}

?>

      <!-- inicio formulario -->

      <!-- fin de formulario -->
    </div>
  </div>

<!-- Script para los elementos select -->
<script type="text/javascript">
	$(document).ready(function(){
		$('#dniCode').val(1);
		recargarLista();

		$('#dniCode').change(function(){
			recargarLista(); 
		});
	})
</script>

<script type="text/javascript">
	function recargarLista(){
		$.ajax({
			type:"POST",
			url:"../controllers/addElements.controller.php",
			data:"categoria=" + $('#dniCode').val(),
			success:function(r){
				$('#select2lista').html(r);
			}
		});
	}
</script>
<script src="../js/acciones.js"></script>
<script src="../js/buscador.js"></script>

</body>

</html>