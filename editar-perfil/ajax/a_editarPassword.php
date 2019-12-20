<?php
    //error_reporting( E_ALL );
    //ini_set( 'display_errors' , true );
    //ini_set( 'display_startup_errors' , true );
    /*
        -------------------------------------
        Archivo de: Alejandro Díez
        GitHub: @adilosa95
        Proyecto: the-connect-house
        Nombre del archivo: a_editarPassword.php
        -------------------------------------
    */
    session_start();
    //
    require_once(__DIR__ . '/../../bd/bd_usuario.php');
    //
    // Inicalizamos Respuesta.
    $oRespuesta = new stdClass();
    //
    // Obtenemos los datos del JSON.
    $oDatosJson = json_decode(file_get_contents("php://input"), true);
    //
    // Obtenemos los datos del JSON.
    $IdUsuario = $_SESSION['idUsuario'];
    $oDbUsuario = new Usuario();
    $aDbUsuario = $oDbUsuario->getById($IdUsuario);
    $sPasswordAnteriro = md5($oDatosJson['passwordanterior']);
    $sPasswordNueva = md5($oDatosJson['passwordnueva']);
    //
    if($aDbUsuario[0]->Password != $sPasswordAnteriro )
    {
        $oRespuesta->Estado = "KO";
        $oRespuesta->Mensaje = "La contraseña actual no es esa";
        echo json_encode( $oRespuesta );
        return;
    }
    else
    {
      $lResult = $oDbUsuario->updatePass( $IdUsuario , $sPasswordNueva );
      //
      if(!$lResult)
      {
          $oRespuesta->Estado = "KO";
          $oRespuesta->Mensaje = "La contraseña actual no es esa";
          echo json_encode( $oRespuesta );
          return;
      }
      else
      {
          $oRespuesta->Estado = "OK";
          $oRespuesta->Mensaje = "CAMBIADA";
           json_encode( $oRespuesta );
      }
    }
    echo json_encode( $oRespuesta );

