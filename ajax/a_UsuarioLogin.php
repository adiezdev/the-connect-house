<?php
require_once(__DIR__.'/../bd/db_usuario.php');
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
   $lResultado = $oDbUsuario->getLogin( $sCorreo , $sPassword);
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
?>