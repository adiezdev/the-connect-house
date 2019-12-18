<?php
    //error_reporting( E_ALL );
    //ini_set( 'display_errors' , true );
    //ini_set( 'display_startup_errors' , true );
    /*
        -------------------------------------
        Archivo de: Alejandro Díez
        GitHub: @adilosa95
        Proyecto: the-connect-house
        Nombre del archivo: a_deletePisoHabitacion.php
        -------------------------------------
    */
    session_start();
    require_once(__DIR__ . '/../../bd/bd_imagenespiso.php');
    require_once(__DIR__ . '/../../bd/bd_pisos.php');
    require_once(__DIR__ . '/../../bd/bd_secciones.php');
    require_once(__DIR__ . '/../../bd/bd_ocupado.php');
    require_once(__DIR__ . '/../../bd/bd_usuario.php');
    //
    // Inicalizamos Respuesta.
    $oRespuesta = new stdClass();
    //
    // Obtenemos los datos del JSON.
    $oDatosJson = json_decode(file_get_contents("php://input"), true);
    //
    //Sacamos la variable
    $nidPiso = $oDatosJson["IdPipo"];
    $nTipo = $oDatosJson["Tipo"];
    //
    //Si es una habitación
    if( $nTipo = 2)
    {
        $oDbOcupad = new Ocupado();
        $lResut = $oDbOcupad->deleteOcupadoPiso($nidPiso);
    }
    //Llamamos a las comodidades
    $oDbComodidades = new Secciones(1);
    $oDbComodidades->deleteSeccion( $nidPiso  );
    //Llamamos a las normas
    $oDbNormas = new Secciones(2);
    $oDbNormas->deleteSeccion( $nidPiso  );
    //
    //Elinamos piso o habitación
    $oDbPisos = new Pisos();
    $aDbPisos = $oDbPisos->getById( $nidPiso );
    //
    $oDbUsuario = new Usuario();
    $aDbUsuario = $oDbUsuario->getById( $aDbPisos[0]->idUsuario);
    //
    $oDbImagenes = new Imagenes();
    $lResut = $oDbImagenes->deleteImagePiso( $nidPiso );
    //
    //Recorremos las imagenes
    foreach($oDatosJson["Imagenes"] as $imagen=>$value)
    {
        unlink( $_SERVER['DOCUMENT_ROOT'].$value);
    }
    rmdir( $_SERVER['DOCUMENT_ROOT'].'/the-connect-house/uploads/'.$aDbUsuario[0]->Carpeta.'/'.$aDbPisos[0]->Carpeta.'/');
    //
    //Eliminamos el piso o la habitacion
     $lResut = $oDbPisos->deletePisoHabitacion( $nidPiso );
    if(!$lResut)
    {
        $oRespuesta->Estado = "KO";
        $oRespuesta->Mensaje = "Por favor vuelve a intentarlo";
        echo json_encode( $oRespuesta );
        return;
    }
    else
    {
        //
        $oRespuesta->Estado = "OK";
        $oRespuesta->Mensaje = "Eliminado";
        json_encode($oRespuesta);
    }
    echo  json_encode($oRespuesta);