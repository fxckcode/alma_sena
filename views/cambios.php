
<?php session_start();
if (empty($_SESSION['id'])) {
  header("Location:../index.php");
}
if ($_SESSION['rol'] == 'user') {
  header("Location: ./home.php");
}
include("../controllers/dbConection.php"); ?>

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
  <nav class="navbar navbar-expand-lg navbar-light bg-success-subtle p-3">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <?php
        echo "Hola, ";
        echo $_SESSION["nombre"];
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
            <a class="nav-link mx-2 active" aria-current="page" href="#">Cambios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2" href="configuracion.php">Configuración</a>
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
  <div class="container p-4">
    <h4 class="mb-3">Seleccione el registro que quiera generar el cambio</h4>
    <table class="table table-bordered table-striped table-hover table-small table-responsive" style="width: 100%;">
      <thead>
        <th>Cliente</th>
        <th>Fecha</th>
        <th>Interacción</th>
      </thead>
      <tbody>
        <?php $data = $conexion->query("SELECT m.*, u.* FROM movimiento as m JOIN usuarios as u ON m.tomador = u.id WHERE m.tipo_movimiento='salida'");
        while ($tableData = $data->fetch_object()) { ?>
          <tr>
            <td><?= $tableData->user ?> <br> Ficha: <?= $tableData->ficha ?></td>
            <td><?= $tableData->fecha ?></td>
            <td></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <script src="../csss/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>