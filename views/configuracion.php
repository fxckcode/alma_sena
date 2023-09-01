<?php session_start();
if (empty($_SESSION['id'])) {
  header("Location:../index.php");
}
if ($_SESSION['rol'] == 'user') {
  header("Location: ./home.php");
}
include("../controllers/dbConection.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- BootStrap -->
  <link rel="stylesheet" href="../csss/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../csss/DataTables/Responsive-2.5.0/css/responsive.dataTables.min.css">
  <title>Configuración</title>
  <script src="../utils/jquery/jquery-3.7.0.min.js"></script>
  <link href="../csss/DataTables/datatables.min.css" rel="stylesheet">
  <script src="../utils/package/dist/sweetalert2.all.min.js"></script>
  <script src="../utils/package/dist/sweetalert2.min.css"></script>
  <link rel="stylesheet" href="../csss/generalStyles.css">
</head>

<body class="vh-100 d-flex flex-column">
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
            <a class="nav-link mx-2" aria-current="page" href="entradas.php">Entradas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2" href="salidas.php">Salidas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 active" href="configuracion.php">Configuración</a>
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
  <div class="w-full container p-4">
    <nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Perfil</button>
        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-users" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Usuarios</button>
        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-categories" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Categorias</button>
        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-tallas" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Tallas</button>
      </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-home-tab">
        <div class="p-4 w-100 h-auto flex justify-content-center align-items-center">
          <h1>Perfil</h1>
          <form id="editProfile">
            <?php $data = $conexion->query("SELECT * FROM usuarios WHERE id=" . $_SESSION['id']);
            while ($tableData = $data->fetch_object()) { ?>
              <div class="d-flex flex-column gap-1 mb-3 w-50">
                <label for="" class="form-label">Nombre de Usuario</label>
                <input type="text" value="<?= $tableData->user ?>" class="form-control" placeholder="Nombre de Usuario">
              </div>
              <div class="d-flex flex-column gap-1 mb-3 w-50">
                <label for="" class="form-label">Número de Teléfono</label>
                <input type="number" value="<?= $tableData->telefono ?>" class="form-control" placeholder="Número de Teléfono">
              </div>
              <div class="d-flex flex-column gap-1 mb-3 w-50">
                <label for="" class="form-label">Correo</label>
                <input type="email" value="<?= $tableData->email ?>" class="form-control" placeholder="Correo Electronico">
              </div>
            <?php } ?>
            <button class="btn btn-primary btn-sm" type="submit">Actualizar perfil</button>
          </form>
        </div>
      </div>
      <div class="tab-pane fade" id="nav-users" role="tabpanel" aria-labelledby="nav-profile-tab">
        <h1>Perfil</h1>
        <p>Aquí puedes ver tu perfil de usuario.</p>
      </div>
      <div class="tab-pane fade" id="nav-categories" role="tabpanel" aria-labelledby="nav-contact-tab">
        <h1>Contacto</h1>
        <p>Contáctanos para cualquier duda o sugerencia.</p>
      </div>
      <div class="tab-pane fade" id="nav-tallas" role="tabpanel" aria-labelledby="nav-contact-tab">
        <h1>Tallas</h1>
      </div>
    </div>
  </div>
</body>
<script src="../csss/bootstrap/js/bootstrap.bundle.min.js"></script>

</html>