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

<!-- HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "include/script.php"; ?>
	<link rel="stylesheet" type="text/css" href="css/userlist.css">
	<title>Sistema</title>
</head>
<body>
	<?php include "include/header.php"; ?>
	<section id="container">
		<a href="registro_user.php" class="btn_new">Crear Usuario</a>
		<h1>Lista de Usuarios</h1>
		<table>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Correo</th>
				<th>Usuario</th>
				<th>Privilegio</th>
				<th>Acciones</th>
		</tr>
		<?php
		//Paginador
			$sql_register = mysqli_query($conexion,"SELECT COUNT(*) as total_registro FROM usuarios WHERE estatus = 1 ");
			$result_register = mysqli_fetch_array($sql_register);
			$total_registro = $result_register['total_registro'];

			$por_pagina = 5;

			if(empty($_GET['pagina']))
			{
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}

			$desde = ($pagina-1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);

			$query = mysqli_query($conexion,"SELECT u.id_usuario, u.nombre_user, u.correo, u.usuario, p.privilegio FROM usuarios u INNER JOIN privilegio p ON u.priv = p.id_priv WHERE estatus = 1 ORDER BY u.id_usuario ASC LIMIT $desde, $por_pagina ");

			$result = mysqli_num_rows($query);

			if($result > 0){
				while($data = mysqli_fetch_array($query)){
		?>
			<tr>
				<td><?php echo $data["id_usuario"] ?></td>
				<td><?php echo $data["nombre_user"] ?></td>
				<td><?php echo $data["correo"] ?></td>
				<td><?php echo $data["usuario"] ?></td>
				<td><?php echo $data["privilegio"] ?></td>
				<td>
					<a class="link_edit" href="edit_user.php?id=<?php echo $data["id_usuario"] ?>">Editar</a>
					<?php if($data["id_usuario"] != 1){ ?>
					||
					<a class="link_delete" href="del_user.php?id=<?php echo $data["id_usuario"] ?>">Eliminar</a>
					<?php } ?>
				</td>
			</tr>
		<?php

			}
		}
		?>
		</table>
		<div class="paginador">
			<ul>
			<?php 
				if($pagina != 1)
				{
			 ?>
				<li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>"><<</a></li>
			<?php 
				}
				for ($i=1; $i <= $total_paginas; $i++) { 
					
					if($i == $pagina)
					{
						echo '<li class="pageSelected">'.$i.'</li>';
					}else{
						echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
					}
				}

				if($pagina != $total_paginas)
				{
			 ?>
				<li><a href="?pagina=<?php echo $pagina + 1; ?>">>></a></li>
				<li><a href="?pagina=<?php echo $total_paginas; ?> ">>|</a></li>
			<?php } ?>
			</ul>
		</div>

	</section>
</body>
</html>