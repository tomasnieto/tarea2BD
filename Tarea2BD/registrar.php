<?php
include("empezar_sesion.php");

//ingresa los datos. las contraseñas están hasheadas por md5
if (isset($_POST['registrar'])){
    if (strlen($_POST['nombre_cuenta']) >= 1 && strlen($_POST['username']) >= 1 && strlen($_POST['password']) >= 1){
        $nombre_cuenta = trim($_POST['nombre_cuenta']);
        $username = trim($_POST['username']);
        $password = md5(trim($_POST['password']));
        $consulta = "INSERT INTO usmers(nombre_cuenta,username,contraseña,n_seguidos,n_seguidores) VALUES ('$nombre_cuenta','$username','$password','','')";
        $resultado = mysqli_query($conex,$consulta);
        if ($resultado) {
            ?>
            <h3>¡Tu usmer a sido creado!</h3>
            <?php
        }else {
            ?>
            <h3>¡Ese nombre de cuenta ya está tomado!</h3>
            <?php
        }

    }   else {
            ?>
            <h3>Debes llenar todos los campos</h3>
            <?php
    }
}

?>