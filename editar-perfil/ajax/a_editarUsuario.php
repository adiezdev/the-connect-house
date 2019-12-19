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
    if(isset($oDatosJson['Imagen']))
    {
        $sImagen = $oDatosJson['Imagen'];
        //
        $lResult = $oDbUsuarios->updateUsuario( $_SESSION['idUsuario'] , $sCorreo , $sNombre , $sApellidos , $sCiudad , $sDescripcion , $sImagen);
    }
    else
    {
        $lResult = $oDbUsuarios->updateUsuarioSinImg( $_SESSION['idUsuario'] , $sCorreo , $sNombre , $sApellidos , $sCiudad , $sDescripcion );
    }
    //
    //
    $aTelefonos = $oDatosJson['Telf'];
    //
    //Guardamos los telefonos
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
            $oDbTelefonos->deleteTelfs(  $_SESSION['idUsuario'] );
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