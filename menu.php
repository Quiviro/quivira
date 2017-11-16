<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Ciudades</a>
    </div>
    <ul class="nav navbar-nav">
      <?php
        if (isset($_SESSION["UsuarioValidado"]))
        {
          include 'dameCiudades.php';
          for ($contador=0;$contador<count($ListaCiudades);$contador++)
          {
            if ($ListaCiudades[$contador]['activo']==0)
            {
              echo '<li>';
              echo '<a href="index.php?c='.$ListaCiudades[$contador]['id'] .'">'
                  .$ListaCiudades[$contador]['ciudad'].'</a>';
              echo '</li>';
            }
          }
        }
      ?>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <?php
        include 'dameUsuarios.php';
        if (isset($_SESSION["UsuarioValidado"]) && $_SESSION["UsuarioValidado"] && $_SESSION["UsuarioValidado"][0]["vip"]): ?>
        <li><a href="adminCiudades.php">Alta Ciudades</a></li>
        <li><a href="adminImagenes.php">Alta Imagenes</a></li>
      <?php endif; ?>
      <?php if (isset($_SESSION["UsuarioValidado"]) && $_SESSION["UsuarioValidado"]): ?>
        <li><a href="salir.php"><span class="glyphicon glyphicon-log-out"></span> Salir
          "<?php echo $_SESSION["UsuarioValidado"][0]["nombreCompleto"]; ?>"</a></li>
      <?php else: ?>
        <li><a href="registro.php"><span class="glyphicon glyphicon-user"></span> Registro</a></li>
        <li><a href="entrar.php"><span class="glyphicon glyphicon-log-in"></span> Entrar</a></li>
      <?php endif; ?>
    </ul>
  </div>
</nav>
