<?php
	$alert = '';
    //inicio de sesion
	session_start();

   //valida si la sesion existe
	if(!empty($_SESSION['active']))
	{
		header('location: siscoy/');
	}else{

	if(!empty($_POST))
	{
		if(empty($_POST['usuario']) || empty($_POST['clave']))
		{
			$alert = 'Ingrese usuario y contraseña';
		}else{

			require_once "conexion.php";

			$user = $_POST['usuario'];
			$pass = $_POST['clave'];

			$query = mysqli_query($conexion, "SELECT u.id_usuario, u.nombre_user, u.correo, u.usuario, p.id_priv, p.privilegio FROM usuarios u INNER JOIN privilegio p ON u.priv = p.id_priv WHERE u.usuario = '$user' AND u.clave = '$pass'");
			
			$result = mysqli_num_rows($query);

			if($result > 0)
			{
				$data = mysqli_fetch_array($query);
				$_SESSION['active'] = true;
				$_SESSION['idUser'] = $data['id_usuario'];
				$_SESSION['nombre'] = $data['nombre_user'];
				$_SESSION['email'] 	= $data['correo'];
				$_SESSION['user'] 	= $data['usuario'];
				$_SESSION['priv'] 	= $data['id_priv'];
				$_SESSION['priv_name'] = $data['privilegio'];

				header('location: siscoy/');
			}else{
				$alert = 'El usuario o la clave es incorrecta';
				session_destroy();
			}
		}
	}
}

?>
<!-- -->
<!DOCTYPE html>
<html lang="es">
	<head>
	    <meta charset="utf-8">
		<title> Login Sistema </title>
		<link rel="stylesheet" type="text/css" href="stylelogin.css">
</head>
<body>
	<section id="container">
		<form action="" method="POST">
			<h3>Inicio de Sesión</h3>
			<img src="img/login.png" alt="Login">
			<input type="text" name="usuario" placeholder="Usuario">
			<input type="password" name="clave" placeholder="Contraseña">
			<input type="submit" value="INGRESAR">
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
		</form>
	</section>
</body>
</html>