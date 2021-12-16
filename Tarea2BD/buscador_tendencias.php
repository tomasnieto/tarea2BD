<?php

include("empezar_sesion.php");
$_SESSION['busqueda']='tendencias';

if (isset($_POST['buscar'])){
    if (strlen($_POST['tag']) >= 1){//la busqueda debe ser no nula
        $tag = trim($_POST['tag']);

        //no hace falta comprobar si son usmitos para amigos, ya que los usmitos para amigos no llevan tag!
        $q = "SELECT usmito_id,texto_tag,me_encanta,texto,nombre_cuenta,fecha FROM usmitos WHERE usmito_id in (SELECT usmito_id FROM tendencias WHERE tag='$tag') ORDER BY fecha DESC";
        $resultado = $conex->query($q);
        if ($resultado !== false && $resultado->num_rows > 0) {
            echo "----------------------------------------";
            while($info = $resultado->fetch_assoc()) {
                //aca rescatamos la informacion de cada usmito e introducimos los metodos post para dar like, responder etc
                echo "<br>". $info["fecha"]. "<br>-". $info["nombre_cuenta"]."<br>". $info["texto"]. "<br><br>Tags: " . $info["texto_tag"] . "<br><br>" .$info["me_encanta"]. " Likes<br>";
                $id_usmito = $info['usmito_id'];
                //aca vemos si ya le dio like
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
            ?>
            <h3>Parece que nadie a escrito aún sobre el tema!</h3>
            <?php
        }

    }else {
        ?>
        <h3>Debes Escribir algún tag que buscar!</h3>
        <?php
    }
}
?>