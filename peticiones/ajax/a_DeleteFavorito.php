<?php
    //error_reporting( E_ALL );
    //ini_set( 'display_errors' , true );
    //ini_set( 'display_startup_errors' , true );
    /*
        -------------------------------------
        Archivo de: Alejandro Díez
        GitHub: @adilosa95
        Proyecto: the-connect-house
        Nombre del archivo: a_DeleteFavorito.php
        -------------------------------------
    */
    //Accede mos a BDDD
    require_once(__DIR__.'/../../bd/bd_favoritos.php');
    //
    // Inicalizamos variables.
    $oRespuesta = new stdClass();
    //
    // Obtenemos los datos del JSON.
    $oDatosJson = json_decode( file_get_contents( "php://input" ), true );
    //
    $nFavorito = $oDatosJson["fav"];
    //
    $oDbFavorito = new Favoritos();
    //
    $lResultado = $oDbFavorito->deleteFav( $nFavorito );
    //
    if(!$lResultado)
    {
        $oRespuesta->Estado = "KO";
        $oRespuesta->Mensaje = "No se ha add";
        echo json_encode( $lResultado );
        return;
    }
    else
    {
        $oRespuesta->Estado = "OK";
        $oRespuesta->Mensaje = "add";
        json_encode($oRespuesta);
    }
    //
    //Enviamos la respuesta
    echo json_encode($oRespuesta);