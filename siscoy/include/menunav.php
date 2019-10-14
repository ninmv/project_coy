<nav>
			<ul>
				<li><a href="index.php">Inicio</a></li>
				<li class="principal">
				<!-- Muestra menu por permiso  -->
				<?php
					if($_SESSION['priv'] == 1){
				?>
					<a href="#">Usuarios</a>
					<ul>
						<li><a href="registro_user.php">Nuevo Usuario</a></li>
						<li><a href="list_user.php">Lista de Usuarios</a></li>
					</ul>
				</li>
				<li class="principal">
					<a href="#">Empleados</a>
					<ul>
						<li><a href="empleado_add.php">Nuevo Empleado</a></li>
						<li><a href="list_emp.php">Lista de Empleados</a></li>
					</ul>
				</li>
				<?php } ?> <!-- Cierre Menu no autorizado a otros usuarios  -->
				<li class="principal">
					<a href="#">Ingrese Camión</a>
					<ul>
						<li><a href="camion_add.php">Nuevo Camión</a></li>7
						<li><a href="list_cam.php">Lista de Camiones</a></li>
						<li><a href="export_list.php">Exportar a Excel</a></li>
					</ul>
				</li>
				<li class="principal">
					<a href="#">Papeletas de Recepción</a>
					<ul>
						<li><a href="#">Nueva Papeleta</a></li>
						<li><a href="#">Papeletas</a></li>
					</ul>
				</li>
				<li class="principal">
					<a href="#">Ayuda</a>
					<ul>
						<li><a href="ayuda_manual.php">Subir Documentos</a></li>
						<li><a href="ayuda_manual.php">Listado de Documentos</a></li>
					</ul>
				</li>
			</ul>
		</nav>