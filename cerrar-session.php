<?php
/*
    -------------------------------------
    Archivo de: Alejandro Díez
    GitHub: @adilosa95
    Proyecto: the-connect-house
    Nombre del archivo: cerrar-session.php
    -------------------------------------
*/

session_start();

foreach ($_SESSION as $key => $value)
{
$_SESSION[$key] = NULL;
}

session_destroy();

header( "location:/the-connect-house/login-registro.php" );
