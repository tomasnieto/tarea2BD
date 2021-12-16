<?php
if(!isset($_SESSION)) //session_start dentro de un if para que no tire warning
{ 
    session_start(); 
} 
include("con_db.php");
?>