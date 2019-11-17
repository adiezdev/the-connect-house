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
$a = array(
    "widgets" => ESTILOS_WIDGETS ,
    "registrar" => ESTILOS_REGISTRAR_PISO ,
);
//
$objects = json_decode( json_encode( $a ) , false );

cabecera( $titulo , $objects , true );

?>
<body>
</body>
