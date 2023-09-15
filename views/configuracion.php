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
  <link rel="shortcut icon" href="../assets/senaGreen.png" type="image/x-icon">
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
        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-historial" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Registros</button>
      </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-home-tab">
        <div class="p-4 w-100 h-auto flex justify-content-center align-items-center">
          <h3>Perfil</h3>
          <form id="editProfile">
            <?php $data = $conexion->query("SELECT * FROM usuarios WHERE id=" . $_SESSION['id']);
            while ($tableData = $data->fetch_object()) { ?>
              <div class="d-flex flex-column gap-1 mb-3 w-50">
                <input type="hidden" value="<?= $tableData->id ?>" id="idProfile">
                <label for="nombre" class="form-label">Nombre de Usuario</label>
                <input type="text" value="<?= $tableData->user ?>" class="form-control" name="nombre" placeholder="Nombre de Usuario" id="nombre">
              </div>
              <div class="d-flex flex-column gap-1 mb-3 w-50">
                <label for="telefono" class="form-label">Número de Teléfono</label>
                <input type="number" value="<?= $tableData->telefono ?>" class="form-control" name="telefono" placeholder="Número de Teléfono" id="telefono">
              </div>
              <div class="d-flex flex-column gap-1 mb-3 w-50">
                <label for="email" class="form-label">Correo</label>
                <input type="email" value="<?= $tableData->email ?>" class="form-control" name="email" placeholder="Correo Electronico" id="email">
              </div>
            <?php } ?>
            <button class="btn btn-primary btn-sm" type="submit">Actualizar perfil</button>
          </form>
        </div>
      </div>
      <div class="tab-pane fade" id="nav-users" role="tabpanel" aria-labelledby="nav-profile-tab">
        <div class="p-4 w-100 h-auto d-flex flex-column gap-2">
          <div class="d-flex flex-row gap-4">
            <h3>Gestión de usuarios</h3>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUser">Crear nuevo usuario</button>
          </div>
          <table class="table table-bordered table-striped table-hover table-small table-responsive" style="width: 100%;" id="gestionUsers">
            <thead>
              <th>id</th>
              <th>Nombre</th>
              <th>Telefono</th>
              <th>Email</th>
              <th>Interacción</th>
            </thead>
            <tbody>
              <?php $data = $conexion->query("SELECT * FROM usuarios WHERE rol='user'");
              while ($tableData = $data->fetch_object()) { ?>
                <tr>
                  <td><?= $tableData->id ?></td>
                  <td><?= $tableData->user ?></td>
                  <td><?= $tableData->telefono ?></td>
                  <td><?= $tableData->email ?></td>
                  <td>
                    <a class="btn btn-small btn-warning" data-id="<?= $tableData->id ?>" data-bs-toggle="modal" data-bs-target="#editUser">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                      </svg>
                    </a>
                    <!-- Botón eliminar -->
                    <a onclick="eliminar('<?php echo $tableData->id ?>')" class="btn btn-small btn-danger">
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
      <div class="tab-pane fade" id="nav-categories" role="tabpanel" aria-labelledby="nav-contact-tab">
        <div class="p-4 w-100 h-auto d-flex flex-column gap-2">
          <div class="d-flex flex-row gap-4">
            <h3>Gestionar categorias</h3>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCategories">Crear categoria nueva</button>
          </div>
          <table class="table table-bordered table-striped table-hover table-small table-responsive" style="width: 100%;" id="gestionCategorias">
            <thead>
              <th>id</th>
              <th>Nombre</th>
              <th>Interacción</th>
            </thead>
            <tbody>
              <?php $data = $conexion->query("SELECT * FROM categorias WHERE 1");
              while ($tableData = $data->fetch_object()) { ?>
                <tr>
                  <td><?= $tableData->id ?></td>
                  <td><?= $tableData->nombre ?></td>
                  <td><a onclick="eliminarCategorias('<?php echo $tableData->id ?>')" class="btn btn-small btn-danger">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                      </svg>
                    </a></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="tab-pane fade" id="nav-tallas" role="tabpanel" aria-labelledby="nav-contact-tab">
        <div class="p-4 w-100 h-auto d-flex flex-column gap-2">
          <div class="d-flex flex-row gap-4">
            <h3>Gestionar tallas</h3>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTallas">Crear una talla nueva</button>
          </div>
          <table class="table table-bordered table-striped table-hover table-small table-responsive" style="width: 100%;" id="gestionTallas">
            <thead>
              <th>id</th>
              <th>Nombre</th>
              <th>Interacción</th>
            </thead>
            <tbody>
              <?php $data = $conexion->query("SELECT * FROM tallas WHERE 1");
              while ($tableData = $data->fetch_object()) { ?>
                <tr>
                  <td><?= $tableData->id ?></td>
                  <td><?= $tableData->tallas ?></td>
                  <td>
                    <a onclick="eliminarTallas('<?php echo $tableData->id ?>')" class="btn btn-small btn-danger">
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
      <div class="tab-pane fade" id="nav-historial" role="tabpanel" aria-labelledby="nav-contact-tab">
        <div class="p-4 w-100 h-auto d-flex flex-column gap-2">
          <h3>Historial global</h3>
          <table class="table table-bordered table-striped table-hover table-small table-responsive" style="width: 100%;" id="historyGlobal">
            <thead>
              <th>Fecha</th>
              <th>Cantidad de movimientos</th>
              <th>Interacción</th>
            </thead>
            <tbody>
              <?php $movimientos = $conexion->query("SELECT COUNT(*) AS num_registros, m.fecha, m.* 
              FROM movimiento AS m 
              GROUP BY m.fecha 
              HAVING COUNT(*) > 0");
              while ($m = $movimientos->fetch_object()) { ?>
                <tr>
                  <td><?= $m->fecha ?></td>
                  <td><?= $m->num_registros ?></td>
                  <td><a class="btn btn-small btn-primary" data-id="<?= $m->fecha ?>" data-bs-toggle="modal" data-bs-target="#historyByDay">Historial</a></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade modal-xl" id="historyByDay" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content p-3">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Historial segun el día</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="table table-bordered table-striped table-hover table-small table-responsive" style="width: 100%;" id="modalHistoryByDate">
              <thead>
                <th>Cliente</th>
                <th>Ficha</th>
                <th>Elemento</th>
                <th>Cantidad</th>
                <th>Observación</th>
                <th>Fecha</th>
              </thead>
              <tbody id="bodyhistoryByDay">

              </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="createUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content p-3">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Crear nuevo usuario</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="w-100" id="createUsersForm">
            <div class="d-flex flex-column gap-1 mb-3">
              <input type="hidden" id="idProfile">
              <label for="identUser" class="form-label">Número de documento (*)</label>
              <input type="text" class="form-control" name="identUser" placeholder="C.C 1234567890" id="identUser" required>
            </div>
            <div class="d-flex flex-column gap-1 mb-3">
              <label for="nombre" class="form-label">Nombre de Usuario (*)</label>
              <input type="text" class="form-control" name="nombre" placeholder="Nombre de Usuario" id="nombreUser" required>
            </div>
            <div class="d-flex flex-column gap-1 mb-3">
              <label for="email" class="form-label">Correo (*)</label>
              <input type="email" class="form-control" name="email" placeholder="Correo Electronico" id="emailUser" required>
            </div>
            <div class="d-flex flex-column gap-1 mb-3">
              <label for="telefono" class="form-label">Número de Teléfono</label>
              <input type="text" class="form-control" name="telefono" placeholder="Número de Teléfono" id="telefonoUser">
            </div>
            <div class="d-flex flex-column gap-1 mb-3">
              <label for="password" class="form-label">Contraseña (*)</label>
              <input type="text" class="form-control" name="password" placeholder="Contraseña" id="passUser" required>
            </div>
            <div class="d-flex justify-content-center align-items-center">
              <button type="submit" class="btn btn-success">Crear usuario</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content p-3">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Crear nuevo usuario</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" class="editModalUser">
          <form id="editFormUser">

          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="createCategories" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content p-3">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Crear categoria</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="createCategory">
            <div class="d-flex flex-column gap-1 mb-3">
              <input type="hidden" id="idProfile">
              <label for="category" class="form-label">Nombre</label>
              <input type="text" class="form-control" name="category" placeholder="Nombre de la categoria" id="category" required>
            </div>
            <div class="w-100 d-flex justify-content-center align-items-center">
              <button type="submit" class="btn btn-success btn-small">Crear</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="createTallas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content p-3">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Crear Tallas</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="createTallasForm">
            <div class="d-flex flex-column gap-1 mb-3">
              <input type="hidden" id="idProfile">
              <label for="tallasModal" class="form-label">Nombre</label>
              <input type="text" class="form-control" name="tallasModal" placeholder="Nombre de la categoria" id="tallasModal" required>
            </div>
            <div class="w-100 d-flex justify-content-center align-items-center">
              <button type="submit" class="btn btn-success btn-small">Crear</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
<script src="../csss/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../js/configuracion.js"></script>
<script src="../csss/DataTables/datatables.min.js"></script>
<script src="../csss/bootstrap/js/bootstrap.min.js"></script>
<script src="../csss/DataTables/Responsive-2.5.0/js/responsive.dataTables.js"></script>
<script>
  new DataTable("#gestionUsers", {
    responsive: true,
  })
  new DataTable("#gestionCategorias", {
    responsive: true
  })
  new DataTable("#gestionTallas", {
    responsive: true
  })

  new DataTable("#historyGlobal", {
    responsive: true
  })

  new DataTable("#modalHistoryByDate", {
    responsive: true
  })
  
  function eliminar(id) {
    var id = parseInt(id)
    console.log(id)
    Swal.fire({
      title: '¿Estás seguro que quieres eliminar este elemento?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí',
      cancelButtonText: "Cancelar"
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: 'POST',
          url: '../controllers/user.Delete.controller.php',
          data: {
            usrId: id
          },
          success: () => {
            Swal.fire(
              'Elemento Eliminado',
              'El elemento seleccionado ha sido eliminado exitosamente',
              'success'
            ).then(() => {
              location.reload();
            })
          },
          catch: (error) => {
            console.error(error)
          }
        })
      }
    })

  }

  function eliminarCategorias(id) {
    var id = parseInt(id)
    console.log(id)
    Swal.fire({
      title: '¿Estás seguro que quieres eliminar este elemento?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí',
      cancelButtonText: "Cancelar"
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: 'POST',
          url: '../controllers/addCategorias.controller.php',
          data: {
            id: id
          },
          success: () => {
            Swal.fire(
              'Elemento Eliminado',
              'El elemento seleccionado ha sido eliminado exitosamente',
              'success'
            ).then(() => {
              location.reload();
            })
          },
          catch: (error) => {
            console.error(error)
          }
        })
      }
    })

  }

  function eliminarTallas(id) {
    var id = parseInt(id);
    Swal.fire({
      title: '¿Estás seguro que quieres eliminar este elemento?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí',
      cancelButtonText: "Cancelar"
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: 'POST',
          url: '../controllers/addTallas.controller.php',
          data: {
            id: id
          },
          success: () => {
            Swal.fire(
              'Elemento Eliminado',
              'El elemento seleccionado ha sido eliminado exitosamente',
              'success'
            ).then(() => {
              location.reload();
            })
          },
          catch: (error) => {
            console.error(error)
          }
        })
      }
    })
  }
</script>

</html>