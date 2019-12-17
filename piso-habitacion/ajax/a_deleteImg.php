<?php
    //error_reporting( E_ALL );
    //ini_set( 'display_errors' , true );
    //ini_set( 'display_startup_errors' , true );
    /*
        -------------------------------------
        Archivo de: Alejandro Díez
        GitHub: @adilosa95
        Proyecto: the-connect-house
        Nombre del archivo: a_deleteImg.php
        -------------------------------------
    */
    session_start();
    require_once(__DIR__ . '/../../bd/bd_imagenespiso.php');
    //
    // Inicalizamos Respuesta.
    $oRespuesta = new stdClass();
    //
    // Obtenemos los datos del JSON.
    $oDatosJson = json_decode(file_get_contents("php://input"), true);
    //
    //Sacamos la variable
    $imageneliminar = $oDatosJson['imagedelete'];
    $src = $oDatosJson['src'];
    //
    unlink( $_SERVER['DOCUMENT_ROOT'].$src);
    //
    $oDbImagenes = new Imagenes();
    $lResultado = $oDbImagenes->deleteImage($imageneliminar );
    //
    if(!$lResultado)
    {
        $oRespuesta->Estado = "KO";
        $oRespuesta->Mensaje = "Por favor vuelve a intentarlo";
        echo json_encode( $oRespuesta );
        return;
    }
    else
    {
        $oRespuesta->Estado = "OK";
        $oRespuesta->Mensaje = "Eliminado";
        json_encode( $oRespuesta );
    }
    //Devolvemos respuesta
    echo json_encode( $oRespuesta );