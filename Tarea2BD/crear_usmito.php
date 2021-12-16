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
        <?php
        session_start();
        $usuario = $_SESSION['username'];
        
        echo("<h3>¡Publica un usmito, $usuario!</h3>");
        ?>
        <br></br>
        <form action = "creador.php" method="post">
        <textarea rows="7" cols="60" maxlength="279" name="usmito" placeholder="Escribe aquí tu usmito"></textarea>
        <textarea rows="4" cols="30" maxlength="255" name="tag" placeholder="Escribe tus tags separados por una coma. ¡Recuerda que los usmitos dirigidos a amigos no necesitan tags!"></textarea>
        <input name="amigos" type="checkbox" placeholder="es tu usmito para los amigos solamente?">es tu usmito para los amigos solamente?
        <input type="submit" value="Crear usmito!"name="publicar">
    </form>
    </body>
</html>