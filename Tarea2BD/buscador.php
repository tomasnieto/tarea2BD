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

    <?php
    
    include("empezar_sesion.php");
    $usuario = $_SESSION['username'];
    $_SESSION['busqueda'] = 'buscador';//servirá luego, para redirigir una vez que el usuario haga algo con el post
    
    echo("<h3>¡Vamos a buscar usmers y usmitos, $usuario!</h3>");
    //simple metodo post para buscar usmito o usmer
    ?>
    <form method="post" style="margin-left: 40%">
        <input name="buscar" type="text" placeholder="Busca un usmer...">
        <input name="ingresar" type="submit" value="Buscar Usmer">
    </form>

    <form method="post" style="margin-left: 40%">
        <input name="buscar_usmito" type="text" placeholder="Busca un usmito...">
        <input name="ingresar_usmito" type="submit" value="Buscar Usmito">
    </form>
        <?php
        include("busqueda.php");
        ?>
</body>
</html>