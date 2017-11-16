<?php
	session_start();
?>
<html>
<head>
	<title>Imágenes</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="validacion.js"></script>
</head>
<body><?php
include 'dameCiudades.php';
include 'menu.php';
if(!isset($_SESSION["UsuarioValidado"]))
{
	header("Location: index.php");
}
?>
<div class="container">
<form class="form-horizontal" method='post' enctype="multipart/form-data" action='adminImagenes.php'
	onsubmit="validarImagen()">
	<div class="form-group">
	<label class="control-label" for="listaCiudades">Ciudad: </label>
	<select name="listaCiudades" id="listaCiudades">
		<option value=""> </option>
		<?php  for ($contador=0;$contador<count($ListaCiudades);$contador++){  ?>
		<option value="<?php echo $ListaCiudades[$contador]['id']; ?>">
		<?php	echo $ListaCiudades[$contador]['ciudad'];  ?>
		</option>
		<?php }  ?>
	</select>
	</div>
	<div class="form-group">
	<label class="control-label" for="fileToUpload">Imagen: </label>
	<input type="file" name="fileToUpload" id="fileToUpload">
  </div>
	<input type="submit" value="SUBIR" name="btAlta">
</form>

<?php
if (isset($_POST["btAlta"]) && isset($_POST["listaCiudades"])
	&& $_POST["listaCiudades"] && isset($_POST["fileToUpload"])
	&& $_POST["fileToUpload"])
{
	var_dump($_POST);

	include "conexion.php";
	try
	{
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$stmt = $conn->prepare("Insert INTO tbimagenes (imagen,idciudad) values (?, ?)");
		$stmt->execute(
			array("",$_POST["listaCiudades"])
			);
		$autonumerico = $conn->lastInsertId();
	}
	catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	$conn = null;
	$target_dir = "subidas/" . $autonumerico . "_" ;
	$target_file = $target_dir . $_FILES["fileToUpload"]["name"];
	move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
	try
	{
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$stmt = $conn->prepare("UPDATE tbimagenes SET imagen=? WHERE id=?");
		$stmt->execute(
			array($target_file,$autonumerico)
			);
			header("Location: adminImagenes.php");
	}
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
	}
	$conn = null;
}
?>
</div>
<footer>
	<p><a href="../" title="Inicio">Tortugas y Caracoles</a></p>
</footer>
</body>
</html>
