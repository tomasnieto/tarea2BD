<?php
include("empezar_sesion.php");
$usuario = $_SESSION['username'];
 
if (isset($_POST["enviar_like"]))
{
    $post_id = mysqli_real_escape_string($conex, $_POST["usmito_id"]);
    
    //consultas para dejar el like y agregarlo a la suma total
    mysqli_query($conex, "INSERT INTO likes(usmito_id,nombre_cuenta) VALUES ('$post_id','$usuario')");
    mysqli_query($conex, "UPDATE usmitos SET me_encanta=(me_encanta+1) WHERE usmito_id=$post_id");


    
    include("redireccionar.php");
}
 
?>