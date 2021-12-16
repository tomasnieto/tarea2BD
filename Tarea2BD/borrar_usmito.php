<?php
include("empezar_sesion.php");
$usuario = $_SESSION['username'];
 
//simple eliminación de usmito mediante consulta query
if (isset($_POST['borrar_usmito'])){
    $post_id = mysqli_real_escape_string($conex, $_POST["usmito_id"]);
    $consulta = "DELETE FROM usmitos WHERE usmito_id='$post_id'";
    $resultado = mysqli_query($conex,$consulta);
    
    if ($resultado) {
        header("location: usmitos_de_cuenta.php");
    }
    
}
 
?>