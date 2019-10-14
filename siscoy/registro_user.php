<?php
    // Vista de Pagina por permisos
	session_start();
	if($_SESSION['priv'] != 1)
	{
		header("location: ./");
	}
	//***
	
	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['priv']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios </p>';
		} else{
			
			$nombre = $_POST['nombre'];
			$email = $_POST['correo'];
			$user = $_POST['usuario'];
			$clave = $_POST['clave'];
			$priv = $_POST['priv'];

			$query = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario ='$user' OR correo = '$email' ");
			
			$result = mysqli_fetch_array($query);

			if($result > 0){
				$alert = '<p class = "msg_error"> El correo o el usuario ya existe</p>';
			} else{
				$query_insert = mysqli_query($conexion, "INSERT INTO usuarios(nombre_user, correo, usuario, clave, priv)
					VALUES('$nombre', '$email', '$user', '$clave', '$priv') ");
			
			if($query_insert){
				$alert='<p class="msg_guardar">Usuario creado correctamente</p>';
			} else {
				$alert='<p class="msg_error">Error al crear el usuario</p>';
			}

			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "include/script.php"; ?>
	<link rel="stylesheet" type="text/css" href="css/useradd.css">

	<title>Registro Usuario</title>
</head>
<body>
	<?php include "include/header.php"; ?>
	<section id="container">
		<div class="form_register">
			<h1>Registro de Nuevo Usuario</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="POST">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre Completo">
				<label for="correo">Correo Electronico</label>
				<input type="email" name="correo" id="correo" placeholder="Correo Institucional">
				<label for="usuario">Usuario</label>
				<input type="text" name="usuario" id="usuario" placeholder="Usuario del Sistema">
				<label for="clave">Clave</label>
				<input type="password" name="clave" id="clave" placeholder="Clave de acceso">
				<label name="priv">Tipo de Usuario</label>
				<?php
					$query_priv = mysqli_query($conexion, "SELECT * FROM privilegio");

					$result_priv = mysqli_num_rows($query_priv) ;
				?>
				<select name="priv" id="priv">
					<?php
						if ($result_priv > 0){
							while ($priv = mysqli_fetch_array($query_priv)){
					?>
						<option value="<?php echo $priv["id_priv"]; ?>"><?php echo $priv["privilegio"]?></option>
					<?php
							}				
						}
					?>
				</select>
				<input type="submit" value= "CREAR USUARIO" class="btn-guardar">
			</form>		
		</div>
	</section>
</body>
</html>