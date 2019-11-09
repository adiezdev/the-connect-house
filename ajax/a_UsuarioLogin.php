<?php
    //error_reporting( E_ALL );
    //ini_set( 'display_errors' , true );
    //ini_set( 'display_startup_errors' , true );
require_once(__DIR__.'/../bd/db_usuario.php');
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
   $oDbUsuario = new Usuario();
   $lResultados = $oDbUsuario->getLogin( $sCorreo , $sPassword);
   $idUser = '';
   foreach ($lResultados as $lResultado)
   {
    $idUser = $lResultado->idUsuario; //Extraemos el idUsuario que nos devuelve
   }
   if(!$lResultados)
   {
       $oRespuesta->Estado = "KO";
       $oRespuesta->Mensaje = "Usuario no encontrado";
   }
  else
  {
      //Si es correto asignamos la sesion
      $_SESSION['idUsuario'] = $idUser;
      $oRespuesta->Estado = "OK";
      $oRespuesta->Mensaje = "Usuario encontrado";
   }
   //
   //Enviamos la respuesta
   echo json_encode($oRespuesta);
?>