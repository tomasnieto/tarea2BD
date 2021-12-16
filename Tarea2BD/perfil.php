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
    $usuario = $_SESSION['username'];
    echo("<h3>Perfil de $usuario</h3>");
    //se recolectan los datos del usuario
    $q = "SELECT nombre_cuenta,username,n_seguidos,n_seguidores FROM usmers WHERE nombre_cuenta = '$usuario'";
    $resultado = $conex->query($q);
    $info = $resultado->fetch_assoc();
    $cuenta = $info["nombre_cuenta"];
    $username = $info["username"];
    $seguidos = $info["n_seguidos"];
    $seguidores = $info["n_seguidores"];
    $_SESSION['seguidos'] = $seguidos;
    $_SESSION['seguidores'] = $seguidores;


    //contar usmitos
    $q = "SELECT COUNT(*) as contar from usmitos where nombre_cuenta = '$usuario'";
    $consulta = mysqli_query($conex,$q);
    $array = mysqli_fetch_array($consulta);
    $n_usmitos = $array['contar'];
    $_SESSION['usmitos_nombre_propietario'] = $usuario;
    $_SESSION['n_usmitos'] = $n_usmitos;

    //contar reusmitos
    $q = "SELECT COUNT(*) as contar from reusmeados where nombre_reusmeador = '$usuario'";
    $consulta = mysqli_query($conex,$q);
    $array = mysqli_fetch_array($consulta);
    $n_reusmitos = $array['contar'];
    $_SESSION['n_reusmitos'] = $n_reusmitos;

    echo("Nombre de la cuenta: $cuenta<br/>");
    echo("Nombre de usuario: $username<br/>");
    echo("<a href=seguidos.php>Número de seguidos: $seguidos</a><br/>");
    echo("<a href=seguidores.php>Número de seguidores: $seguidores</a><br/><br/>");
    echo("Has creado <a href=usmitos_de_cuenta.php>$n_usmitos usmitos</a> y <a href=ver_reusmitos.php>$n_reusmitos reusmitos</a><br/><br/>");//"y reusmitiado $n_reusmitos posts (poner href?)
    echo("<a href=editar_perfil.php>Editar Perfil</a><br/>");
    ?>
</html>