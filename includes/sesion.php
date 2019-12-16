<?php
if( session_status() == PHP_SESSION_NONE )
{
    ob_start();
    session_start();
}
//
// Comprobar que el usuario está logueado (que hay una sesión iniciada)
if( !isset( $_SESSION['idUsuario'] ))
{
    //
    // No logueado
    header( "location:/the-connect-house/login-registro.php?Sesion=true" );
    return;
}
//Comprobar la sesión
if (time() - $_SESSION['tiempo'] > 12000)
{
    //La sesión se destruye
    session_destroy();

    header("location:/the-connect-house/login-registro.php");
    die();
}
