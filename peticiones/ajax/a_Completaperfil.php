<?php
//error_reporting( E_ALL );
//ini_set( 'display_errors' , true );
//ini_set( 'display_startup_errors' , true );
    /*
        -------------------------------------
        Archivo de: Alejandro Díez
        GitHub: @adilosa95
        Proyecto: the-connect-house
        Nombre del archivo: a_Completaperfil.php
        -------------------------------------
    */
    session_start();
    //
    require_once(__DIR__ . '/../../bd/bd_usuario.php');
    require_once(__DIR__ . '/../../bd/bd_telefonos.php');
    require_once(__DIR__ . '/../../includes/sesion.php');
    //
    // Inicalizamos Respuesta.
    $oRespuesta = new stdClass();
    //
    $nId = $_SESSION['idUsuario'];
    //
    $oDatosJson = json_decode( file_get_contents( "php://input" ), true );
    //
    $aTelefonos = $oDatosJson["telefono"];
    $sDescripcion = $oDatosJson["descripcion"];
    //
    $oDbUsuario = new Usuario();
    $aUsuarios = $oDbUsuario->getById( $nId );
    //

    //Comprobamos si está inicializado la variable
    if(isset( $oDatosJson["imagenper"] ))
    {
        $sImagenes = $oDatosJson["imagenper"];
        //Sacamos la imagen y la decodificamos
        $datos = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $sImagenes));
        //generamos un nombre para la imagen
        $nom = md5(rand());
        //Marco la ruta
        $filepathsql = "uploads/".$aUsuarios[0]->Carpeta."/".$nom.".jpg";
        $archivoRuta = $_SERVER['DOCUMENT_ROOT'].'/the-connect-house/'.$filepathsql;
        //Paso la imagen a la ruta
        file_put_contents( $archivoRuta , $datos);
        //Permisos al archivo
        chmod($archivoRuta, 0777);
        //
        $lResult = $oDbUsuario->updateCampos( $nId , $sDescripcion , $filepathsql); //Actualizamos los campos
    }
    else
    {
        //
        $lResult = $oDbUsuario->updateCampos( $nId , $sDescripcion); //Actualizamos los campos
    }
    //
    if(!$lResult)
    {
        $oRespuesta->Estado = "KO";
        $oRespuesta->Mensaje = "Por favor vuelve a intentarlo";
        echo json_encode( $oRespuesta );
        return;
    }
    else
    {
        //
        if(isset($aTelefonos))
        {
            foreach ( $aTelefonos as $aTelefono)
            {
                $oDbTelefonos = new Telefonos();
                if(strlen($aTelefono) == 10 )
                {
                    $oRespuesta->Estado = "KO";
                    $oRespuesta->Mensaje = "Introduce un número correcto";
                    echo json_encode( $oRespuesta );
                    return;
                }
                else
                {
                    $lResultt = $oDbTelefonos->addTelf( $aTelefono , $nId );
                    //
                    if(!$lResultt)
                    {
                        $oRespuesta->Estado = "KO";
                        $oRespuesta->Mensaje = "Por favor vuelve a intentarlo";
                        echo json_encode( $oRespuesta );
                        return;
                    }
                }
            }
        }
        $oRespuesta->Estado = "OK";
        $oRespuesta->Mensaje = "Guardado";
        $oRespuesta->Correo = $aUsuarios[0]->Correo;
        json_encode($oRespuesta);
    }
    //
    //Enviamos la respuesta
    echo json_encode($oRespuesta);