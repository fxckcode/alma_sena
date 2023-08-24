<?php
session_start();
if (empty($_SESSION['id'])) {
  header("Location:../index.php");
}
if ($_SESSION['rol'] == 'user') {
  header("Location: ./home.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../assets/senaGreen.png" type="image/x-icon">
  <link rel="stylesheet" href="../csss/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../csss/DataTables/Responsive-2.5.0/css/responsive.dataTables.min.css">
  <script src="../utils/jquery/jquery-3.7.0.min.js"></script>
  <link href="../csss/DataTables/datatables.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../csss/generalStyles.css">
  <title>Movimientos</title>
</head>

<body class="vh-100">
  <?php
  $conexion = mysqli_connect("localhost", "root", "", "almasenadb");
  $where = "";

  if (isset($_GET['enviar'])) {
    $busqueda = $_GET['busqueda'];


    if (isset($_GET['busqueda'])) {
      $where = "WHERE user.correo LIKE'%" . $busqueda . "%' OR nombre  LIKE'%" . $busqueda . "%'
    OR telefono  LIKE'%" . $busqueda . "%'";
    }
  }
  ?>
  <nav class="navbar navbar-expand-lg navbar-light bg-success-subtle p-3">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <?php
        echo "Hola, ";
        echo $_SESSION["nombre"];
        ?>
      </a>
      
      <div class=" collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto ">
          <li class="nav-item">
            <a class="nav-link mx-2" href="entradas.php">Entradas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 active" aria-current="page" href="#">Salidas</a>
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
  <div class="container flex flex-column gap-6">
    <hr>
    <div class="form-floating input-group mt-1 justify-content-center align-items-center mb-4">
      <H3 class="text-success">A quién se entregarán los elementos?</H3>
    </div>


    <!-- Buscar usuario -->
    <form class="d-flex">
      <input class="form-control me-2 light-table-filter" data-table="table_id" type="text" placeholder="Buscar usuario para nueva entrega">
      <hr>
    </form>
    <br>


    <table id="usersTable" class="table table-striped table_id table-bordered table-responsive table-hover nowra" style="width: 100%;">


      <thead>
        <tr class="formColumn">
          <th scope="col">Nombre</th>
          <th scope="col">Identificación</th>
          <th scope="col">Correo</th>
          <th scope="col">Telefono</th>
          <th scope="col">Interacción</th>
        </tr>
      </thead>
      <tbody>
        <?php

        $conexion = mysqli_connect("localhost", "root", "", "almasenadb");
        $SQL = "SELECT usuarios.id, usuarios.user, usuarios.email, usuarios.telefono, usuarios.rol FROM usuarios
$where";
        $dato = mysqli_query($conexion, $SQL);

        if ($dato->num_rows > 0) {
          while ($fila = mysqli_fetch_array($dato)) {

        ?>
            <tr>
              <td><?php echo $fila['user']; ?></td>
              <td><?php echo $fila['id']; ?></td>
              <td><?php echo $fila['email']; ?></td>
              <td><?php echo $fila['telefono']; ?></td>
              <td><span class="btn btn-small btn-success">Generar Entrega</span></td>
            </tr>


          <?php
          }
        } else {

          ?>
          <tr class="text-center">
            <td colspan="16">No existen registros</td>
          </tr>


        <?php

        }

        ?>

        <!-- inicio formulario -->
      </tbody>
    </table>
  </div>

</body>
<!-- fin de formulario -->

<!-- Script para los elementos select -->
<script type="text/javascript">
  $(document).ready(function() {
    $('#dniCode').val(1);
    recargarLista();

    $('#dniCode').change(function() {
      recargarLista();
    });
  })
</script>

<script type="text/javascript">
  function recargarLista() {
    $.ajax({
      type: "POST",
      url: "../controllers/addElements.controller.php",
      data: "categoria=" + $('#dniCode').val(),
      success: function(r) {
        $('#select2lista').html(r);
      }
    });
  }
</script>
<script src="../js/acciones.js"></script>
<script src="../js/buscador.js"></script>
<script src="../csss/DataTables/datatables.min.js"></script>
  <script>
    new DataTable("#usersTable", {
      responsive: true 
    })
  </script>
  <script src="../js/entradas.js"></script>
  <script src="../js/elementosGestionar.js"></script>
  <script src="../csss/bootstrap/js/bootstrap.min.js"></script>
  <script src="../csss/DataTables/Responsive-2.5.0/js/responsive.dataTables.js"></script>
</body>

</html>