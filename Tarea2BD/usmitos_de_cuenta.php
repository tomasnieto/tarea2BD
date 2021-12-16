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

$sesion = $_SESSION['username'];
$usuario = $_SESSION['usmitos_nombre_propietario'];
$n_usmitos = $_SESSION['n_usmitos'];
echo("<h3>La cuenta $usuario tiene $n_usmitos usmitos creados</h3>");
//se revisa que los usmito que estoy viendo son o no los mios
if($sesion==$usuario){
  $q = "SELECT usmito_id,texto_tag,me_encanta,texto,amigos_cercanos,fecha FROM usmitos WHERE nombre_cuenta ='$usuario' ORDER BY fecha DESC";
}else {
  echo("<h3>Solo se mostrarán los usmitos que no son para los amigos cercanos de $usuario</h3>");
  $q = "SELECT usmito_id,texto_tag,me_encanta,texto,amigos_cercanos,fecha FROM usmitos WHERE nombre_cuenta ='$usuario' AND amigos_cercanos=0 ORDER BY fecha DESC";
}

$resultado = $conex->query($q);
if ($resultado->num_rows > 0) {
  //se muestran los usmitos mediante fetch_assoc
  echo "----------------------------------------";
  while($info = $resultado->fetch_assoc()) {
    echo "<br> creado el: ". $info["fecha"]. "<br>". $info["texto"]. "<br>Tags: " . $info["texto_tag"] . "<br>" .$info["me_encanta"]. " Likes <br><br>";
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
    if ($sesion==$usuario) {
      ?>
      <! --- borrar usmito --->
      <form action="borrar_usmito.php" method="post">
      <input type="hidden" name="usmito_id" value="<?php echo $info['usmito_id']; ?>" required>
      <p>
          <input type="submit" value="Borrar usmito" name="borrar_usmito">
      </p>
      </form> <?php  
    }
    
      
    echo "----------------------------------------";
  
  
  }
} else {
  if($sesion==$usuario){//se revisa que los usmito que estoy viendo son o no los mios
    echo "Tu cuenta no tiene usmitos, prueba crear uno <a href=crear_usmito.php>ahora!";
  }else {
    echo "Parece que $usuario no ha escrito ningún usmito!";
  }
  
}


?>
</html>