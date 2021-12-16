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
include("empezar_sesion.php");
$usuario = $_SESSION['username'];
$usmito = trim($_POST['usmito']);
$tag = trim($_POST['tag']);
//se revisa para usmitos que son o no para amigos
if(isset($_POST['amigos'])){
    $amigos = $_POST['amigos'];
    if ($amigos){
        $amigos = 1;
    }
    else {
        $amigos = 0;
    }
}else {
    $amigos = 0;
}

if (isset($_POST['publicar'])){
    if (strlen($tag) >= 1 && $amigos == "si"){//los usmitos a amigos no deberian tener tags asociados
        ?>
        <h3>¡No debes anotar tags si tu usmito es para amigos!</h3>
        <?php

    }else{
        //simple insert
        $consulta = "INSERT INTO usmitos(texto_tag,texto,nombre_cuenta,amigos_cercanos) VALUES ('$tag','$usmito','$usuario','$amigos')";
        $resultado = mysqli_query($conex,$consulta);
        if ($resultado) {
            ?>
            </nav> 
            <h3>¡Tu usmito a sido creado!</h3>
            <?php
        }else {
            ?>
            <h3>¡Debes llenar los campos obligatorios!</h3>
            <?php
        }
        //buscamos usmito_id creado para el usmito, ya que es incremental automatico. con cuenta y texto deberia bastar 
        $consulta2 = "SELECT usmito_id FROM usmitos WHERE nombre_cuenta='$usuario' AND texto='$usmito'";
        $resultado2 = $conex->query($consulta2);
        $info = $resultado2->fetch_assoc();
        $identificador = $info["usmito_id"];
        //dividir el texto_tag en lista que contengan los tags por separado
        $tag_dividido = explode(",",$tag);
        //foreach, insertar a tendencias
        foreach ($tag_dividido as $tag_individual) {
            $q = "INSERT INTO tendencias(usmito_id,tag) VALUES ('$identificador','$tag_individual')";
            $resultado = mysqli_query($conex,$q);
        }
    }
}

?>