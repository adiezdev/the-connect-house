<?php
//error_reporting( E_ALL );
//ini_set( 'display_errors' , true );
//ini_set( 'display_startup_errors' , true );
/*
    -------------------------------------
    Archivo de: Alejandro Díez
    GitHub: @adilosa95
    Proyecto: the-connect-house
    Nombre del archivo: registrar-piso-habitacion.php
    -------------------------------------
*/
    require_once(__DIR__."/includes/header.php" );
    require_once(__DIR__."/includes/constantes.php" );
    require_once(__DIR__."/includes/sesion.php");
    //
    //Configuramos los estilos que necesitamos
    $estilos = array(
        ESTILOS_WIDGETS ,
        ESTILOS_REGISTRAR_PISO ,
    );
    //
    //Generamos la cabecera
    cabecera( '$titulo' , $estilos , true );

?>
<body>
</body>
