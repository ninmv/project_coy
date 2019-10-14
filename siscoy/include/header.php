<?php

	if(empty($_SESSION['active']))
	{
		header('location: ../login.php');
	}

?>

<header>
		<div class="header">
			
			<h1>Sistema Coyhaique</h1>
			<div class="optionsBar">
				<p>Coyhaique, <?php echo fechaC(); ?> </p>
				<span>|</span>
				<span class="user"><?php echo $_SESSION['user'].' - Tipo: '.$_SESSION['priv_name']; ?></span>
				<img class="photouser" src="img/user.png" alt="Usuario">
				<a href="salir.php"><img class="close" src="img/salir.png" alt="Salir del sistema" title="Salir"></a>
			</div>
		</div>
		<?php include "menunav.php"; ?>
	</header>