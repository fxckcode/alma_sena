<?php
session_start();
if ($_SESSION['rol'] == 'admin') {
    header("Location: ./entradas.php");
}
include("../controllers/dbConection.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../assets/senaGreen.png" type="image/x-icon" />
    <!-- BootStrap -->
    <link rel="stylesheet" href="../csss/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../csss/DataTables/Responsive-2.5.0/css/responsive.dataTables.min.css">
    <title>Inicio</title>
    <script src="../utils/jquery/jquery-3.7.0.min.js"></script>
    <link href="../csss/DataTables/datatables.min.css" rel="stylesheet">
    <script src="../utils/package/dist/sweetalert2.all.min.js"></script>
    <script src="../utils/package/dist/sweetalert2.min.css"></script>
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
            <a class="nav-link mx-2 active" aria-current="page" href="#">Inventario</a>
            <div>
                <button class="btn btn-danger shadow-sm">
                    <a class="text-decoration-none text-white" href="../controllers/logout.php">Cerrar Sesión</a>
                </button>
                <i class="bi bi-box-arrow-left"></i>
            </div>
        </div>
    </nav>
    <div class="container flex flex-column gap-6 mt-3">
        <div class="d-flex gap-3 align-items-center">
            <h3>Inventario Actual</h3>
            <a class="fw-bold pointer text-info pe-auto" data-bs-toggle="modal" data-id="<?= $_SESSION['id'] ?>" data-bs-target="#historialMovimientosUser" style="cursor: pointer;">Historial de entregas</a>
        </div>
        <table id="tableInventarioUser" class="table table-striped table-bordered table-responsive table-hover nowrap" style="width: 100%;">
            <thead class="bg-info">
                <tr>
                    <th scope="col">Categoría</th>
                    <th scope="col">Elemento</th>
                    <th scope="col">Talla</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Color</th>
                    <th scope="col">Existencias</th>
                    <th scope="col">Observación</th>
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
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="modal fade modal-xl" id="historialMovimientosUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content p-3">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Historial de entregas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-striped table-hover table-small" id="tableHistorial" style="width: 100%;">
                        <thead>
                            <th scope="col">id</th>
                            <th scope="col">Elemento</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Observación</th>
                            <th scope="col">Fecha</th>
                        </thead>
                        <tbody id="bodyHistorialUser">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../csss/DataTables/datatables.min.js"></script>
<script>
    new DataTable('#tableInventarioUser', {
        responsive: true,
    });

    new DataTable('#tableHistorial', {
        responsive: true,
    });

    $("#historialMovimientosUser").on("show.bs.modal", (event) => {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var tbody = $("#bodyHistorialUser");

        $.ajax({
            url: '../controllers/getMovimiento.controller.php',
            type: 'GET',
            data: {
                id: id
            }, success: (response) => {
                var data = JSON.parse(response)
                console.log(data);
                var rowsHtml = data.map(element => `
                    <tr>
                        <td>${element.idMovimiento}</td>
                        <td>${element.elemento}</td>
                        <td>${element.cantidad}</td>
                        <td>${element.observacion}</td>
                        <td>${element.fecha}</td>
                    </tr>
                `).join('');
                tbody.html(rowsHtml)
            }
        })
    })
</script>
<script src="../csss/bootstrap/js/bootstrap.min.js"></script>
<script src="../csss/DataTables/Responsive-2.5.0/js/responsive.dataTables.min.js"></script>

</html>