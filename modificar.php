<?php
	require('includes/config.php');
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
	</head>
	<body>
		<header id="header">
			<a href="index.php">
				<img id="logo" width="100%" height="100%" src="images/header.jpg" alt="Header"/>
			</a>
		</header>
		<nav>
		</nav>
		<section id="section">
			<article>
				<div class="header">
					<h2>MODIFICAR CONTACTO:</h2>
				</div>
				<hr><br>
				<div class="content">
					<?php
						$id=$_GET['id'];
						require('includes/config.php');
						try{
							$sql=$db->prepare('SELECT id,nombre,apellidos,telemovil,emailprivado,direccion,pais,fechanac,latitud,longitud FROM contactos WHERE id=:id');
							$sql->execute(array(
								':id'=>$id
							));
							$row=$sql->fetch();
						}catch(PDOException $e){
							echo $e->getMessage();
						}
					?>
					<form action="" method="post" enctype="multipart/form-data" class="form-style-9">
						<table border="0" align="center">
							<tr><td class="left"><label>Introduce el nombre:*</label></td>
							<td class="right"><input type="text" required name="nombre" placeholder="Nombre" value="<?php echo $row['nombre']; ?>"/></td></tr>
							<tr><td class="left"><label>Introduce los apellidos:*</label></td>
							<td class="right"><input type="text" required name="apellidos" placeholder="Apellidos" value="<?php echo $row['apellidos']; ?>"/></td></tr>
							<tr><td class="left"><label>Introduce el teléfono móvil:*</label></td>
							<td class="right"><input type="number" required name="telemovil" placeholder="Teléfono móvil" value="<?php echo $row['telemovil']; ?>"/></td></tr>
							<tr><td class="left"><label>Introduce el email privado:*</label></td>
							<td class="right"><input type="email" required name="emailprivado" placeholder="Email privado" value="<?php echo $row['emailprivado']; ?>"/></td></tr>
							<tr><td class="left"><label>Introduce la dirección:*</label></td>
							<td class="right"><input type="text" required name="direccion" placeholder="Dirección" value="<?php echo $row['direccion']; ?>"/></td></tr>
							<tr><td class="left"><label>Introduce el país:*</label></td>
							<td class="right"><input type="text" required name="pais" placeholder="País" value="<?php echo $row['pais']; ?>"/></td></tr>
							<tr><td class="left"><label>Introduce la fecha de nacimiento:*</label></td>
							<td class="right"><input type="date" required name="fechanac" value="<?php echo $row['fechanac']; ?>"/></td></tr>
							<tr> <td class="left"><input type="lat" id="lat" name="lat"  placeholder="Latitud"/> </td>
							<td class="right"> <input type="long" id ="lng" name="long" placeholder="Longitud"/> </td>
							<tr><td><input type="submit" name="cambiar" value="Modificar"/>&nbsp;</td>
							<td>&nbsp;<input type="reset" name="cancelar" value="Cancelar"/></td></tr>
						</table>
					</form>
					<script>
function getLocation() {
    
    // Try HTML5 geolocation.
if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude 
      };
        document.getElementById("lat").value = pos['lat'];
        document.getElementById("lng").value = pos['lng'];
        map.setCenter(pos);
      }, function() {
        handleLocationError(true, infoWindow, map.getCenter());
      });
    } else {
      // Browser doesn't support Geolocation
      handleLocationError(false, infoWindow, map.getCenter());
    }
  }

  function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
                          'Error: The Geolocation service failed.' :
                          'Error: Your browser doesn\'t support geolocation.');
  }
  </script>
					<button onclick="getLocation()"> Ubicacion</button>
				</div>
				<br><hr>
			</article>
		</section>
		<?php
			if(isset($_POST["cambiar"])){
				$nombre=$_POST["nombre"];
				$apellidos=$_POST["apellidos"];
				$telemovil=$_POST["telemovil"];
				$emailprivado=$_POST["emailprivado"];
				$direccion=$_POST['direccion'];
				$pais=$_POST["pais"];
				$fechanac=$_POST["fechanac"];
				$latitud=$_POST["lat"];
				$longitud=$_POST["long"];				
				try{
					$sql=$db->prepare('UPDATE contactos SET
					nombre="'.$nombre.'",
					apellidos="'.$apellidos.'",
					telemovil="'.$telemovil.'",
					emailprivado="'.$emailprivado.'",
					direccion="'.$direccion.'",
					pais="'.$pais.'",
					fechanac="'.$fechanac.'",
					lat="'.$latitud.'",
					long="'.$longitud.'"
					WHERE id=:id');
					$sql->execute(array(
						':id'=>$id
					));
					header("refresh:0;");
					echo "<script>alert('Contacto modificado!');</script>";
					exit;
				}catch(PDOException $e){
					echo $e->getMessage();
				}
			}
			if(isset($_POST["cancelar"])){
				header("location:contacto.php");
			}
		?>
		<footer id="footer">
			<p>Luis Menendez</p>
		</footer>
	</body>
</html>