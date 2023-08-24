<?php
session_start();
if (empty($_SESSION['id'])) {
  header("Location:../index.php");
}
if ($_SESSION['rol'] == 'user') {
  header("Location: ./home.php");
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
  <link rel="stylesheet" href="../csss/DataTables/Responsive-2.5.0/css/responsive.dataTables.min.css">
  <title>Movimientos</title>
  <script src="../utils/jquery/jquery-3.7.0.min.js"></script>
  <link href="../csss/DataTables/datatables.min.css" rel="stylesheet">
  <script src="../utils/package/dist/sweetalert2.all.min.js"></script>
  <script src="../utils/package/dist/sweetalert2.min.css"></script>
  <link rel="stylesheet" href="../csss/generalStyles.css">
</head>

<body class="vh-100">
  <nav class="navbar navbar-expand-lg navbar-light bg-success-subtle p-3">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <?php
        echo "Hola, ";
        echo $_SESSION["nombre"];
        ?>
      </a>
      
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto ">
          <li class="nav-item">
            <a class="nav-link mx-2 active" aria-current="page" href="#">Entradas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2" href="salidas.php">Salidas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2" href="cambios.php">Cambios</a>
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
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>
  <hr />
  <!-- Contenedor formulario -Form container -->
  <div class="container d-flex justify-content-center flex-column">

    <?php
    include '../controllers/addElements.controller.php';
    ?>
    <!-- Button trigger modal -->
    <div class="w-100 d-flex gap-2 mb-3">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarExistencias">
        Agregar existencias
      </button>
      <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#agregarElemento">
        Agregar un elemento
      </button>
    </div>

    <!-- Modal Para agregar existencias -->
    <div class="modal fade" id="agregarExistencias" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content p-3">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar existencias</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
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
      </div>
    </div>

    <!-- Modal Para agregar un elementos nuevo -->
    <div class="modal fade" id="agregarElemento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content p-3">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar un elemento nuevo</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="formAddElement" method="post">
              <div class="input-group mb-3">
                <span class="input-group-text bg-success-subtle border-primary" id="">Categoría</span>
                <select class="listaCat form-select pe-5 border-primary" id="listaCat1" name="listaCat">
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
                <input type="number" class="listaCant form-control border-primary" name="listaCant" id="cantidad" />
              </div>

              <div class="input-group">
                <span class="input-group-text bg-success-subtle border-primary">Nota:</span>
                <textarea class="listaNota form-control border-primary" name="nota" aria-label="With textarea" id="notaCreate"></textarea>
              </div>
              <div>
                <input class="btn btn-success text-white w-100 mt-2 fw-semibold shadow-sm mb-1" name="btnAdd" type="submit" value="Agregar" />
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Listado de elementos -->
    <table id="tableInventario" class="table table-striped table-bordered table-responsive table-hover nowrap" style="width: 100%;">
      <thead class="formColumn">
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
            <td>
            <!-- href="modificarElementos.php?id=<?= $tableData->idElemento ?>" -->
              <!-- Botón editar -->
              <a class="btn btn-small btn-warning"  data-id="<?= $tableData->idElemento ?>" data-bs-toggle="modal" data-bs-target="#editElements">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                </svg>
              </a>
              <!-- Botón eliminar -->
              <a onclick="eliminar('<?php echo $tableData->idElemento; ?>')" class="btn btn-small btn-danger">
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
    <div class="modal fade" id="editElements" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content p-3">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Elemento</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Generate form -->
            <form method="post" id="editForm" action="../controllers/updElements.controller.php">

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <hr />
  <!-- fin de formulario -->

  <!-- Script para borrar los alerts -->
  <script src="../csss/DataTables/datatables.min.js"></script>
  <script>
    new DataTable("#tableInventario", {
      responsive: true 
    })
  </script>
  <script src="../js/entradas.js"></script>
  <script src="../js/elementosGestionar.js"></script>
  <script src="../csss/bootstrap/js/bootstrap.min.js"></script>
  <script src="../csss/DataTables/Responsive-2.5.0/js/responsive.dataTables.js"></script>
</body>

</html>