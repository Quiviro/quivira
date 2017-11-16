<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Alta de Usuarios</title>
		<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="validacion.js"></script>
	</head>
	<body>
		<?php
		include 'dameCiudades.php';
		include 'menu.php';
		?>
		<div class="container">
			<h2>Alta de Usuarios</h2>
			<form class="form-horizontal" method="post" action="registro.php"
					onsubmit="validarUsuario()">
				<div class="form-group">
					<label class="control-label col-sm-2" for="nombreCompleto">Nombre Completo:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="nombreCompleto" name="nombreCompleto">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="user">User:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="user" name="user">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="pass">Password:</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="pass" name="pass">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" name="btAlta" class="btn btn-default">Regístrate</button>
						<button type="button" name="btEntrar" class="btn btn-default" onclick="location.href='entrar.php'">Entrar</button>
					</div>
				</div>
			</form>
		</div>
		<?php
			if (isset($_POST["btAlta"]) && $_POST["nombreCompleto"]
				&& $_POST["user"] && $_POST["pass"])
			{
				var_dump($_POST);
				include "conexion.php";
				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare("Insert INTO tbusuarios
						(nombreCompleto, user, pass) values (?,?, ?)");
					$stmt->execute(
						array($_POST["nombreCompleto"],
								$_POST["user"],
								md5($_POST["pass"]),
						)
					);
					$_SESSION["mensaje"] = "Alta realizado correctamente";
					header('Location: registro.php');
					exit;
				}
				catch(PDOException $e) {
					echo "Error: " . $e->getMessage();
				}
				$conn = null;
			}

			if (isset($_SESSION["mensaje"])){
				echo '<div class="alert alert-success">
				<strong>¡Éxito! </strong>' . $_SESSION["mensaje"] .
				'</div>';
				unset($_SESSION["mensaje"]);
			}
		?>
		<footer>
			<p><a href="../" title="Inicio">Tortugas y Caracoles</a></p>
		</footer>
	</body>
</html>
