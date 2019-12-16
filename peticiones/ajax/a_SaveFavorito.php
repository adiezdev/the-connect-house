<?php
    //error_reporting( E_ALL );
    //ini_set( 'display_errors' , true );
    //ini_set( 'display_startup_errors' , true );
    /*
        -------------------------------------
        Archivo de: Alejandro Díez
        GitHub: @adilosa95
        Proyecto: the-connect-house
        Nombre del archivo: a_SaveFavorito.php
        -------------------------------------
    */

    //Accede mos a BDDD
    require_once(__DIR__.'/../../bd/bd_favoritos.php');
    //
    session_start();
    //
    // Inicalizamos variables.
    $oRespuesta = new stdClass();
    //
    // Obtenemos los datos del JSON.
    $oDatosJson = json_decode( file_get_contents( "php://input" ), true );
    //
    //Guardamos la variable
    $nFavorito = $oDatosJson["fav"];
    //
    //Accedemos a la tabla Favoritos
    $oDbFavorito = new Favoritos();
    //
    //Añadimos a favorito
    $lResultado = $oDbFavorito->addFav( $_SESSION["idUsuario"] , $nFavorito );
    //
    //Si ha fallado retornamos un KO
    if(!$lResultado)
    {
        $oRespuesta->Estado = "KO";
        $oRespuesta->Mensaje = "No se ha add";
        echo json_encode( $lResultado );
        return;
    }
   else //Si ha sido correcto
    {
        $oRespuesta->Estado = "OK";
        $oRespuesta->Mensaje = "add";
        json_encode($oRespuesta);
    }
    //
    //Enviamos la respuesta
    echo json_encode($oRespuesta);