<?php

	// Vista de Pagina por permisos
	session_start();
	if($_SESSION['priv'] != 1)
	{
		header("location: ./");
	}
	//***

include "../conexion.php";

// ACTUALIZAR USUARIO

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['priv']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios </p>';
		} else{
			
			$idUsuario  = $_POST['idUsuario'];
			$nombre 	= $_POST['nombre'];
			$email 		= $_POST['correo'];
			$user 		= $_POST['usuario'];
			$clave 		= $_POST['clave'];
			$priv 		= $_POST['priv'];

			$query = mysqli_query($conexion, "SELECT * FROM usuarios 
				WHERE (usuario ='$user' AND id_usuario != $idUsuario) OR  (correo = '$email' AND id_usuario != $idUsuario)");
			

			$result = mysqli_fetch_array($query);

			if($result > 0){
				$alert = '<p class = "msg_error"> El correo o el usuario ya existe</p>';
			}else{
				if(empty($_POST['clave']))
				{
					$sql_update = mysqli_query($conexion, "UPDATE usuarios SET nombre_user = '$nombre', correo = '$email', usuario = '$user', priv = '$priv' 
						WHERE id_usuario = $idUsuario" );
				}else{
					$sql_update = mysql_query($conexion, "UPDATE usuarios SET nombre_user = '$nombre', correo = '$email', usuario = '$user', clave = '$clave', priv = '$priv' 
						WHERE id_usuario = $idUsuario" );
				}
				
			if($sql_update){
				$alert='<p class="msg_guardar">Usuario actualizado correctamente</p>';
			} else {
				$alert='<p class="msg_error">Error al actualizar el usuario</p>';
			}

			}
		}
		
	}
	//MOSTRAR DATOS PARA ACTUALIZAR
	if(empty($_GET['id']))
	{
		header('Location: list_user.php');
		myslqi_close($conexion);
	}	
	$iduser = $_GET['id'];

	$sql = mysqli_query($conexion, "SELECT u.id_usuario, u.nombre_user, u.correo, u.usuario, (u.priv) AS id_priv, (p.privilegio) AS privilegio
									FROM usuarios u
									INNER JOIN privilegio p 
									ON u.priv = p.id_priv
									WHERE id_usuario =  $iduser ");

	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header('Location: list_user.php');
	} else{
		$option = '';
		while ($data = mysqli_fetch_array($sql)){
			$iduser = $data['id_usuario'];
			$nombre = $data['nombre_user'];
			$correo = $data['correo'];
			$user   = $data['usuario'];
			$idpriv = $data['id_priv'];
			$priv   = $data['privilegio'];

			if($idpriv == 1){
				$option = '<option value="'.$idpriv.'" select>'.$priv.'</option>';
			}else if($idpriv == 2){
				$option = '<option value="'.$idpriv.'" select>'.$priv.'</option>';
			}else if($idpriv == 3){
				$option = '<option value="'.$idpriv.'" select>'.$priv.'</option>';
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

	<title>Actualizar Usuario</title>
</head>
<body>
	<?php include "include/header.php"; ?>
	<section id="container">
		<a href="list_user.php" class="btn_volver"> << Lista de usuarios</a>
		<div class="form_register">
			<h1>Actualización de Usuario</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="POST">
				<input type="hidden" name="idUsuario" value="<?php echo $iduser; ?>">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre Completo" value="<?php echo $nombre; ?>">
				<label for="correo">Correo Electrónico</label>
				<input type="email" name="correo" id="correo" placeholder="Correo Institucional" value="<?php echo $correo; ?>">
				<label for="usuario">Usuario</label>
				<input type="text" name="usuario" id="usuario" placeholder="Usuario del Sistema" value="<?php echo $user; ?>">
				<label for="clave">Clave</label>
				<input type="password" name="clave" id="clave" placeholder="Clave de acceso">
				<label name="priv">Tipo de Usuario</label>
				<?php
					include "../conexion.php";
					$query_priv = mysqli_query($conexion, "SELECT * FROM privilegio");
					
					$result_priv = mysqli_num_rows($query_priv);
				?>
				<select name="priv" id="priv" class="notItemOne">
					<?php
						echo $option;
						if ($result_priv > 0){
							while ($priv = mysqli_fetch_array($query_priv)){
					?>
						<option value="<?php echo $idpriv["id_priv"]; ?>"><?php echo $priv["privilegio"]?></option>
					<?php
							}				
			
						}
					?>
				</select>
				<input type="submit" value= "ACTUALIZAR USUARIO" class="btn-guardar">

	</form>		

		</div>
	</section>
</body>
</html>