function validarUsuario()
{
  var nombreCompleto = document.getElementById("nombreCompleto").value;
  if (nombreCompleto=="")
  {
    alert("Es obligatorio indicar el nombre completo");
    document.getElementById("nombreCompleto").focus();
    return false;
  }
  var user=document.getElementById("user").value;
  if (user=="")
  {
    alert("Es obligatorio el usuario");
    document.getElementById("user").focus();
    return false;
  }
  var pass=document.getElementById("pass").value;
  if (pass=="")
  {
    alert("Es obligatorio la contraseña");
    document.getElementById("pass").focus();
    return false;
  }
  return true;
}

function validarImagen()
{
  var listaCiudades = document.getElementById("listaCiudades").value;
  if (listaCiudades=="")
  {
    alert("Es obligatorio indicar la ciudad");
    document.getElementById("listaCiudades").focus();
    return false;
  }
  var fileToUpload = document.getElementById("fileToUpload").value;
  if (fileToUpload=="")
  {
    alert("Es obligatorio subir una imagen");
    document.getElementById("fileToUpload").focus();
    return false;
  }
  return true;
}


function validarCiudad()
{
  var ciudad = document.getElementById("ciudad").value;
  if (ciudad=="")
  {
    alert("Es obligatorio indicar la ciudad");
    document.getElementById("ciudad").focus();
    return false;
  }
  var descripcion = document.getElementById("descripcion").value;
  if (descripcion=="")
  {
    alert("Es obligatorio indicar la descripcion");
    document.getElementById("descripcion").focus();
    return false;
  }
  return true;
}
