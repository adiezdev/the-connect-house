<?php
    //error_reporting( E_ALL );
    //ini_set( 'display_errors' , true );
    //ini_set( 'display_startup_errors' , true );
    /*
        -------------------------------------
        Archivo de: Alejandro Díez
        GitHub: @adilosa95
        Proyecto: the-connect-house
        Nombre del archivo: a_editarUsuario.php
        -------------------------------------
    */
    session_start();
    //
    require_once(__DIR__ . '/../../bd/bd_usuario.php');
    require_once(__DIR__ . '/../../bd/bd_telefonos.php');
    //
    // Inicalizamos Respuesta.
    $oRespuesta = new stdClass();
    //
    // Obtenemos los datos del JSON.
    $oDatosJson = json_decode(file_get_contents("php://input"), true);
    //
    //Sacamos los datos
    $sCorreo = $oDatosJson['Correo'];
    $sNombre = $oDatosJson['Nombre'];
    $sApellidos = $oDatosJson['Apellidos'];
    $sCiudad = $oDatosJson['Ciudad'];
    $sDescripcion = $oDatosJson['Descripcion'];
    $sImagen = '';
    //
    $oDbUsuarios = new Usuario();
    $aUsuarios = $oDbUsuarios->getById( $_SESSION['idUsuario'] );
    //
    //Si es diferente a la inicializada
    if(isset($oDatosJson['Imagen']) && $oDatosJson['Imagen'] != '/img/isset/isset-user.png')
    {
            $sImagen =  $oDatosJson['Imagen'];
            //
            //Sacamos la imagen y la decodificamos
            $datos = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $sImagen));
            //generamos un nombre para la imagen
            $nom = md5(rand());
            //Marco la ruta
            $filepathsql = "/uploads/".$aUsuarios[0]->Carpeta."/".$nom.".jpg";
            $archivoRuta = $_SERVER['DOCUMENT_ROOT'].'/'.$filepathsql;
            //Paso la imagen a la ruta
            file_put_contents( $archivoRuta , $datos);
            //Permisos al archivo
            chmod($archivoRuta, 0777);
            //
            $lResult = $oDbUsuarios->updateUsuario( $_SESSION['idUsuario'] , $sCorreo , $sNombre , $sApellidos , $sCiudad , $sDescripcion , $filepathsql);
    }
    //Si es la inicializada
    if( isset($oDatosJson['Imagen']) && $oDatosJson['Imagen'] == '/img/isset/isset-user.png' )
    {
        $sImagen =  $oDatosJson['Imagen'];
        //
        $lResult = $oDbUsuarios->updateUsuario( $_SESSION['idUsuario'] , $sCorreo , $sNombre , $sApellidos , $sCiudad , $sDescripcion , $sImagen);
    }
    else //Sino hay
    {
        $lResult = $oDbUsuarios->updateUsuarioSinImg( $_SESSION['idUsuario'] , $sCorreo , $sNombre , $sApellidos , $sCiudad , $sDescripcion );
    }
    //
    //
    $aTelefonos = $oDatosJson['Telf'];
    $oDbTelefonos = new Telefonos();
    $oDbTelefonos->deleteTelfs(  $_SESSION['idUsuario'] );
    //
    //Guardamos los telefonos
    foreach ( $aTelefonos as $aTelefono)
    {
        if(strlen($aTelefono) == 10 )
        {
            $oRespuesta->Estado = "KO";
            $oRespuesta->Mensaje = "Introduce un número correcto";
            echo json_encode( $oRespuesta );
            return;
        }
        else
        {

            //
            $lResultt = $oDbTelefonos->addTelf( $aTelefono , $_SESSION['idUsuario']  );
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
    if(!$lResult)
    {
        $oRespuesta->Estado = "KO";
        $oRespuesta->Mensaje = "Por favor vuelve a intentarlo";
        echo json_encode( $oRespuesta );
        return;
    }
    else
    {
        $oRespuesta->Estado = "OK";
        $oRespuesta->Mensaje = "Editado";
        json_encode( $oRespuesta );
    }
    echo json_encode( $oRespuesta);