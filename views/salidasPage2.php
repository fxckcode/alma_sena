<?php
session_start();
if (empty($_SESSION['id'])) {
  header("Location:../index.php");
}
?>

<!-- ↓Consulta los datos del elemento cuyo id viene desde el botón editar de la vista entradas -->
<?php
	include ("../controllers/dbConection.php");
	$usrId= $_GET['usrId'];
	$selUsr= $conexion->query("SELECT * FROM usuarios where id= '$usrId'");
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
          
        </div>
      </div>
    </div>
  </div>
  
<hr>
  <div class="container">
    <div class="row">
      <div class="col-10 ">
        <H2>Relacione los elementos para entregar a <strong><?php echo $usrId ?></strong></H2>
        <!-- <input type="text" value="<?= $_GET['usrId'] ?>"> -->
      </div>
      <div class="col ">
<button class="btn btn-success  shadow-sm "><a class="text-decoration-none text-white"
              href="../controllers/logout.php">Ver Lista 
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
              </svg></a></button>
      </div>
    </div>
  </div>

<div class="container-fluid">
    <div class="p-4 rounded-5 shadow">

<!-- Buscar elemento -->

      <input class="form-control me-2 light-table-filter" data-table="table_id" type="text" 
      placeholder="Buscar elemento para nueva entrega">

      <table class="table table-striped table_id ">

                  
                        <thead>    
                        <tr>
                        <!-- <th>Categoría</th> -->
                        <th>Elemento</th>
                        <th>Talla</th>
                        <!-- <th>Marca</th> -->
                        <!-- <th>Color</th> -->
                        <th>Disponibles</th>
                        <th>Observación</th>
                        <th>Cantidad solicitada</th>
                        <th>Estado</th>
                        </tr>
                        </thead>
                        <tbody>

<?php

$conexion=mysqli_connect("localhost","root","","almasenadb");               
$SQL="SELECT * FROM elementos as e, categorias as c, tallas
as t where e.fkCategoria=c.idCategoria AND e.fkTalla=t.idTalla
"; 
 //$where
$dato = mysqli_query($conexion, $SQL);
$resultado= mysqli_num_rows($dato);
?>

<h5>Encontrados <?php echo $resultado; ?> elementos </h5>
<?php
if($dato -> num_rows >0){
while($fila=mysqli_fetch_array($dato)){
?>


<tr>
<!-- <td><?php echo $fila['nombreCat']; ?></td> -->
<td><?php echo $fila['elemento']; ?></td>
<td><?php echo $fila['tallas']; ?></td>
<!-- <td><?php echo $fila['marca']; ?></td> -->
<!-- <td><?php echo $fila['color']; ?></td> -->
<td><?php echo $fila['existencias']; ?></td>
<td><?php echo $fila['observacion']; ?></a></td>
<td><input type="number" name="cantSol" id="cantSol"></td>
<td><a class="text-black text-uppercase text-decoration-none" href="lista.php?id=<?= $fila['idElemento']?>">Check</a></td>
</tr>

<?php
}
}else{
    ?>
    <tr class="text-center">
    <td colspan="7">No existen registros</td>
    </tr>
    <?php
}
?>
    </div>
    
    
  </div>
  



<script src="../js/acciones.js"></script>
<script src="../js/buscador.js"></script>

</body>

</html>