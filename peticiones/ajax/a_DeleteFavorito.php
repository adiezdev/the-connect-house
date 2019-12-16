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
    //Guardamos el id
    $nFavorito = $oDatosJson["fav"];
    //
    //Accedemos a la tabla favorito
    $oDbFavorito = new Favoritos();
    //
    //Eliminamos de favorito
    $lResultado = $oDbFavorito->deleteFav( $nFavorito );
    //
    //Si ha fallado retornamos un KO
    if(!$lResultado)
    {
        $oRespuesta->Estado = "KO";
        $oRespuesta->Mensaje = "No se ha eliminado";
        echo json_encode( $lResultado );
        return;
    }
    else //Si es correcto
    {
        $oRespuesta->Estado = "OK";
        $oRespuesta->Mensaje = "delete";
        json_encode($oRespuesta);
    }
    //
    //Enviamos la respuesta
    echo json_encode($oRespuesta);