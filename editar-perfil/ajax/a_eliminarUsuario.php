<?php
    //error_reporting( E_ALL );
    //ini_set( 'display_errors' , true );
    //ini_set( 'display_startup_errors' , true );
    /*
        -------------------------------------
        Archivo de: Alejandro Díez
        GitHub: @adilosa95
        Proyecto: the-connect-house
        Nombre del archivo: a_eliminarUsuario.php
        -------------------------------------
    */
    session_start();
    require_once(__DIR__ . '/../../bd/bd_imagenespiso.php');
    require_once(__DIR__ . '/../../bd/bd_pisos.php');
    require_once(__DIR__ . '/../../bd/bd_secciones.php');
    require_once(__DIR__ . '/../../bd/bd_ocupado.php');
    require_once(__DIR__ . '/../../bd/bd_usuario.php');
    require_once(__DIR__ . '/../../bd/bd_telefonos.php');
    require_once(__DIR__ . '/../../bd/bd_favoritos.php');
    //
    // Inicalizamos Respuesta.
    $oRespuesta = new stdClass();
    //
    // Obtenemos los datos del JSON.
    $IdUsuario = $_SESSION['idUsuario'];
    $oDbUsuario = new Usuario();
    $aDbUsuario = $oDbUsuario->getById($IdUsuario);
    //
    $oDPisos= new Pisos();
    $aDPisos = $oDPisos->getByUsuario($IdUsuario);
    //
    if(isset($aDPisos))
    {
        foreach($aDPisos as $aDPiso)
        {
            //Si es una habitación
            if( $aDPiso->Tipo == 2)
            {
                $oDbOcupad = new Ocupado();
                $lResut = $oDbOcupad->deleteOcupadoPiso($aDPiso->idPiso);

            }
            //Llamamos a las comodidades
            $oDbComodidades = new Secciones(1);
            $oDbComodidades->deleteSeccion( $aDPiso->idPiso  );
            //Llamamos a las normas
            $oDbNormas = new Secciones(2);
            $oDbNormas->deleteSeccion( $aDPiso->idPiso  );
            //
            //
            $oDbImagenes = new Imagenes();
            $oDbImagenes->deleteImagePiso( $aDPiso->idPiso  );
            //
            //
            $lResut = $oDPisos->deletePisoHabitacion( $aDPiso->idPiso );
            if(!$lResut)
            {
                $oRespuesta->Estado = "KO";
                $oRespuesta->Mensaje = "Por favor vuelve a intentarlo";
                echo json_encode( $oRespuesta );
                return;
            }
        }
    }
    //Eliminamos los favoritos
    $oDbFavoritos = new Favoritos();
    $lResut = $oDbFavoritos->deleteFavUsuer( $IdUsuario );
    //Eliminamos los telefonos
    $oDbTelefonoes = new Telefonos();
    $lResut = $oDbTelefonoes->deleteTelfs( $IdUsuario );
    //
    //Eliminan Imagen de perfil
    $eliminar = $_SERVER['DOCUMENT_ROOT'].'/the-connect-house/uploads/'.$aDbUsuario[0]->Carpeta;
    deleteDirectory($eliminar);
    //
    $lResut = $oDbUsuario->deleteUsuario( $IdUsuario );
    if(!$lResut)
    {
        $oRespuesta->Estado = "KO";
        $oRespuesta->Mensaje = "Por favor vuelve a intentarlo";
        echo json_encode( $oRespuesta );
        return;
    }
    else
    {
        $oRespuesta->Estado = "OK";
        $oRespuesta->Mensaje = "ELIMINAOD";
        json_encode( $oRespuesta );
    }
    echo json_encode( $oRespuesta );
    //
    //Elimina todos los directorios y archivos que haya
    function deleteDirectory($dir) {
        if(!$dh = @opendir($dir)) return;
        while (false !== ($current = readdir($dh))) {
            if($current != '.' && $current != '..')
            {
                if (!@unlink($dir.'/'.$current))
                    deleteDirectory($dir.'/'.$current);
            }
        }
        closedir($dh);
        @rmdir($dir);
    }