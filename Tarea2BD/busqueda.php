<?php
include("empezar_sesion.php");
$usuario = $_SESSION['username'];




if (isset($_POST['ingresar'])){
    if (strlen($_POST['buscar']) >= 1){//entrada no nula
        $busqueda = $_POST['buscar'];
        //simple consulta para sacar los datos del perfil
        $q = "SELECT nombre_cuenta,username,n_seguidos,n_seguidores FROM usmers WHERE nombre_cuenta='$busqueda'";
        $resultado = $conex->query($q);
        if ($resultado !== false && $resultado->num_rows > 0) {
            $info = $resultado->fetch_assoc();
            $cuenta = $info["nombre_cuenta"];
            $username = $info["username"];
            $seguidos = $info["n_seguidos"];
            $seguidores = $info["n_seguidores"];
            echo("Perfil de $cuenta <br>");
            echo("Username: $username <br>");
            echo("Número de seguidores: $seguidores <br>");
            echo("Número de seguidos: $seguidos <br>");
            
            //para ver no solo mis usmitos pero también de quien se busque
            $_SESSION['usmitos_nombre_propietario'] = $cuenta;
            //se cuentan los usmitos que tiene el perfil
            $q = "SELECT COUNT(*) as contar from usmitos where nombre_cuenta = '$cuenta'";
            $consulta = mysqli_query($conex,$q);
            $array = mysqli_fetch_array($consulta);
            $n_usmitos = $array['contar'];
            $_SESSION['n_usmitos'] = $n_usmitos;//para usmitos_de_cuenta.php


            //lo mismo para la cantidad de reusmitos realizados
            $q = "SELECT COUNT(*) as contar from reusmeados where nombre_reusmeador = '$cuenta'";
            $consulta = mysqli_query($conex,$q);
            $array = mysqli_fetch_array($consulta);
            $n_reusmitos = $array['contar'];
            $_SESSION['n_reusmitos'] = $n_reusmitos;

            
            echo("$cuenta a creado <a href=usmitos_de_cuenta.php>$n_usmitos usmitos</a> y <a href=ver_reusmitos.php>$n_reusmitos reusmitos</a></a><br/><br/>");
            
            //ver si estoy siguiendo a el usuario que busque
            $q = "SELECT COUNT(*) as contar from siguiendo where nombre_cuenta = '$usuario' and nombre_siguiendo='$cuenta'";
            $consulta = mysqli_query($conex,$q);
            $array = mysqli_fetch_array($consulta);
            $siguo = $array['contar'];
            $_SESSION['siguiendo'] = $cuenta;
            if ($siguo == 0) {//no lo siguo
                ?>
                <form action="seguir.php" method="post">
                    <input name="seguir" type="submit" value="Seguir">
                </form><?php
            
            } else {//lo siguo
                ?>
                <form action="dejar_seguir.php" method="post">
                    <input name="no_seguir" type="submit" value="No Seguir">
                </form>
                <?php
            } 
        }else {
            ?>
            <h3>¡No encontramos ningún usmer!</h3>
            <?php
        }
    }else {
        ?>
        <h3>¡Debes ingresar algo que buscar!</h3>
        <?php
    }
}

//lo mismo de arriba pero para usmitos
if (isset($_POST['ingresar_usmito'])){
    if (strlen($_POST['buscar_usmito']) >= 1){
        $busqueda = $_POST['buscar_usmito'];
        //se hace uso de LIKE para que no se tenga que escribir todo el texto de memoria para buscarlo
        $q = "SELECT usmito_id,texto_tag,me_encanta,texto,nombre_cuenta,amigos_cercanos,fecha FROM usmitos WHERE texto LIKE '%$busqueda%'";
        $resultado = $conex->query($q);
        if ($resultado !== false && $resultado->num_rows > 0) {//la busqueda es valida y existe
            echo "----------------------------------------";
            while($info = $resultado->fetch_assoc()) {
                //se muestran todos los resultados. se puede dar like y comentar
                
                echo "<br>". $info["fecha"]. "<br>-". $info["nombre_cuenta"]."<br>". $info["texto"]. "<br><br>Tags: " . $info["texto_tag"] . "<br><br>" .$info["me_encanta"]. " Likes<br>";
                $id_usmito = $info['usmito_id'];
                //veo si ya lo siguo
                $q2 = "SELECT COUNT(*) as contar from likes where nombre_cuenta = '$usuario' and usmito_id='$id_usmito'";
                $consulta = mysqli_query($conex,$q2);
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
        
        }else {
            ?>
            <h3>¡No encontramos ningún usmito!</h3>
            <?php
        }
    }else {
        ?>
        <h3>¡Debes ingresar algo que buscar!</h3>
        <?php
    }
}