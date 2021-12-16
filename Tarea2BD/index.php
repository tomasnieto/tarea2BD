<!DOCTYPE html>
<html>
<body>

    <nav id="navbar">
    <a class="navbarElem" style="margin-left: 45%" href="login.php"><b>Iniciar Sesion</b></a>
        </nav><br></br>

    <form method="post">
        <input type="text" name="nombre_cuenta" placeholder="nombre de tu cuenta">
        <input type="text" name="username" placeholder="nombre de usuario">
        <input type="password" name="password" placeholder="contraseña">
        <input type="submit" value="Crear usmer!"name="registrar">
    </form>
        <?php
        include("registrar.php");
        ?>
</body>
</html>