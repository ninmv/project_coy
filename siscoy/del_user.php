<?php
	// Vista de Pagina por permisos
	session_start();
	if($_SESSION['priv'] != 1)
	{
		header("location: ./");
	}
	//***
	
	include "../conexion.php";

	if (!empty($_POST)) 
	{
		if($_POST['idusuario'] == 1){
			header("location: list_user.php");
			exit;
		}
		$idusuario = $_POST['idusuario'];
        
        // PARA ELIMINAR USUARIO
		//$query_delete = mysqli_query($conexion, "DELETE FROM usuarios WHERE id_usuario = $idusuario ");
        
        // PARA DESHABILITAR EL USUARIO DE LA LISTA  
		$query_delete = mysqli_query($conexion, "UPDATE usuarios SET estatus = 0 WHERE id_usuario = $idusuario ");

		if($query_delete){
			header("location: list_user.php");
		}else{
			echo "Error al eliminar el usuario";
		}

	}

	if(empty($_REQUEST['id']) || $_REQUEST['id'] == 1)
	{
		header("location: list_user.php");
	}else{
		
		$idusuario = $_REQUEST['id'];

		$query = mysqli_query($conexion, "SELECT u.nombre_user, u.usuario, p.privilegio FROM usuarios u INNER JOIN privilegio p ON u.priv = p.id_priv WHERE u.id_usuario = $idusuario");

		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)){
				$nombre = $data['nombre_user'];
				$usuario = $data['usuario'];
				$priv = $data['privilegio'];
			}
		}else{

			header("location: list_user.php");
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "include/script.php"; ?>
	<link rel="stylesheet" type="text/css" href="css/userdelete.css">
	<title>Eliminar Usuario</title>
</head>
<body>
	<?php include "include/header.php"; ?>
	<section id="container">
		<div class="data_delete">
			<h2>¿Está seguro de eliminar el siguiente usuario?</h2>

			<p>Nombre: <span><?php echo $nombre; ?></span></p>

			<p>Usuario: <span><?php echo $usuario; ?></span></p>

			<p>Tipo Usuario: <span><?php echo $priv; ?></span></p>

			<form method="post" action="">
				<input type="hidden" name= idusuario value="<?php echo $idusuario; ?>">
				<a href="list_user.php" class=btn_cancel>Cancelar</a>
				<input type="submit" value="Aceptar" class="btn_accept">
			</form>
		</div>
	</section>
</body>
</html>