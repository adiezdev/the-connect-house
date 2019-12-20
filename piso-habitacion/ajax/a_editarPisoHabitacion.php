<?php
    //error_reporting( E_ALL );
    //ini_set( 'display_errors' , true );
    //ini_set( 'display_startup_errors' , true );
    /*
        -------------------------------------
        Archivo de: Alejandro Díez
        GitHub: @adilosa95
        Proyecto: the-connect-house
        Nombre del archivo: a_editarPisoHabitacion.php
        -------------------------------------
    */
    session_start();
    //
    require_once(__DIR__ . '/../../bd/bd_pisos.php');
    require_once(__DIR__ . '/../../bd/bd_secciones.php');
    require_once(__DIR__ . '/../../bd/bd_imagenespiso.php');
    require_once(__DIR__ . '/../../bd/bd_ocupado.php');
    require_once(__DIR__ . '/../../bd/bd_usuario.php');
    //
    // Inicalizamos Respuesta.
    $oRespuesta = new stdClass();
    //
    // Obtenemos los datos del JSON.
    $oDatosJson = json_decode(file_get_contents("php://input"), true);
    //
    $nidPiso = $oDatosJson["IdPipo"];
    $nTipo = $oDatosJson["Tipo"];
    $sDescripcion = $oDatosJson["Descripcion"];
    $fPrecio = $oDatosJson["Precio"];
    //
    //Array ocupados
    $aOcupados = array();
    //
    $nChicos = '';
    $sChicos = 'M';
    //
    //Si la varaible está inicializada
    if(isset($oDatosJson["Chicos"]))
    {
        //Añadimos al array los chicos si hay
        $nChicos = $oDatosJson["Chicos"];
        $aOcupados[] = array( 'Num' => $nChicos  , 'Sexo' => $sChicos );
    }
    //
    $nChicas = '';
    $sChicas = 'S';
    //
    //Si la varaible está inicializada
    if(isset($oDatosJson["Chicas"]) )
    {
        //Añadimos al array las chicas si hay
        $nChicas = $oDatosJson["Chicas"];
        $aOcupados[] = array( 'Num' => $nChicas  , 'Sexo' => $sChicas );
    }
    //
    //Llamamos a la clase Pisos/Habitacion
    $oDbPisosHabitaciones = new Pisos();
    $aDbPisoHabitacion =$oDbPisosHabitaciones->getById( $nidPiso );
    //Guardamos el Piso
    $lResult = $oDbPisosHabitaciones->updatePisoHabitacion( $sDescripcion , $fPrecio , $nidPiso);
    //
    //Si es tipo habitacion
    if( $nTipo == 2 )
    {
        //
        //Accedemos a la tabla Ocupado
        $oDbOcupado = new Ocupado();
        //
        //Recorremos los chicos y las chicas que hay en el piso
        foreach($aOcupados as $aOcupado )
        {
            //Las guardamos
            $lResult = $oDbOcupado->updateOcupados( $aOcupado["Num"] ,  $aOcupado["Sexo"] , $nidPiso  );
            //Si da error
            if(!$lResult)
            {
                $oRespuesta->Estado = "KO";
                $oRespuesta->Mensaje = "Por favor vuelve a intentarlo";
                echo json_encode( $oRespuesta );
                return;
            }
        }
    }
    //
    //Si da error al guardarlo
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
        //Comprobamos si ha metido comodidades
        if(isset($oDatosJson["Comodidades"]))
        {
            //Llamamos a las comodidades
            $oDbComodidades = new Secciones(1);
            $oDbComodidades->deleteSeccion( $nidPiso  );
            //
            foreach($oDatosJson["Comodidades"] as $comodidad)
            {
                //Guardamos las comodidades asignadas
                $oDbComodidades->addSeccion( $nidPiso , $comodidad );
            }
        }
        //Comprobamos si ha metido normas
        if(isset($oDatosJson["Normas"]))
        {
            //Llamamos a las normas
            $oDbNormas = new Secciones(2);
            $oDbNormas->deleteSeccion( $nidPiso  );
            //
            foreach($oDatosJson["Normas"] as $norma)
            {
                //Guardamos las normas asignadas
                $oDbNormas->addSeccion( $nidPiso , $norma );
            }
        }
        $oDbUsuario = new Usuario();
        $aUsuarios = $oDbUsuario->getById( $_SESSION['idUsuario'] );
        //
        //Recorremos las imagenes
        foreach($oDatosJson["Imagenes"] as $imagen=>$value)
        {
            //Decodificamos la imagen
            $datos = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $value));
            //
            //Generamso un nombre
            $nom = md5(rand());
            //
            //URL que se guarda en la bbd
            $filesave = 'uploads/'.$aUsuarios[0]->Carpeta.'/'.$aDbPisoHabitacion[0]->Carpeta.'/'.$nom.'.jpg';
            //
            //URL completa
            $root = $_SERVER['DOCUMENT_ROOT'].'/'.$filesave;
            //
            //Llamamos a las imagenes
            $oDdImagenes = new Imagenes();
            //
            //Añadimos las imagenes a la Base de Datos
            $lResult = $oDdImagenes->addImg( $filesave ,  $nidPiso );
            //
            //Si es correcto
            if($lResult)
            {
                //Guardamos la imagen en la ruta
                file_put_contents($root , $datos);
            }
        }
        //
        $oRespuesta->Estado = "OK";
        $oRespuesta->Mensaje = "Editado";
        json_encode($oRespuesta);
    }
    echo  json_encode($oRespuesta);