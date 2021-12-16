<?php
include("empezar_sesion.php");
$usuario = $_SESSION['username'];
 
if (isset($_POST["enviar_comentario"]))
{
    $comentario = mysqli_real_escape_string($conex, $_POST["comentario"]);
    $post_id = mysqli_real_escape_string($conex, $_POST["usmito_id"]);
 
    mysqli_query($conex, "INSERT INTO respuesta(usmito_id,nombre_cuenta_responde,respuesta) VALUES ('$post_id','$usuario','$comentario')");
    
    include("redireccionar.php");

}
 
?>