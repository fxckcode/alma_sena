<?php
session_start();
if (empty($_SESSION['id'])) {
  header("Location:../index.php");
}
?>

<!-- ↓Consulta los datos del elemento cuyo id viene desde el botón editar de la vista entradas -->
<?php
	include ("../controllers/dbConection.php");
	$id= $_GET['id'];
	$sql= $conexion->query("SELECT * FROM usuarios WHERE id='$id'");
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../assets/senaGreen.png" type="image/x-icon">
  <!-- ↓BootStrap -->
  <link rel="stylesheet" href="../csss/bootstrap/css/bootstrap.min.css">
  <title>Movimientos</title>
  <script
	src="https://code.jquery.com/jquery-3.3.1.min.js"
	integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
	crossorigin="anonymous"></script>
</head>

<body class="vh-100">
  
    <div class="container-fluid">
        <div class="row">
            <!-- ↓Título-Title -->
            <div class="col-2 btn border-info bg-success text-white mt-2 shadow-sm ">
                <?php 
          echo $_SESSION["nombre"]
          ?>
      </div>
      <!-- ↓Tabs-Pestañas  -->
      <div class="col-9">
		    <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link nav-link border-primary-subtle bg-info-subtle" aria-current="page" href="entradas.php">Entradas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link border-primary-subtle bg-info-subtle" href="salidas.php">Salidas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link border-primary-subtle bg-info-subtle" href="cambios.php">Cambios</a>
          </li>
          <li class="nav-item">
            <p class="nav-link active">Editar Elementos</p>
          </li>
        </ul>
    	</div>
      <!-- ↓Salir-LogOut -->
      <div class="col-1">
        <button class="btn btn-danger w-100 mt-2 shadow-sm "><a class="text-decoration-none text-white"
          href="../controllers/logout.php">Salir</a>
        </button>
        <i class="bi bi-box-arrow-left"></i>
      </div>
    </div>
    <hr>


    <!-- ↓Contenedor formulario -Form container -->
  <div class="container-fluid">
	<div class="row">
		<!-- ↓Formulario de adición -->
    <div class="col-4">
      <form action="" method="post">
        <!-- ↓Input recoje el id recibido desde la vista, Permite llamarlo desde el controlador -->
		<div class="input-group mb-3">
		<span class="input-group-text bg-success-subtle border-primary" id="">Identificación</span>
      <input type="inputId" id="inputId" name="inputId" value="<?= $_GET['id'] ?>" >
	</div>
        <?php 
        include ("../controllers/usersUpdController.php");
        while($elmData= $sql->fetch_object()) { ?>
          
          <div class="input-group mb-3">
			      <span class="input-group-text bg-success-subtle border-primary" id="">Nombre</span>
			      <input select class="inputUser pe-5 form-control border-primary" id="inputNam" name="inputNam" value="<?= $elmData->user?>">
		      </div>

			  <div class="input-group mb-3">
			      <span class="input-group-text bg-success-subtle border-primary" id="">Teléfono</span>
			      <input select class="inputUser pe-5 form-control border-primary" id="inputNam" name="inputTel" value="<?= $elmData->telefono?>">
		      </div>	  

          <div class="input-group mb-3">
			      <span class="input-group-text bg-success-subtle border-primary" id="">Correo</span>
			      <input select class="inputMail pe-5 form-control border-primary" id="inputMail" name="inputMail" value="<?= $elmData->email?>">
		      </div>

          <!-- <div class="input-group mb-3">	
			      <span class="input-group-text bg-success-subtle border-primary">Rol</span>
			      <input type="text" class="inputRol form-control border-primary " id="inputRol" name="inputRol" value="<?= $elmData->rol?>">
		      </div>  -->
		      <div>
		        <input class="btn btn-warning text-white w-100 mt-2 fw-semibold shadow-sm mb-1" 
		        name="btnUpd" type="submit" value="Actualizar">
          </div>
    <?php }
    ?>
		
  </form>
  </div>
<!-- ↑Fin del formulario -->

<!-- ------------------------------------------------------------------------------------------------------ -->
			<!-- ↓Listado de usuarios -->
	<div class="col-8">
		<table class="table table-bordered border-primary">
			<thead class="bg-info">
				<tr>
					<th scope="col">Identificación</th>
					<th scope="col">Nombre</th>
					<th>Teléfono</th>
					<th scope="col">Correo</th>
					<th scope="col">Rol</th>
				</tr>
			</thead>
<tbody>
	<?php
		$sqlUsr= $conexion->query("SELECT * FROM usuarios WHERE rol= 'cliente'");
		while($tableData= $sqlUsr->fetch_object()) {
			?>
			<tr>
				<td><?= $tableData->id?></td>
				<td><?= $tableData->user?></td>
				<td><?= $tableData->telefono?></td>
				<td><?= $tableData->email?></td>
				<td><?= $tableData->rol?></td>
				<td>
				<!-- ↓Botón editar -->
				<a class="btn btn-small btn-warning" name="btnEdit" href="usuariosEditar.php?id=<?= $tableData->id?>"><svg
						xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
						class="bi bi-pencil-square" viewBox="0 0 16 16">
						<path
							d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
						<path fill-rule="evenodd"
							d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
					</svg>
				</a>
        <!-- ↓Botón eliminar -->
				<a class="btn btn-small btn-danger" name="btnDelete" href=""><svg
						xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
						class="bi bi-trash" viewBox="0 0 16 16">
						<path
							d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
						<path
							d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
					</svg>
				</a>
				

				</td>
			</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<hr>
        <!-- ↑fin de Listado de elementos -->
      </div>
    </div>
  </div>

  <!-- ↓Script para borrar los alerts -->
  <script>
    //↓AutoCierre
   window.setTimeout(function() {
    $(".alert").fadeTo(2500, 0).slideDown(1000, function(){
        $(this).remove(); 
    });
   }, 2000); //←2 segundos y desaparece
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</body>

</html>