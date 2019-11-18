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
    header( "location:/the-connect-house/login-registro.php" );
    return;
}
//
// Comprobar que la sesión no haya caducado
/*if( isset( $_SESSION['UltimoAcceso'] ) )
{
    $dTime = $_SESSION['UltimoAcceso'];
    if( $dTime + 60*60 < time() )
    {
        //
        // Sesíón caducada
        header( "location:/../login-registro.php" );
        return;
    }
}*/
//
// Actualizamos la hora de último acceso.
//updateSession();
