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
	//Comporbamos si el usuario existe
    if($oDbUsuario->getByCorreo( $sCorreo ) > 0)
    {
	    $oRespuesta->Estado = "KO";
	    $oRespuesta->Mensaje = "El usuario está registrado prueba con otro correo";
	    json_encode($oRespuesta);
	    return;
    }
    //
	//Creamos una carpeta dentro de upload asiganda a ese usario
	$carpeta = md5(rand(10));
	mkdir('uploads/'.$carpeta , 0777 );
	//
	//Accedemos a la base de datos
    $oDbUsuario = new Usuario();
    //Añadimos usuario
    $lResultado = $oDbUsuario->addUsuario($sCorreo, $sPassword, $sNombre , $sApellidos, $sCiudad , $sSexo , 'uploads/'.$carpeta );
    //
	//Sacamos la últma sesión
    $nIdelUsuario = $oDbUsuario->getLastID();
    //
	//Si el usuario no se registra bien
    if(!$lResultado)
    {
        $oRespuesta->Estado = "KO";
        $oRespuesta->Mensaje = "El usuario se ha registrado mal";
	    json_encode( $oRespuesta );
    }
    else
    {
	    //Si es correto asignamos la sesion
	    //
        foreach ( $nIdelUsuario as $nIdelUsuari)
        {
	        $_SESSION['idUsuario']  = $nIdelUsuari->idUsuario; //Extraemos el idUsuario que nos devuelve, se lo damos a la sesión
	        $_SESSION['Carpeta'] = $nIdelUsuari->Carpeta.'/'; //Guardamos la carpeta del usuario la necesitaremos
        }
	    //
        //Devolvemos una respuesta correcta
        $oRespuesta->Estado = "OK";
        $oRespuesta->Mensaje = "Usuario no encontrado";
	    json_encode( $oRespuesta );
    }
    //
    //Enviamos la respuesta
    echo json_encode($oRespuesta);