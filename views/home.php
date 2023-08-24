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
    <div class="container flex flex-column gap-6">
        <h3>Inventario Actual</h3>
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
</body>
<script src="../csss/DataTables/datatables.min.js"></script>
<script>
    new DataTable('#tableInventarioUser', {
        responsive: true,
    });
</script>
<script src="../csss/bootstrap/js/bootstrap.min.js"></script>
<script src="../csss/DataTables/Responsive-2.5.0/js/responsive.dataTables.min.js"></script>
</html>