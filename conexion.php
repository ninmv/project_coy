<?php
    // se conecta con la base de datos
    $conexion= mysqli_connect("localhost", "root", "1234","sisreg");
	
	//mysqli_close($conexion);

    //verificar la conexion
	if(!$conexion){
		echo 'No se pudo conectar a la base de datos';
	}
	/*else{
		echo 'Conectado a la base de datos';
	}*/

?>