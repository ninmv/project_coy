<?php
    // Vista de Pagina por permisos
	session_start();
	if($_SESSION['priv'] != 1)
	{
		header("location: ./");
	}
	//***
	
	include "../conexion.php";

	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "include/script.php"; ?>
	<link rel="stylesheet" type="text/css" href="css/useradd.css">

	<title>Registro Empleado</title>
</head>
<body>
	<?php include "include/header.php"; ?>
	<section id="container">
		<div class="form_register">
			<h1>Registro de Nuevo Empleado</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="POST">
				<label for="rut">Cédula de Identidad</label>
				<input type="text" id="rut" name="rut" placeholder="Ingrese Rut , ej: 11111111-1" class="input-100" required onblur="onRutBlur(this);">

				<label for="nombres">Nombre(s):</label>
				<input type="text" id="nombres" name="nombres" placeholder="Ingrese el o los nombres" maxlength= 30>

				<label for="apellidos">Apellido(s):</label>
				<input type="text" id="apellidos" name="apellidos" placeholder="Escriba el o los apellidos" >

				<label for="nacionalidad">Nacionalidad:</label>
				<input type="text" id="nacionalidad"name="nacionalidad" placeholder="Nacionalidad">

				<label for="fechanac">Fecha de Nacimiento:</label>
				<input type="date" id="fechanac" name="fechanac" step="1" min="1900-01-01" max="2019-12-31" value="1900-01-01">

				<label for="direccion">Dirección:</label>
				<input type="text" id="direccion" name="direccion" placeholder="Dirección particular">

				<label for="telefono">Teléfono:</label>
				<input type="text" id="telefono" name="telefono" placeholder="Teléfono particular" maxlength="9">

				<label for="ciudad">Ciudad:</label>
				<input type="text" id="ciudad" name="ciudad" placeholder="Ciudad de residencia">

				<label for="correo">Correo Electronico</label>
				<input type="email" name="correo" id="correo" placeholder="Ingrese Correo Particular">

				<label for="cargo">Tipo de Cargo:</label>
				<input type="text" id="tipocargo" name="tipocargo" placeholder="Cargo en la empresa">
				
				<label for="contrato">Tipo de Contrato:</label>
				<input type="text" id="tipocontrato" name="tipocontrato" placeholder="Tipo de Contrato">

				<input type="submit" value= "INGRESAR EMPLEADO" class="btn-guardar">
			</form>		
		</div>
	</section>
</body>
</html>