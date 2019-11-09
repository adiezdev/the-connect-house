<?php
require_once(__DIR__.'/../bd/db_usuario.php');
    //
    //Inciamos las varibles
    $oRespuesta = new stdClass();
    //
    // Obtenemos los datos JSON
    $oDatosJson = json_decode( file_get_contents( "php://input"), true);
    //
    $sNombre = $oDatosJson["Nombre"];
    $sApellidos = $oDatosJson["Apellidos"];
    $sCorreo = $oDatosJson["Correo"];
    $sSexo = $oDatosJson["Sexo"];
    $sPassword =  md5($oDatosJson["Password"]) ; //Encryptamos la contraseña
    //
    $oDbUsuario = new Usuario();
    $lResultado = $oDbUsuario->addUsuario($sCorreo, $sPassword, $sNombre , $sApellidos, $sSexo);
    //
    if(!$lResultado)
    {
        $oRespuesta->Estado = "KO";
        $oRespuesta->Mensaje = "Usuario no encontrado";
    }
    else
    {
        //Si es correto asignamos la sesion
        $_SESSION['idUsuario'] = $sCorreo;
        $oRespuesta->Estado = "OK";
        $oRespuesta->Mensaje = "Usuario encontrado";

    }
    //
    //Enviamos la respuesta
    echo json_encode($oRespuesta);