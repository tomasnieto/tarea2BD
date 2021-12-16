<?php
include("con_db.php");
//no se me ocurrio una manera bonita para hacer el apdate del perfil considerando parametros vacios
//el usuario debe llenar todos los campos incluso con la informacion original
if (isset($_POST['cambiar'])){
    if (strlen($_POST['nombre_cuenta']) >= 1){
        $nombre_cuenta = trim($_POST['nombre_cuenta']);
        $username = trim($_POST['username']);
        $password = md5(trim($_POST['password']));
        $consulta = "UPDATE usmers SET nombre_cuenta='$nombre_cuenta',username='$username',contraseña='$password' WHERE nombre_cuenta='$usuario'";
        $resultado = mysqli_query($conex,$consulta);
        if ($resultado) {
            $_SESSION['username'] = $nombre_cuenta;

        }

    }
    header('location: perfil.php');
}

//se borra de la tabla de usmers y se cambian los valores de n_siguiendo y n_seguidos de quien corresponda
if (isset($_POST['borrar_usmer'])){
    
    $consulta = "DELETE FROM usmers WHERE nombre_cuenta='$usuario'";
    $resultado = mysqli_query($conex,$consulta);

    $consulta2 = "UPDATE usmers SET n_seguidos=(n_seguidos-1) WHERE nombre_cuenta IN(SELECT nombre_cuenta FROM siguiendo WHERE nombre_siguiendo=$usuario)";
    $resultado = mysqli_query($conex,$consulta2);

    $consulta3 = "UPDATE usmers SET n_seguidores=(n_seguidores-1) WHERE nombre_cuenta IN(SELECT nombre_siguiendo FROM siguiendo WHERE nombre_cuenta=$usuario)";
    $resultado = mysqli_query($conex,$consulta3);
    
    if ($resultado) {
        $_SESSION['username'] = '';

    }
    header('location: index.php');
}

?>