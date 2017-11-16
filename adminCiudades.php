<?php
	session_start();
?>
<html>
<head>
	<title>Ciudades</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="validacion.js"></script>
</head>
<body>
	<?php
	include 'menu.php';
	if(!isset($_SESSION["UsuarioValidado"]))
	{
		header("Location: index.php");
	}
	?>
	<div class="container">
<form class="form-horizontal" method="post" action="adminCiudades.php" onsubmit="validarCiudad()">
	<div class="form-group">
		<label class="control-label" for="ciudad">Ciudad: </label>
<input type="text" name="ciudad" id="ciudad" placeholder="Nombre ciudad...">
	</div>
	<div class="form-group">
		<label class="control-label" for="descripcion">Descripción: </label>
		<input type="text" name="descripcion" id="descripcion"
		placeholder="Descripcion...">
	</div>
<input type="submit" name="btAlta" value="CREAR">
</form>
<?php
if (isset($_POST["btAlta"]) && isset($_POST["ciudad"])
	&& $_POST["ciudad"] && isset($_POST["descripcion"])
	&& $_POST["descripcion"])
{
	var_dump($_POST);
	include "conexion.php";
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$stmt = $conn->prepare("Insert INTO tbciudades (ciudad,descripcion) values (?, ?)");
		$stmt->execute(
			array($_POST["ciudad"],
				$_POST["descripcion"]
				)
			);
		header("Location: adminCiudades.php");
	}
	catch(PDOException $e) {
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
