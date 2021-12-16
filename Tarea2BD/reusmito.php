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
 
if (isset($_POST["reusmito"])){
    $post_id = mysqli_real_escape_string($conex, $_POST["usmito_id"]);
 
    //ver si ya le hice reusmito
    $verificar = "SELECT COUNT(*) as contar from reusmeados where nombre_reusmeador = '$usuario' and usmito_id='$post_id'";
    $query = mysqli_query($conex,$verificar);
    $array = mysqli_fetch_array($query);
    $ya_reusmeado = $array['contar'];
    if ($ya_reusmeado == 0) {
        //simplemente se inserta en la tabla de reusmitos
        mysqli_query($conex, "INSERT INTO reusmeados(usmito_id,nombre_reusmeador) VALUES ('$post_id','$usuario')");
        if($_SESSION['busqueda']=='buscador'){
            header("location: buscador.php");
        }
        elseif ($_SESSION['amigos']==0){
            header("location: feed.php");
        }else {
            header("location: feed_amigos.php");
        }
    }else {
        ?>
        <h3>¡Ya le hiciste reusmito a este usmito, <?php echo "$usuario" ?>!</h3>
        <?php
    }


    
}
 
?>