<?php
session_start();
if (empty($_SESSION['id'])) {
  header("Location:../index.php");
}
include("../controllers/dbConection.php");
include("../controllers/addElements.controller.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="../assets/senaGreen.png" type="image/x-icon" />
  <!-- BootStrap -->
  <link rel="stylesheet" href="../csss/bootstrap/css/bootstrap.min.css" />
  <title>Movimientos</title>
  <script src="../utils/jquery/jquery-3.7.0.min.js"></script>
  <link href="../csss/DataTables/datatables.min.css" rel="stylesheet">
  <script src="../utils/package/dist/sweetalert2.all.min.js"></script>
  <script src="../utils/package/dist/sweetalert2.min.css"></script>
</head>

<body class="vh-100">
  <!-- Tabs-Pestañas  -->
  <div class="container-fluid d-flex flex-row gap-3">
    <div class="fw-bold fs-6 w-100 sm-fs-2 text-uppercase d-flex align-items-center justify-content-center">
      <?php
      echo $_SESSION["nombre"];
      echo " | rol: ";
      echo $_SESSION['rol'];
      ?>
    </div>
    <div class="col-9 justify-content-center">
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <p class="nav-link active">Entradas</p>
        </li>
        <li class="nav-item">
          <a class="nav-link border-primary-subtle bg-info-subtle" href="salidas.php">Salidas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link border-primary-subtle bg-info-subtle" href="cambios.php">Cambios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link border-primary-subtle bg-info-subtle" href="elementosGestionar.php">Agregar un elemento nuevo.</a>
        </li>
      </ul>
    </div>
    <!-- Salir-LogOut -->
    <div class="col-1">
      <div>
        <button class="btn btn-danger w-100 mt-4 shadow-sm">
          <a class="text-decoration-none text-white" href="../controllers/logout.php">Salir</a>
        </button>
        <i class="bi bi-box-arrow-left"></i>
      </div>
    </div>
  </div>
  <hr />

  <!-- Contenedor formulario -Form container -->
  <div class="container-fluid row">
    <!-- Formulario de adición -->
    <div class="col-lg-4 col-sm-12 col-xs-12">
      <!-- Título-Title -->
      <div class="w-100 d-flex justify-content-center align-items-center border-primary mb-3">
        <span class="text-danger text-uppercase">
          Agregar existencias al inventario</span>
      </div>

      <?php
      include '../controllers/delElements.controller.php';
      include '../controllers/addElements.controller.php';
      ?>


      <form method="post" id="formAddCant">
        <div class="input-group mb-3">
          <span class="input-group-text bg-success-subtle border-primary" id="">Categoría</span>
          <select class="listaCat form-select pe-5 border-primary" id="listaCat" name="">
            <?php
            $sqlCategorias = $conexion->query("SELECT * FROM categorias WHERE 1");
            while ($categorias = $sqlCategorias->fetch_object()) {
            ?>
              <option value="<?= $categorias->idCategoria ?>"><?= $categorias->nombreCat ?></option>
            <?php } ?>
          </select>
        </div>

        <!-- contenedor para el select nombre -->
        <div class="input-group mb-3" id="select2lista" name="select2lista"></div>

        <!-- <div class="input-group mb-3">
          <span class="input-group-text bg-success-subtle border-primary">Marca></span>
          <input type="text" class="form-control border-primary" name="marca">
        </div> -->

        <div class="input-group mb-3">
          <span class="input-group-text bg-success-subtle border-primary">Cantidad</span>
          <input type="number" class="listaCant form-control border-primary" name="listaCant" id="listaCant" />
        </div>

        <div class="input-group">
          <span class="input-group-text bg-success-subtle border-primary">Nota:</span>
          <textarea class="listaNota form-control border-primary" name="nota" aria-label="With textarea" id="nota"></textarea>
        </div>

        <div>
          <input class="btn btn-success text-white w-100 mt-2 fw-semibold shadow-sm mb-1" name="btnAdd" type="submit" value="Agregar" />
        </div>
      </form>
    </div>
    <!-- ------------------------------------------------------------------------------------------------------ -->

    <!-- Listado de elementos -->
    <div class="col-lg-8 col-sm-12 col-xs-12">
      <table id="tableInventario" class="table table-striped table-bordered table-responsive">
        <thead class="bg-info">
          <tr>
            <th scope="col">Categoría</th>
            <th scope="col">Elemento</th>
            <th scope="col">Talla</th>
            <th scope="col">Marca</th>
            <th scope="col">Color</th>
            <th scope="col">Existencias</th>
            <th scope="col">Observación</th>
            <th scope="col">Edición</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sqlElm = $conexion->query("SELECT * FROM elementos as e, categorias as c, tallas
            as t where e.fkCategoria=c.idCategoria AND e.fkTalla=t.idTalla");
          while ($tableData = $sqlElm->fetch_object()) { ?>
            <tr>
              <td><?= $tableData->nombreCat ?></td>
              <td><?= $tableData->elemento ?></td>
              <td><?= $tableData->tallas ?></td>
              <td><?= $tableData->marca ?></td>
              <td><?= $tableData->color ?></td>
              <td><?= $tableData->existencias ?></td>
              <td><?= $tableData->observacion ?></td>
              <td class="d-flex flex-row gap-1">
                <!-- Botón editar -->
                <a class="btn btn-small btn-warning" href="modificarElementos.php?id=<?= $tableData->idElemento ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                  </svg>
                </a>
                <!-- Botón eliminar -->
                <a onclick="return eliminar('<?php echo $tableData->idElemento; ?>')" class="btn btn-small btn-danger">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                  </svg>
                </a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  <hr />
  <!-- fin de formulario -->

  <!-- Script para borrar los alerts -->
  <script src="../csss/DataTables/datatables.min.js"></script>
  <script>
    new DataTable("#tableInventario")
  </script>
  <script src="../js/entradas.js"></script>
</body>

</html>