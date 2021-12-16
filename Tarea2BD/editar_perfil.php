<!DOCTYPE html>
<html>
<body>

    <nav id="navbar">
    <a class="navbarElem" style="margin-left: 45%" href="perfil.php"><b>Volver</b></a>
        </nav><br></br>
    <?php
    include("empezar_sesion.php");
    $usuario = $_SESSION['username'];
    echo("<h3>Editar Perfil de $usuario</h3><br/>");
    echo("Debes llenar todos los campos! si no quieres cambiar un campo, llénalo con la información original.<br/><br/>");
    ?>
    <form method="post">
        <input type="text" name="nombre_cuenta" placeholder="Nuevo nombre de tu cuenta">
        <input type="text" name="username" placeholder="Nuevo nombre de usuario">
        <input type="text" name="password" placeholder="Nueva contraseña">
        <input type="submit" value="Actualizar usmer!"name="cambiar">
    </form>

    <form  method="post">
    <p>
    <input type="submit" value="Borrar usmer" name="borrar_usmer">
    </p>
    </form>
        <?php
        include("update_perfil.php");
        ?>
</body>
</html>