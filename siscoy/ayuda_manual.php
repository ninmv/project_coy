<?php
  session_start();
  include "../conexion.php";
	
	if (isset($_POST['submit'])) {   
    if(is_uploaded_file($_FILES['fichero']['tmp_name'])) { 
       
        $ruta = "upload/"; 
        $nombrefinal= trim ($_FILES['fichero']['name']); 
        $upload= $ruta . $nombrefinal;  

        if(move_uploaded_file($_FILES['fichero']['tmp_name'], $upload)) { 
                    echo "<b>El Archivo se ha subido correctamente. </b><br><br>"; 
                    echo "Nombre: <a href=\"".$ruta . $nombrefinal."\">".$_FILES['fichero']['name']."</a><br>";  
                    echo "Tipo Archivo: ".$_FILES['fichero']['type']."<br>";  
                    echo "Peso: ".$_FILES['fichero']['size']." bytes<br>";  
                    echo "<br><hr><br>";  
        
                   $nombre  = $_POST["nombre"]; 
                   $description  = $_POST["description"]; 

                   $query = "INSERT INTO archivos (name,description,ruta,tipo,size) 
    VALUES ('$nombre','$description','".$nombrefinal."','".$_FILES['fichero']['type']."','".$_FILES['fichero']['size']."')"; 

       mysql_query($query) or die(mysql_error()); 
       echo "El archivo '".$nombre."' se ha subido con éxito <br>";       
        }  
    }  
 } 
?> 

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "include/script.php"; ?>
	<link rel="stylesheet" type="text/css" href="css/css_user.css">
	
	<title>Ayuda</title>
</head>
<body>
	<?php include "include/header.php"; ?>
	<section id="container">
		<div class="form_register">
		<h1>Subir un documento</h1>

		<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
				<label for="archivo">Seleccione Archivo:</label>
				<input name="fichero" type="file" size="150" maxlength="150">

				<label for="nombrearc">Nombre:</label>
				<input name="nombre" type="text" size="70" maxlength="70">

				<label for="descrip">Descripción:</label>
				<input name="description" type="text" size="100" maxlength="250">
				
				<input name="submit" type="submit" value="Subir Documento" class="btn-guardar">  
	</form>		
	  </div>
	</section>
</body>
</html>