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
    $_SESSION['busqueda'] = 'feed';

    //para los likes, comentarios y reusmitos (para el header)
    $_SESSION['amigos']=0;
    echo("<h3>Feed de $usuario</h3>");
    $lista_siguiendo = [];
    $q = "SELECT nombre_siguiendo FROM siguiendo WHERE nombre_cuenta='$usuario'";
    $resultado = $conex->query($q);
    if ($resultado->num_rows > 0) {

        //usmitos de creadores que siguo
        $q = "SELECT usmito_id,texto_tag,me_encanta,texto,nombre_cuenta,fecha FROM usmitos WHERE nombre_cuenta in (SELECT nombre_siguiendo FROM siguiendo WHERE nombre_cuenta='$usuario') AND amigos_cercanos=0 ORDER BY fecha DESC";
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
                  ?><! ---dejar like --->
                  <form action="enviar_like.php" method="post">
                  <input type="hidden" name="usmito_id" value="<?php echo $info['usmito_id']; ?>" required>
                  <p>
                      <input type="submit" value="Me encanta" name="enviar_like">
                  </p>
                  </form><?php

                }
                else{
                  ?><! ---quitar like --->
                  <form action="enviar_unlike.php" method="post">
                  <input type="hidden" name="usmito_id" value="<?php echo $info['usmito_id']; ?>" required>
                  <p>
                      <input type="submit" value="Ya no Me encanta" name="enviar_unlike">
                  </p>
                  </form><?php

                }?>

                <! ---responder --->

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

                <! --- reusmito --->
                <form action="reusmito.php" method="post">
                <input type="hidden" name="usmito_id" value="<?php echo $info['usmito_id']; ?>" required>
                
                <p>
                    <input type="submit" value="Hacer reusmito" name="reusmito">
                </p>
                </form>
                <?php
                echo "----------------------------------------";
            }
        } else {
            echo "<br>Parece que la gente que sigues todavía no han escrito nada...";
        }
        
      } else {
        echo "Parece que tu feed está vacio!";
      }

    

    ?>
</html>