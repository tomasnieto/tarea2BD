<!DOCTYPE html>
<html>
<body>
<nav id="navbar">
        <a class="navbarElem" style="margin-left: 26%" href="perfil.php"><b>Perfil</b></a> |
        <a class="navbarElem" href="feed.php"><b>Feed</b></a> |
        <a class="navbarElem" href="feed_reusmitos.php"><b>Reusmitos</b></a> |
        <a class="navbarElem" href="feed_amigos.php"><b>Feed de tus Amigos</b></a> |
        <a class="navbarElem" href="tendencias.php"><b>Tendencias</b></a> |
        <a class="navbarElem" href="crear_usmito.php"><b>Crear</b></a> |
        <a class="navbarElem" href="buscador.php"><b>Buscar</b></a> |
        <a class="navbarElem" href="cerrar_sesion.php"><b>Cerrar Sesion</b></a> |
        </nav> 
</body>
<?php
include("empezar_sesion.php");
$sesion = $_SESSION['username'];
$usuario = $_SESSION['usmitos_nombre_propietario'];
$n_reusmitos = $_SESSION['n_reusmitos'];
echo("<h3>La cuenta $usuario tiene $n_reusmitos reusmitos</h3>");
$q = "SELECT usmito_id,texto_tag,nombre_cuenta,me_encanta,texto,amigos_cercanos,fecha FROM usmitos WHERE usmito_id IN(SELECT usmito_id FROM reusmeados WHERE nombre_reusmeador='$usuario') ORDER BY fecha DESC";

$resultado = $conex->query($q);
if ($resultado->num_rows > 0) {
  echo "----------------------------------------";
  while($info = $resultado->fetch_assoc()) {
    //se muestra el reusmito con el autor original
    echo "<br> creado el: ". $info["fecha"]. "<br>". $info["texto"]. "<br>Tags: " . $info["texto_tag"] . "<br>" .$info["me_encanta"]. " Likes <br><br>";
    echo "Autor original del usmito: ". $info["nombre_cuenta"]. "<br><br>";
    echo "----------------------------------------";
}

}