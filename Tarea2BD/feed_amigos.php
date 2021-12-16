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
    //por privacidad, los reusmitos de los amigos no se pueden reusmear!
    include("empezar_sesion.php");
    $usuario = $_SESSION['username'];
    $_SESSION['amigos']=1;
    $_SESSION['busqueda'] = 'feed_amigos';//para redireccionar

    echo("<h3>¡Este es el feed de tus amigos, $usuario!</h3>");
    $lista_siguiendo = [];
    
    $q = "SELECT nombre_siguiendo FROM siguiendo WHERE nombre_cuenta='$usuario'";
    $resultado = $conex->query($q);
    if ($resultado->num_rows > 0) {
        $i = 0;
        while($info = $resultado->fetch_assoc()) {
          $lista_siguiendo[$i] = $info["nombre_siguiendo"];
          $i = $i + 1;
        }
        $compactada = join(",",$lista_siguiendo);
        

        //en esta gran consulta se filtran los usmitos cuyo creador y usuario se siguen entre si
        //y por ultimo revisa si el usmito esta pensado para enviarse solo a los amigos
        $q = "SELECT usmito_id,texto_tag,me_encanta,texto,nombre_cuenta,fecha FROM usmitos WHERE nombre_cuenta in (SELECT nombre_siguiendo FROM siguiendo WHERE nombre_cuenta='$usuario' INTERSECT SELECT nombre_cuenta FROM siguiendo WHERE nombre_siguiendo='$usuario') AND amigos_cercanos=1 ORDER BY fecha DESC";
        $resultado = $conex->query($q);
        if ($resultado !== false && $resultado->num_rows > 0) {
            echo "----------------------------------------";
            while($info = $resultado->fetch_assoc()) {
                echo "<br>". $info["fecha"]. "<br>-". $info["nombre_cuenta"]."<br>". $info["texto"]. "<br><br>Tags: " . $info["texto_tag"] . "<br><br>" .$info["me_encanta"]. " Likes<br>";
                //enviar comentario y dejar like mediante metodo post con id unico para cada post del feed
                $id_usmito = $info['usmito_id'];
                $q = "SELECT COUNT(*) as contar from likes where nombre_cuenta = '$usuario' and usmito_id='$id_usmito'";
                $consulta = mysqli_query($conex,$q);
                $array = mysqli_fetch_array($consulta);
                $like = $array['contar'];
                if ($like == 0) {
                  ?>
                  <form action="enviar_like.php" method="post">
                  <input type="hidden" name="usmito_id" value="<?php echo $info['usmito_id']; ?>" required>
                  <p>
                      <input type="submit" value="Me encanta" name="enviar_like">
                  </p>
                  </form><?php

                }
                else{
                  ?>
                  <form action="enviar_unlike.php" method="post">
                  <input type="hidden" name="usmito_id" value="<?php echo $info['usmito_id']; ?>" required>
                  <p>
                      <input type="submit" value="Ya no Me encanta" name="enviar_unlike">
                  </p>
                  </form><?php

                }?>

                <! --- dejar like y responder --->

                <form action="enviar_respuesta.php" method="post">
                <input type="hidden" name="usmito_id" value="<?php echo $info['usmito_id']; ?>" required>
                <p>
                    <label></label>
                    <textarea name="comentario" required></textarea>
                </p>
                <p>
                    <input type="submit" value="Enviar comentario" name="enviar_comentario">
                </p>
                </form>

                <! --- ver respuestas --->
                <form action="ver_respuestas.php" method="post">
                <input type="hidden" name="usmito_id" value="<?php echo $info['usmito_id']; ?>" required>
                <p>
                    <input type="submit" value="Ver comentarios" name="ver_comentarios">
                </p>
                </form>
                <?php
                echo "----------------------------------------";
            }
        } else {
            echo "<br>Parece que tus amigos todavía no han escrito nada...";
        }
        
      } else {
        echo "Parece que tu feed está vacio!";
      }

    

    ?>
</html>