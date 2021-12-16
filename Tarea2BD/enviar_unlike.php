<?php
include("empezar_sesion.php");
$usuario = $_SESSION['username'];
 
if (isset($_POST["enviar_unlike"]))
{
    //de borra la instancia de la relacion y se disminuyen los likes
    $post_id = mysqli_real_escape_string($conex, $_POST["usmito_id"]);
    
    mysqli_query($conex, "DELETE FROM likes WHERE usmito_id='$post_id' and nombre_cuenta='$usuario'");
    mysqli_query($conex, "UPDATE usmitos SET me_encanta=(me_encanta-1) WHERE usmito_id=$post_id");

    include("redireccionar.php");

    
}
 
?>