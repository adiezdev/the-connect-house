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
	//Acceso a datos
    require_once(__DIR__."/bd/bd_pisos.php");
    require_once(__DIR__."/bd/bd_secciones.php");
    //
    //Configuramos los estilos que necesitamos
    $estilos = array(
        ESTILOS_WIDGETS ,
        ESTILOS_REGISTRAR_PISO ,
    );
    //
    //Lo cogemos el tipò que vamos añadir
	$titulo = '';
    if($_GET)
    {
        $nTipo = $_GET['Tipo'];
    }
    //
    //Titulo depencidendo de lo que sea
    if( $nTipo == 1)
    {
        $titulo = 'Añadir Piso';
    }
    else
    {
        $titulo = 'Añadir Habitacion';
    }
    //
    //Generamos la cabecera
    cabecera( $titulo , $estilos , true );
    //
    //
?>
<body>
    <!--Seccion1-->
    <div class="seccion">
        
    </div>
    <!--Seccion2-->
    <div class="seccion">

    </div>
    <!--Seccion3-->
    <div class="seccion">

    </div>
    <!--Seccion4-->
    <div class="seccion">

    </div>
</body>
