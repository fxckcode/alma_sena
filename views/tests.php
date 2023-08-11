<!DOCTYPE html>
<html lang="es">

<head>
	<link rel="stylesheet" href="./tests.css">
	<link rel="stylesheet" href="../csss/bootstrap/css/bootstrap.min.css">
	<link rel="shortcut icon" href="../assets/senaGreen.png" type="image/x-icon">
	<script>
		function showDiv1() {
			document.getElementById('div1').style.display = '';
			document.getElementById('div2').style.display = 'none';
			document.getElementById('div3').style.display = 'none';
		}

		function showDiv2() {
			document.getElementById('div1').style.display = 'none';
			document.getElementById('div2').style.display = '';
			document.getElementById('div3').style.display = 'none';
		}
		function showDiv3() {
			document.getElementById('div1').style.display = 'none';
			document.getElementById('div2').style.display = 'none';
			document.getElementById('div3').style.display = '';
		}
	</script>
</head>

<body>
	<input type="submit" value="Seguros para perros" onclick="showDiv1()">
	<a> | </a><br><input type="submit" value="Seguros para gatos" onclick="showDiv2()">
	<a> | </a><br><input type="submit" onclick="showDiv3()" value="Seguros para otros">
	<br>
	<div class="div1" id="div1" style="">
		
	</div>
	<div class="div2" id="div2" style="display: none">
		Seguro para gatos<br>
		Seguro1 <br>
		Seguro no ole!<br>
		Seguro3
	</div>
	<div class="div3" id="div3" style="display: none">
		Seguro que si otros<br>
		Segurolas Sam <br>
		Seguro3
	</div>

	<hr>

	<div class="container-fluid">
		<div class="row">

		<?php
        include("../controllers/dbConection.php");
        include("../controllers/test.Controller.php"); 
        ?>
<!-- Formulario de adición -->
<div class="col-3">
	<form action="" method="post">
		<div class="input-group mb-3">
			<span class="input-group-text bg-info border-primary" id="">Prueba</span>
			<input type="text" class="form-control border-primary" placeholder="" name="Prueba">
		</div>
		<input type="submit" value="Probar" name="btnSend">
 </form>
</div>
			


</body>

</html>