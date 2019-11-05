<?php
    //
    // Inicalizamos variables.
    $oRespuesta = new stdClass();
    //
    // Obtenemos los datos del JSON.
    $oDatosJson = json_decode( file_get_contents( "php://input" ), true );
    //
   $sCorreo = $oDatosJson["Correo"];
   print_r( $sCorreo );
?>