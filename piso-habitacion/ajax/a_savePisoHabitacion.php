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
	require_once(__DIR__ . '/../../bd/bd_ocupado.php');
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
    $nToilet = $oDatosJson["Toilet"];
    $nHabitaciones = $oDatosJson["Habitaciones"];
    //
    //
    $fLatitud = $oDatosJson["Latitud"];
    $fLongitud = $oDatosJson["Longitud"];
    //
    //Creamos la carpeta
    $carpeta = md5(rand( ));
    //Añadimos la carpeta
    mkdir( $_SERVER['DOCUMENT_ROOT'].'/the-connect-house/uploads/'.$_SESSION['Carpeta'].'/'.$carpeta.'/' , 0755 , true);
    //
    //El método mkdir da errores con los permisos, pasamos la carpeta por chmod asi damos todos los permisos para porder guardar ahí
    chmod(  $_SERVER['DOCUMENT_ROOT'].'/the-connect-house/uploads/'.$_SESSION['Carpeta'].'/'.$carpeta.'/' , 0777);
    //
    //Llamamos a la clase Pisos/Habitacionex
    $oDbPisosHabitaciones = new Pisos();
    //
    //Guardamos el Piso
    $lResult = $oDbPisosHabitaciones->addPisoHabitacion( $nHabitaciones , $nToilet , $fMetros , $sCalle, $nNumero , $nCp , $sCiudad , $sDescripcion,
        $fLatitud, $fLongitud, $fPrecio, $nTipo, $carpeta, $_SESSION['idUsuario']);
    //
	//Cogemos la ultima id registrada
	$ultimaId = $oDbPisosHabitaciones->getLastID();
    //
	//Si es tipo habitacion
	if( $nTipo == 2 )
	{
		//
		//Accedemos a la tabla Ocupado
		$oDbOcupado = new Ocupado();
		echo $aOcupados;
		//
		//Recorremos los chicos y las chicas que hay en el piso
		foreach($aOcupados as $aOcupado )
		{
			//Las guardamos
			$lResult = $oDbOcupado->addOcupado( $aOcupado["Num"] ,  $aOcupado["Sexo"] , $ultimaId[0]->idPiso  );
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
            //
            foreach($oDatosJson["Comodidades"] as $comodidad)
            {
                //Guardamos las comodidades asignadas
                $oDbComodidades->addSeccion( $ultimaId[0]->idPiso , $comodidad );
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
                $oDbNormas->addSeccion( $ultimaId[0]->idPiso , $norma );
            }
        }
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
            $filesave = 'uploads/'.$_SESSION['Carpeta'].'/'.$carpeta.'/'.$nom.'.jpg';
            //
	        //URL completa
            $root = $_SERVER['DOCUMENT_ROOT'].'/the-connect-house/'.$filesave;
            //
            //Llamamos a las imagenes
            $oDdImagenes = new Imagenes();
            //
	        //Añadimos las imagenes a la Base de Datos
            $lResult = $oDdImagenes->addImg( $filesave ,  $ultimaId[0]->idPiso );
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
        $oRespuesta->Mensaje = "Guardado";
        json_encode($oRespuesta);
    }
    //
    //Enviamos la respuesta
    echo json_encode($oRespuesta);
?>