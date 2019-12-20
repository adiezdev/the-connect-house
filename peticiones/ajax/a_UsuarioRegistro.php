<?php
    //error_reporting( E_ALL );
    //ini_set( 'display_errors' , true );
    //ini_set( 'display_startup_errors' , true );
    require_once(__DIR__ . '/../../bd/bd_usuario.php');
    //
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
    //Accedemos a la base de datos
    $oDbUsuario = new Usuario();
	//
	//Comporbamos si el usuario existe
    $sComprobaciones = $oDbUsuario->getByCorreo( $sCorreo );
    foreach ( $sComprobaciones as $sComprobacione)
    {
        if($sComprobacione->idUsuario > 0)
        {
            $oRespuesta->Estado = "KO";
            $oRespuesta->Mensaje = "El usuario esta registrado prueba con otro correo";
            echo json_encode($oRespuesta);
            return;
        }
    }
    //
	//Creamos una carpeta dentro de upload asiganda a ese usario
	$carpeta = md5(rand( ));
	mkdir( $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$carpeta.'/' , 0755 , true);
	//
    //El método mkdir da errores con los permisos, pasamos la carpeta por chmod asi damos todos los permisos para porder guardar ahí
    chmod($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$carpeta.'/' , 0777);
    //Añadimos usuario
    $lResultado = $oDbUsuario->addUsuario($sCorreo, $sPassword, $sNombre , $sApellidos, $sCiudad , $sSexo , $carpeta );
    //
	//Sacamos la últma sesión
    $nIdelUsuario = $oDbUsuario->getLastID();
    //
	//Si el usuario no se registra bien
    if(!$lResultado)
    {
        $oRespuesta->Estado = "KO";
        $oRespuesta->Mensaje = "El usuario se ha registrado mal";
        echo json_encode( $oRespuesta );
	    return;
    }
    else
    {
	    //Si es correto asignamos la sesion
	    //
        foreach ( $nIdelUsuario as $nIdelUsuari)
        {
	        $_SESSION['idUsuario']  = $nIdelUsuari->idUsuario; //Extraemos el idUsuario que nos devuelve, se lo damos a la sesión
        }
        //Valor del tiempo
        $_SESSION['tiempo']=time();
	    //
        //Devolvemos una respuesta correcta
        $oRespuesta->Estado = "OK";
        $oRespuesta->Mensaje = "Usuario no encontrado";
        $oRespuesta->IdUsuario = $_SESSION['idUsuario'];
        json_encode( $oRespuesta );
    }
    //
    //Enviamos la respuesta
    echo json_encode($oRespuesta);