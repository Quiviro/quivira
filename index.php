<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Ciudades</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>


  <?php
    include 'dameCiudades.php';
    if(isset($_GET['c']))
    {
      include 'dameImagenes.php';
    }

  //var_dump($ListaCiudades);
  include 'menu.php';
  ?>



<br>

<div class="container">
  <?php if(isset($_GET['c'])){
    // echo $_GET['c'];
    for ($contador=0;$contador<count($ListaCiudades);$contador++)
		{
      if($ListaCiudades[$contador]['id']==$_GET['c'] &&
        $ListaCiudades[$contador]['activo']==0 && isset($_SESSION["UsuarioValidado"]))
			{
        echo $ListaCiudades[$contador]['ciudad'] . "<br>";
        echo $ListaCiudades[$contador]['descripcion']. "<br><br>";
        //var_dump($ListaImagenes);
        //echo count($ListaImagenes);
        if (count($ListaImagenes)>0)
				{
          for ($cont=0;$cont<count($ListaImagenes);$cont++)
					{
              echo "<img width='450px' src='" . $ListaImagenes[$cont]['imagen'] . "'><br><br>";
          }
        }
      }
    }

  ?>
  <?php }
		else if (isset($_SESSION["UsuarioValidado"]))
		{
			echo "<h3>Elija su ciudad favorita</h3><p>En el menú superior</p>";
		}
		else{   ?>
    <h3>Debe registrarse como usuario...</h3>
    <p>...para poder ver las ciudades</p>
  <?php }  ?>
</div>
</body>
</html>
