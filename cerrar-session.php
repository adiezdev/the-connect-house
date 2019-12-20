<?php
/*
    -------------------------------------
    Archivo de: Alejandro Díez
    GitHub: @adilosa95
    Proyecto: the-connect-house
    Nombre del archivo: cerrar-session.php
    -------------------------------------
*/
//Inciamos sesión
session_start();
//Recorremos todo lo que tenemos guardado
foreach ($_SESSION as $key => $value)
{
$_SESSION[$key] = NULL;
}
//Lo destruimos
session_destroy();
//Redirigimos
header( "location:/login-registro.php" );
