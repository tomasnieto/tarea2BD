<?php
//se redirecciona a la seccion correspondiente, despues de dar like o comentar
if($_SESSION['busqueda']=='buscador'){
        header("location: buscador.php");
    }
    elseif ($_SESSION['busqueda']=='tendencias') {
        header("location: tendencias.php");
    }
    elseif ($_SESSION['amigos']==0){
        header("location: feed.php");
    }else {
        header("location: feed_amigos.php");
    }
    ?>