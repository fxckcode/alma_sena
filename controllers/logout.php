<script src="../utils/jquery/jquery-3.7.0.min.js"></script>

<script>
    $('[data-clicked^="clicked-"]').each(function() {
  localStorage.setItem($(this).attr('data-clicked'), false);
});
    window.onload = () => {
        localStorage.clear();
        $('[data-clicked]').attr('data-clicked', false);
    }
</script>
<?php
session_start();
session_destroy();
header('location:../index.php');
include("../controllers/dbConection.php");
$conexion->query("DELETE FROM carrito WHERE 1");
?>