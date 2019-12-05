<?php
    //error_reporting( E_ALL );
    //ini_set( 'display_errors' , true );
    //ini_set( 'display_startup_errors' , true );
    /*
    -------------------------------------
    Archivo de: Alejandro Díez
    GitHub: @adilosa95
    Proyecto: the-connect-house
    Nombre del archivo: a_savePisoHabitacion.php
    -------------------------------------
    */
    session_start();
    //
    require_once(__DIR__ . '/../../bd/bd_pisos.php');
    require_once(__DIR__ . '/../../bd/bd_secciones.php');
    require_once(__DIR__ . '/../../bd/bd_imagenespiso.php');
    //
    // Inicalizamos variables.
    $oRespuesta = new stdClass();
    //
    // Obtenemos los datos del JSON.
    $oDatosJson = json_decode(file_get_contents("php://input"), true);
    //
    $nTipo = $oDatosJson["Tipo"];
    $sCalle = $oDatosJson["Calle"];
    $nNumero = $oDatosJson["Numero"];
    $nCp = $oDatosJson["Cp"];
    $sCiudad = $oDatosJson["Ciudad"];
    $sDescripcion = $oDatosJson["Descripcion"];
    $fMetros = $oDatosJson["Metros"];
    $fPrecio = $oDatosJson["Precio"];
    $nChicos = '';
    //
    if(isset($oDatosJson["Chicos"]))
    {
        $nChicos = $oDatosJson["Chicos"];
    }
    //
    $nChicas = '';
    if(isset($oDatosJson["Chicas"]))
    {
        $nChicos = $oDatosJson["Chicas"];
    }
    //
    $nToilet = $oDatosJson["Toilet"];
    $nHabitaciones = $oDatosJson["Habitaciones"];
    //
    //
    $fLatitud = $oDatosJson["Latitud"];
    $fLongitud = $oDatosJson["Longitud"];
    //
    //
    $carpeta = md5(rand( ));
    mkdir( $_SERVER['DOCUMENT_ROOT'].'/the-connect-house/uploads/'.$_SESSION['Carpeta'].'/'.$carpeta.'/' , 0755 , true);
    //
    //El método mkdir da errores con los permisos, pasamos la carpeta por chmod asi damos todos los permisos para porder guardar ahí
    chmod(  $_SERVER['DOCUMENT_ROOT'].'/the-connect-house/uploads/'.$_SESSION['Carpeta'].'/'.$carpeta.'/' , 0777);
    //
    //Llamamos a la clase Pisos/Habitacionex
    $oDbPisosHabitaciones = new Pisos();
    //
    //Guardamos el Piso
    $sFecha =  date( "Y-m-d" );
    $lResult = $oDbPisosHabitaciones->addPisoHabitacion( $nHabitaciones , $nToilet , $fMetros , $sCalle, $nNumero , $nCp , $sCiudad , $sDescripcion,
        $fLatitud, $fLongitud, $fPrecio, $nTipo, $carpeta, $_SESSION['idUsuario']);
    //
    if(!$lResult)
    {
        $oRespuesta->Estado = "KO";
        $oRespuesta->Mensaje = "Por favor vuelve a intentarlo";
        json_encode( $oRespuesta );
    }
    else
    {
        //Cogemos la ultima id registrada
        $ultimaId = $oDbPisosHabitaciones->getLastID();
        //
        //Comprobamos si ha metido comodidades
        if(isset($oDatosJson["Comodidades"]))
        {
            //Llamamos a las comodidades
            $oDbComodidades = new Secciones(1);
            //
            foreach($oDatosJson["Comodidades"] as $comodidad)
            {
                //Guardamos las comodidades asignadas
                $oDbComodidades->addSeccion( $ultimaId , $comodidad );
            }
        }
        //Comprobamos si ha metido normas
        if(isset($oDatosJson["Normas"]))
        {
            //Llamamos a las normas
            $oDbNormas = new Secciones(2);
            //
            foreach($oDatosJson["Normas"] as $norma)
            {
                //Guardamos las normas asignadas
                $oDbNormas->addSeccion( $ultimaId , $norma );
            }
        }
        foreach($oDatosJson["Imagenes"] as $imagen=>$value)
        {
            //Guardamos las normas del piso
            //
            $datos = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $value));
            //
            $nom = md5(rand());
            $filesave = 'uploads/'.$_SESSION['Carpeta'].'/'.$carpeta.'/'.$nom.'.jpg';
            //
            $root = $_SERVER['DOCUMENT_ROOT'].'/the-connect-house/'.$filesave;
            //
            //Llamamos a las imagenes
            $oDdImagenes = new Imagenes();
            //
            $lResult = $oDdImagenes->addImg( $filesave ,  $ultimaId );
            //
            if($lResult)
            {
                file_put_contents($root , $datos);
            }
        }
        //
        $oRespuesta->Estado = "OK";
        $oRespuesta->Mensaje = "Guardado";
        json_encode($oRespuesta);
    }
    //
    //Enviamos la respuesta
    echo json_encode($oRespuesta);
?>