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

if (isset($_POST['no_seguir'])){//insert y update
    //se borra de la tabal siguiendo la relacion entre los usmers
    $consulta = "DELETE FROM siguiendo WHERE nombre_siguiendo='$siguiendo' AND nombre_cuenta='$usuario'";
    $resultado = mysqli_query($conex,$consulta);

    //se cambian los numeros de usmers que sigue la cuenta y cuantos lo siguen, para quien corresponda
    $consulta2 = "UPDATE usmers SET n_seguidores=(n_seguidores - 1) WHERE nombre_cuenta = '$siguiendo'";
    $resultado2 = mysqli_query($conex,$consulta2);

    $consulta3 = "UPDATE usmers SET n_seguidos=(n_seguidos - 1) WHERE nombre_cuenta = '$usuario'";
    $resultado3 = mysqli_query($conex,$consulta3);
    if ($resultado) {
        echo("<h3>¡Dejaste de seguir a $siguiendo!</h3>");
    }else {
        echo("<h3>Error</h3>");
    }
}

?>