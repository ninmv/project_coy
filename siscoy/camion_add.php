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
	<link rel="stylesheet" type="text/css" href="css/addcam.css">

	<title>Registro Camión</title>
</head>
<body>
	<?php include "include/header.php"; ?>
	<section id="container">
		<div class="form_register">
			<h1>Registro MIC DTA</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="POST">

				<label for="idmic">ID MIC</label>
				<input type="text" name="idmic" id="idMIC" placeholder="ID MIC N° 1">

				<label for="mic">Número MIC DTA</label>
				<input type="text" name="mic" id="mic" placeholder="Número MIC DTA">

				<label for="mic">Tipo Operación</label>
				<select>
				<option value="0">Seleccione</option>
				<option value="1">Ingreso a Chile</option>
				<option value="2">Salida de Chile</option>
				</select>
				
				<label for="fechamov">Fecha</label>
				<input type="date" id="fechamov" name="fechamov" step="1" min="1900-01-01" max="2019-12-31" value="1900-01-01">

				<label for="nombre">Nombre Empresa</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre empresa de transporte">

				<label for="patenteT">Patente Tracto </label>
				<input type="text" name="patenteT" id="patenteT" placeholder="Patente Tracto">

				<label for="patenteS">Patente Semi </label>
				<input type="text" name="patenteS" id="patenteS" placeholder="Patente Semi">

				<label for="kilos">Kilos de Carga</label>
				<input type="text" name="kilos" id="kilos" placeholder="Kilos de Carga">

				<label for="pax">N° Pasajeros</label>
				<input type="text" name="pax" id="pax" placeholder="N° Pasajeros">

				<label for="adu">Ciudad de Oficina</label>
				<input type="text" name="adu" id="adu" placeholder="Ciudad Oficina">

				<label for="obs">Observación</label>
				<textarea name="obs" id="obs" rows="5" cols="43" placeholder="Observaciones"></textarea>


				
								
				<input type="submit" value= "INGRESAR CAMION" class="btn-guardar">
			</form>		
		</div>
	</section>
</body>
</html>