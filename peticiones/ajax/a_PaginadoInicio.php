<?php
    //error_reporting( E_ALL );
    //ini_set( 'display_errors' , true );
    //ini_set( 'display_startup_errors' , true );
    /*
        -------------------------------------
        Archivo de: Alejandro Díez
        GitHub: @adilosa95
        Proyecto: the-connect-house
        Nombre del archivo: a_PaginadoInicio.php
        -------------------------------------
    */
    require_once(__DIR__ . '/../../bd/bd_pisos.php');
    require_once(__DIR__ . '/../../bd/bd_imagenespiso.php');
    //
    // Obtenemos los datos del JSON.
    $oDatosJson = json_decode( file_get_contents( "php://input" ), true );
    //
    $pagina = $oDatosJson['paginado'];
    //
    //Arraydatos
    $datos = array();
    //
    //Accedemos a bbd
    $oDbPisos = new Pisos();
    //
    $aDbPisos = $oDbPisos->getPaginado( $pagina );
    foreach ($aDbPisos as $aDbPiso)
    {
        //
        //Accedemos para que nos de la imagen del piso
        $oDbImagenes = new Imagenes();
        $adbImagenes = $oDbImagenes->getByIdPisoPrimeraFoto($aDbPiso->idPiso);
        foreach ($adbImagenes as $adbImagen)
        {
            //Guardamos los datos
            $datos[] = array( "Imagen" => $adbImagen->Url , "Calle" => $aDbPiso->Calle , "Ciudad"=> $aDbPiso->Ciudad , "Precio"=> $aDbPiso->Precio);
        }
    }
    //
    //Retornamos resultado
    echo json_encode( $datos );