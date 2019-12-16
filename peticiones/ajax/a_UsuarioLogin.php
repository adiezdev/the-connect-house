<?php
    //error_reporting( E_ALL );
    //ini_set( 'display_errors' , true );
    //ini_set( 'display_startup_errors' , true );
    require_once(__DIR__ . '/../../bd/bd_usuario.php');
    //
    session_start();
    //
    // Inicalizamos variables.
    $oRespuesta = new stdClass();
    //
    // Obtenemos los datos del JSON.
    $oDatosJson = json_decode( file_get_contents( "php://input" ), true );
    //
   $sCorreo = $oDatosJson["Correo"];
   $sPassword = md5($oDatosJson["Password"]); //Encryptamos la contraseña
	//
	//Accedemos a la base de datos
   $oDbUsuario = new Usuario();
   //
   //Buscamos el ususario
   $lResultados = $oDbUsuario->getLogin( $sCorreo , $sPassword);
   //
   //Si el usuario no lo hemos encontrado no devuelve un error
   if(!$lResultados)
   {
       $oRespuesta->Estado = "KO";
       $oRespuesta->Mensaje = "Usuario no encontrado";
	   echo json_encode( $oRespuesta );
	   return;
   }
  else
  {
	  foreach ($lResultados as $lResultado)
	  {
		  $_SESSION['idUsuario']  = $lResultado->idUsuario; //Extraemos el idUsuario que nos devuelve, se lo damos a la sesión
	  }
      //Valor del tiempo
      $_SESSION['tiempo']= time();
      //
      $oRespuesta->Estado = "OK";
      $oRespuesta->Mensaje = "Usuario encontrado";
      json_encode($oRespuesta);
   }
   //
   //Enviamos la respuesta
   echo json_encode($oRespuesta);
