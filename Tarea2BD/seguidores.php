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
$seguidores = $_SESSION['seguidores'];
echo("<h3>Tu cuenta $usuario tiene $seguidores seguidores</h3>");
$q = "SELECT nombre_cuenta FROM siguiendo WHERE nombre_siguiendo='$usuario'";
$resultado = $conex->query($q);
if ($resultado->num_rows > 0) {
  //se muestran todos los seguidores de la cuenta
  while($info = $resultado->fetch_assoc()) {
    echo($info["nombre_cuenta"]);
    echo("<br/>");
  }
} else {
  echo "Nadie sigue tu cuenta.";
}


?>
</html>