<?php
	require('includes/config.php');
	require('includes/geopoint.php');
	header('Content-Type:text/html;charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    	<link rel="stylesheet" href="css/bootstrap.min.css">
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
		<title>CONTACTOS</title>
		<link rel="stylesheet" type="text/css" href="styles/styles.css"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 
	</head>
	<body>
		<header id="header">
			<a href="index.php">
			<img id="logo" width="100%" height="100%" src="images/header.jpg" alt="Header"/>
			<h1>Agenda 2021</h1> 
			</a>
		</header>
		<div class="container-fluid">
		<nav>
			<form action='' method='post'>
			<h2><span>Buscador de contactos !!!</span></h2>
				<br>
                    <input type="text" required name="nombre" placeholder="Nombre, Apellido, Telefono"/>
				
				<input type="submit" name="buscar" value="Buscar"/>
				</form>
				<form action='' method='post'>
				<br>
				<input type="submit" name="todos" value="Todos"/><input type="submit" name="crear" value="Nuevo contacto"/><br>
			</form>
		</nav>
		<section id="section">
			<article>
				<div class="header">
				</div>
				<hr><br>
				<div class="content">
					<table class="table table-striped table-dark" border="1" align="center">
						<?php
							if(isset($_POST['buscar'])){
								echo "<tr class='th'><td>Nombre</td><td>Teléfono</td><td>E-mail</td><td>Accion</td></tr>";
								$nombre=strtoupper($_POST['nombre']);
								$query="SELECT id,nombre,apellidos,telemovil,emailprivado,direccion,pais FROM contactos
								where upper(nombre) like '%" .$nombre ."%' or upper(apellidos) like '%" .$nombre ."%' or telemovil like '%" .$nombre ."%';";
								require('includes/config.php');
								try{
									$sql=$db->prepare($query);
									$sql->execute();
									
									while($row=$sql->fetch()){
										echo "<tr><td>".$row['nombre']." ".$row['apellidos']."</td><td>".$row['telemovil']."</td><td>".$row['emailprivado']."</td><td><a href='contacto.php?id=".$row['id'].">Editar</a></td>
										</tr>";
									}
								}catch(PDOException $e){
									echo $e->getMessage();
								}
							}
							if(isset($_POST['todos'])){
								$query2="SELECT id,nombre,apellidos,telemovil,emailprivado,direccion,pais FROM contactos order by nombre";
								require('includes/config.php');
								try{
									$sql=$db->prepare($query2);
								
									$sql->execute();
									echo '<tr class="th"><td>Nombre</td><td>Teléfono</td><td>E-mail</td><td>Accion</td></tr>';
									while($row=$sql->fetch()){
										echo "<tr>
										<td>".$row['nombre']." ".$row['apellidos']."</td><td>".$row['telemovil']."</td><td>".$row['emailprivado']."</td><td><a href='contacto.php?id=".$row['id']."'>Editar</a></td>
										</tr>";
									}
								}catch(PDOException $e){
									echo $e->getMessage();
								}
							}
						?>
					</table><br>
					<?php
						if(isset($_POST['crear'])){
							header("location:nuevo.php");
						}
					?>
				</div>
			</article>
		</section>
		<footer id="footer">
			<p>Luis Menendez</p>
		</footer>
		
	</body>
</html>