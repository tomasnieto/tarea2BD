<!DOCTYPE html>
<html>
<body>
<nav id="navbar">
        <a class="navbarElem" style="margin-left: 40%" href="perfil.php"><b>Volver</b></a>
        </nav>
</body>
<?php
include("empezar_sesion.php");
$usuario = $_SESSION['username'];
$seguidos = $_SESSION['seguidos'];
echo("<h3>Tu cuenta $usuario sigue a $seguidos usuarios</h3>");
$q = "SELECT nombre_siguiendo FROM siguiendo WHERE nombre_cuenta='$usuario'";
$resultado = $conex->query($q);
if ($resultado->num_rows > 0) {
  //se muestran todo quien la cuenta sigue
  while($info = $resultado->fetch_assoc()) {
    echo($info["nombre_siguiendo"]);
    echo("<br/>");
  }
} else {
  echo "No estás siguiendo a nadie de momento.";
}


?>
</html>