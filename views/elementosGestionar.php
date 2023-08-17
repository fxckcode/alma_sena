<?php
session_start();
if (empty($_SESSION['id'])) {
  header("Location:../index.php");
}
?>

<?php
include("../controllers/dbConection.php");
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
  <script src="../utils//jquery/jquery-3.7.0.min.js"></script>
  <script src="../utils/package/dist/sweetalert2.all.min.js"></script>
  <script src="../utils/package/dist/sweetalert2.min.css"></script>
  <link rel="stylesheet" href="../csss/DataTables/datatables.min.css">
</head>

<body class="vh-100 w-full">
  <nav class="navbar navbar-expand-lg navbar-light bg-success-subtle p-3">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <?php
        echo $_SESSION["nombre"];
        echo " | rol: ";
        echo $_SESSION['rol'];
        ?>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class=" collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto ">
          <li class="nav-item">
            <a class="nav-link mx-2" href="entradas.php">Entradas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2" href="salidas.php">Salidas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2" href="cambios.php">Cambios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 active" aria-current="page" href="#">Agregar Elementos</a>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto d-none d-lg-inline-flex">
          <li class="nav-item mx-2">
            <a class="nav-link text-dark h5" href="" target="blank"><i class="fab fa-google-plus-square"></i></a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link text-dark h5" href="" target="blank"><i class="fab fa-twitter"></i></a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link text-dark h5" href="" target="blank"><i class="fab fa-facebook-square"></i></a>
          </li>
        </ul>
      </div>
      <div>
        <button class="btn btn-danger shadow-sm">
          <a class="text-decoration-none text-white" href="../controllers/logout.php">Cerrar Sesión</a>
        </button>
        <i class="bi bi-box-arrow-left"></i>
      </div>
    </div>
  </nav>
  <hr />

  <!-- ------------------------------------------------------------------------------------------------------ -->

  <div class="container-fluid row">
    <!-- Formulario de adición -->
    <div class="col">
      <?php
      include("../controllers/elementosGestionarController.php");
      ?>
      <div class="col-lg-12">
        <div class="p-3 shadow rounded">
          <h4 class="text-success fw-bold text-center">Crear un nuevo Elemento</h4>
          <br>
          <form id="formAddElement" method="post">
            <div class="input-group mb-3">
              <span class="input-group-text bg-success-subtle border-primary" id="">Categoría</span>
              <select class="listaCat form-select pe-5 border-primary" id="listaCat" name="listaCat">
                <?php
                $sqlCategorias = $conexion->query("SELECT * FROM categorias WHERE 1");
                while ($categorias = $sqlCategorias->fetch_object()) {
                ?>
                  <option value="<?= $categorias->idCategoria ?>"><?= $categorias->nombreCat ?></option>
                <?php } ?>
              </select>
            </div>

            <div class="input-group mb-3">
              <span class="input-group-text bg-success-subtle border-primary">Nombre</span>
              <input type="text" class="form-control border-primary" name="nombre_elemento" id="nombre_elemento">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text bg-success-subtle border-primary" id="">Tallas</span>
              <select class="listaCat form-select pe-5 border-primary" id="talla" name="talla">
                <option value="">Seleccionar...</option>
                <?php
                $sqlTallas = $conexion->query("SELECT * FROM tallas WHERE 1");
                while ($tallas = $sqlTallas->fetch_object()) {
                ?>
                  <option value="<?= $tallas->idTalla ?>"><?= $tallas->tallas ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text bg-success-subtle border-primary">Marca</span>
              <input type="text" class="form-control border-primary" name="marca" id="marca">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text bg-success-subtle border-primary">color</span>
              <input type="text" class="form-control border-primary" name="color" id="color">
            </div>
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
      </div>
      <div class="col-lg-12">
        <div class="p-3 shadow rounded">
          <h4 class="text-uppercarse text-primary fw-bold text-center">Añadir Categorias</h4>
          <br>
          <form id="formAddCategoria" method="post">
            <div class="input-group">
              <span class="input-group-text bg-success-subtle border-primary">Nueva Categoría</span>
              <input type="text" class="form-control border-primary" name="nombre" required id="nombreCategoria" />
            </div>
            <input class="btn btn-success text-white w-100 mt-2 fw-semibold shadow-sm mb-1" name="btnAddCategoria" type="submit" value="Crear Categoría" id="btnAddCategoria" />
          </form>
        </div>
      </div>
    </div>
    <!-- ------------------------------------------------------------------------------------------------------ -->

    <!-- Listado de elementos -->
    <div class="col-12 col-lg-8 mt-4">
      <div class="col">
        <div class="p-3 shadow rounded">
          <table class="table table-striped table-bordered table-responsive" id="tableInventario" style="overflow-x: auto;">
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
    </div>
  </div>
  <hr />
  <script src="../csss/DataTables/datatables.min.js"></script>
  <script src="../js/elementosGestionar.js"></script>
  <script src="../csss/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>