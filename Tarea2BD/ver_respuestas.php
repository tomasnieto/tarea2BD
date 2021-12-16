<nav id="navbar">
        <a class="navbarElem" style="margin-left: 30%" href="perfil.php"><b>Perfil</b></a> |
        <a class="navbarElem" href="feed.php"><b>Feed</b></a> |
        <a class="navbarElem" href="feed_amigos.php"><b>Feed de tus Amigos</b></a> |
        <a class="navbarElem" href="tendencias.php"><b>Tendencias</b></a> |
        <a class="navbarElem" href="crear_usmito.php"><b>Crear</b></a> |
        <a class="navbarElem" href="buscador.php"><b>Buscar</b></a> |
        <a class="navbarElem" href="cerrar_sesion.php"><b>Cerrar Sesion</b></a> |
        </nav> 
<?php


include("empezar_sesion.php");
$usuario = $_SESSION['username'];
 
if (isset($_POST["ver_comentarios"]))
{
    $post_id = mysqli_real_escape_string($conex, $_POST["usmito_id"]);
 
    //simple select usando usmito_id en respuesta
    $comentarios = "SELECT nombre_cuenta_responde,respuesta FROM respuesta WHERE usmito_id='$post_id'";
        $result = $conex->query($comentarios);
        if ($result !== false && $result->num_rows > 0) {
            echo "----------------------------------------";
            while($contenido = $result->fetch_assoc()) {
                echo  "<br>-". $contenido["nombre_cuenta_responde"]."<br>".$contenido["respuesta"]."<br>";
                echo "----------------------------------------";
            }
        }
}
 
?>