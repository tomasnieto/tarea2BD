<!DOCTYPE html>
<html>
<body>
<nav id="navbar">
        <a class="navbarElem" style="margin-left: 40%" href="perfil.php"><b>Perfil</b></a> |
        <a class="navbarElem" href="feed.php"><b>Feed</b></a> |
        <a class="navbarElem" href="crear_usmito.php"><b>Crear</b></a> |
        <a class="navbarElem" href="buscador.php"><b>Buscar</b></a> |
        <a class="navbarElem" href="cerrar_sesion.php"><b>Cerrar sesion</b></a> |
        </nav> 
</body>
<?php
include("empezar_sesion.php");
$usuario = $_SESSION['username'];
$siguiendo = $_SESSION['siguiendo'];
$n_seguidores_nuevo = $_SESSION['seguidores'] + 1;

if (isset($_POST['seguir'])){//insert y update
    
    $consulta = "INSERT INTO siguiendo(nombre_cuenta,nombre_siguiendo) VALUES ('$usuario','$siguiendo')";
    $resultado = mysqli_query($conex,$consulta);

    $consulta2 = "UPDATE usmers SET n_seguidores=(n_seguidores + 1) WHERE nombre_cuenta = '$siguiendo'";
    $resultado2 = mysqli_query($conex,$consulta2);

    $consulta3 = "UPDATE usmers SET n_seguidos=(n_seguidos + 1) WHERE nombre_cuenta = '$usuario'";
    $resultado3 = mysqli_query($conex,$consulta3);
    if ($resultado) {
        echo("<h3>¡Ahora sigues a $siguiendo!</h3>");
    }else {
        echo("<h3>Error</h3>");
    }
}
?>