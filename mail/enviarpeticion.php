<?php
    /*
        -------------------------------------
        Archivo de: Alejandro Díez
        GitHub: @adilosa95
        Proyecto: the-connect-house
        Nombre del archivo: enviarpeticion.php
        -------------------------------------
    */
    //
    require_once (__DIR__.'/mail.php');
    // Inicalizamos variables.
    $oRespuesta = new stdClass();
    //
    $oDatosJson = json_decode( file_get_contents( "php://input" ), true );
    //
    //Correo a quien se lo enviamos
    $mail = $oDatosJson['mail'];
    //A quien le interesa
    $user = $oDatosJson['usuario'];
    //
    //Descripcion
    $descripcion = $oDatosJson['descripcion'];
    //
    $datos = array("mail" => $user , "descripcion" => $descripcion );
    //
    //Formamos le correo
    $correo = new Correo();
    $correo->enviaCorreo( $mail,"Le interesa tu alquiler", $correo->enviarinter($datos));
    //
    $oRespuesta->Estado = "OK";
    $oRespuesta->Mensaje = "enviado";
    //
    echo json_encode($oRespuesta);