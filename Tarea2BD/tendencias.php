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
    echo("<h3>¡Bienvenido a Tendencias, $usuario!</h3>");
    //top 10 tendencias contando cuantas veces aparece cada tag y ordenando esos valores
    echo "<h3>¡Top 10 en tendencias ahora mismo!</h3>";
    $q = "SELECT COUNT(tag),tag from tendencias GROUP BY tag ORDER BY COUNT(tag)";
    $resultado = $conex->query($q);
    while($info = $resultado->fetch_assoc()) {
        echo $info["tag"]."<br>" ;
    }
    echo "<br><br><br>";
    ?>
    <form method="post">
        <textarea type="text" cols="65" name="tag" placeholder="¿Que tag te interesaría ver? (solo puedes buscar uno a la vez)"></textarea>
        <input name="buscar" type="submit" value="Buscar">
    </form><?php
    include ("buscador_tendencias.php");

    

    ?>
    </html>