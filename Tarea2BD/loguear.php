<?php
  include("empezar_sesion.php");

  $nombre_cuenta = $_POST['nombre_cuenta'];
  $clave = md5($_POST['clave']);

  //revisa si la instancia en usmers existe
  $q = "SELECT COUNT(*) as contar from usmers where nombre_cuenta = '$nombre_cuenta' and contraseña = '$clave' ";
  $consulta = mysqli_query($conex,$q);
  $array = mysqli_fetch_array($consulta);

  if($array['contar'] > 0){
    $_SESSION['username'] = $nombre_cuenta;//$_session para tener la informacion del usuario que ha hecho login
    header("location: perfil.php");

  }else {
    ?>
    <nav id="navbar">
        <a class="navbarElem" style="margin-left: 40%" href="login.php"><b>Volver</b></a>
        </nav> 
    <?php
    echo("datos incorrectos");
  }
?>