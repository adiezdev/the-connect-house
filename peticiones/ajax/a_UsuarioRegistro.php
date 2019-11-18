<?php
    //error_reporting( E_ALL );
    //ini_set( 'display_errors' , true );
    //ini_set( 'display_startup_errors' , true );
    require_once(__DIR__ . '/../../bd/bd_usuario.php');
    session_start();
    //
    //Inciamos las varibles
    $oRespuesta = new stdClass();
    //
    // Obtenemos los datos JSON
    $oDatosJson = json_decode( file_get_contents( "php://input" ), true);
    //
    $sNombre = $oDatosJson["Nombre"];
    $sApellidos = $oDatosJson["Apellidos"];
    $sCiudad = $oDatosJson["Ciudad"];
    $sCorreo = $oDatosJson["Correo"];
    $sSexo = $oDatosJson["Sexo"];
    $sPassword =  md5($oDatosJson["Password"]) ; //Encryptamos la contraseña
    //
    $oDbUsuario = new Usuario();
    $lResultado = $oDbUsuario->addUsuario($sCorreo, $sPassword, $sNombre , $sApellidos, $sCiudad , $sSexo);
    //
    $nIdelUsuario = $oDbUsuario->getLastID();
    //
    if(!$lResultado)
    {
        $oRespuesta->Estado = "KO";
        $oRespuesta->Mensaje = "Usuario no encontrado";
    }
    else
    {
        foreach ( $nIdelUsuario as $nIdelUsuari)
        {
            $_SESSION['idUsuario'] = $nIdelUsuari->idUsuario;
        }
        //Si es correto asignamos la sesion
        //
        $oRespuesta->Estado = "OK";
        $oRespuesta->Mensaje = "Usuario encontrado";

    }
    //
    //Enviamos la respuesta
    echo json_encode($oRespuesta);