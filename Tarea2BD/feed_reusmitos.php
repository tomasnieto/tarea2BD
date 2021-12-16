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

    //para los likes, comentarios y reusmitos (para el header)
    $_SESSION['amigos']=0;
    echo("<h3>¡Echa un vistazo a lo que se a reusmeado, $usuario!</h3>");
    //a quien siguo
    $q = "SELECT nombre_siguiendo FROM siguiendo WHERE nombre_cuenta='$usuario'";
    $resultado = $conex->query($q);
    if ($resultado->num_rows > 0) {
        //que han reusmeado
        $q = "SELECT usmito_id,nombre_reusmeador FROM reusmeados WHERE nombre_reusmeador in (SELECT nombre_siguiendo FROM siguiendo WHERE nombre_cuenta='$usuario')";
        $resultado = $conex->query($q);
        if ($resultado !== false && $resultado->num_rows > 0) {
            echo "----------------------------------------";
            while($info = $resultado->fetch_assoc()) {//falta poder dar like y responder
                $usmito = $info["usmito_id"];
                //se muestra el reusmito
                $q2 = "SELECT texto_tag,me_encanta,texto,nombre_cuenta,fecha FROM usmitos WHERE usmito_id = '$usmito'";
                $r2 = $conex->query($q2);
                $usmito_reusmeado = $r2->fetch_assoc();
                echo "<br>". $usmito_reusmeado["fecha"]. "<br>-". $usmito_reusmeado["nombre_cuenta"]."<br>". $usmito_reusmeado["texto"]. "<br><br>Tags: " . $usmito_reusmeado["texto_tag"] . "<br><br>" .$usmito_reusmeado["me_encanta"]. " Likes<br>";
                echo "Reusmeado por " .$info["nombre_reusmeador"]."<br>";
                echo "----------------------------------------";
            }
        } else {
            echo "<br>Parece que la gente que sigues todavía no han reusmeado nada...";
        }
        
      } else {
        echo "Parece que tu feed de reusmitos está vacio!";
      }

    

    ?>
</html>