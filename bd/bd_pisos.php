<?php
//error_reporting( E_ALL );
//ini_set( 'display_errors' , true );
//ini_set( 'display_startup_errors' , true );
/*
    -------------------------------------
    Archivo de: Alejandro Díez
    GitHub: @adilosa95
    Proyecto: the-connect-house
    Nombre del archivo: bd_pisos.php
    -------------------------------------
*/
require_once( __DIR__.'/bd_conexion.php' );
//
//
class Pisos extends Conexion
{
    //
    //Nombre de la tabla
    private $sTabla = '`pisos-habitaciones`';
    /**
     * Devuelve todos los pisos con sus campos
     *
     * @return array
     */
    public function getAll()
    {
        $aPisos = array();
        $cSql = 'SELECT * FROM '.$this->sTabla;
        $stmt = $this->prepare($cSql);
        $stmt->execute();
        $oResultado = $stmt->get_result();
        while ($oRecord = $oResultado->fetch_object()) {
            $aPisos[] = $oRecord;
        }
        return $aPisos;
    }
    /**
     * Devuelve los datos de un piso por su ID
     *
     * @param $nIdPiso
     *
     * @return array
     */
    public function getById( $nIdPiso )
    {
        $aPisosId = array();
        $cSql = 'SELECT * FROM '.$this->sTabla.' WHERE idPiso = ?';
        $stmt = $this->prepare($cSql);
        $stmt->bind_param('i', $nIdPiso );
        $stmt->execute();
        $oResultado = $stmt->get_result();
        while( $oRecord = $oResultado->fetch_object())
        {
            $aPisosId[] =  $oRecord;
        }
        return $aPisosId;
    }
    /**
     * Devuelve la ultima ID de ultimo piso/habtiacion
     *
     * @return array
     */
    public function getLastID()
    {
        $aUltimaID = array();
        $cSql = 'SELECT * FROM '.$this->sTabla.' ORDER BY idPiso DESC LIMIT 1';
        $stmt = $this->prepare( $cSql );
        $stmt->execute();
        $oResultado = $stmt->get_result();
        while( $oRecord = $oResultado->fetch_object())
        {
            $aUltimaID[] = $oRecord;
        }
        return $aUltimaID;
    }
    /**
     * Devuelve todos los pisos por el ID del Usuario
     *
     * @param $nIdUsuario
     * @return array
     */
    public function getByUsuario( $nIdUsuario )
    {
        $aPisoHabitacion = array();
        $cSql = 'SELECT * FROM '.$this->sTabla.' WHERE idUsuario = ? ';
        $stmt = $this->prepare($cSql);
        $stmt->bind_param('i', $nIdUsuario );
        $stmt->execute();
        $oResultado = $stmt->get_result();
        while( $oRecord = $oResultado->fetch_object())
        {
            $aPisoHabitacion[] =  $oRecord;
        }
        return $aPisoHabitacion;
    }
    /**
     * Añade un nuevo piso o habitacion
     *
     * @param $nHabitaciones
     * @param $nToiles
     * @param $fMetros
     * @param $sCalle
     * @param $nNumero
     * @param $nCp
     * @param $sCiudad
     * @param $sDescripcion
     * @param $fLatitud
     * @param $fLogintud
     * @param $fPrecio
     * @param $nVisitas
     * @param $nTipo
     * @param $idUsuario
     * @return bool
     */
    public function addPisoHabitacion( $nHabitaciones , $nToiles , $fMetros , $sCalle , $nNumero , $nCp , $sCiudad , $sDescripcion
        , $fLatitud , $fLogintud , $fPrecio  , $nTipo  , $sCarpeta, $nIdUsuario )
    {
    	$sFecha =  date( "Y-m-d" );
    	//
         $cSql = 'INSERT INTO '.$this->sTabla.' ( NHabitaciones, NBanos, Metros, Calle, Numero, CP, Ciudad, Descripcion, Latitud, Longitud, Precio, Tipo, Fecha, Carpeta, idUsuario)
                VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $stmt = $this->prepare( $cSql );
         $stmt->bind_param('iidssissdddissi' ,  $nHabitaciones , $nToiles , $fMetros , $sCalle , $nNumero , $nCp , $sCiudad , $sDescripcion
            , $fLatitud , $fLogintud , $fPrecio  , $nTipo, $sFecha , $sCarpeta , $nIdUsuario );
	        $bResultado = $stmt->execute();
        //$stmt->error;
              if(!$bResultado)
                {
                    return false;
                }
                else
                {
                    return true;
                }
    }
	/**
	 * Funcion por filtros
	 *
	 * @param int $fPrecio
	 * @param int $nPisos
	 * @param int $nHabitaciones
	 * @param string $sCiudad
	 * @param string $sCalle
	 *
	 * @return array
	 * @throws ReflectionException
	 */
    public function buscarPiso( $fPrecio = 0, $sCalle = '', $nPisos = 0 , $nHabitaciones = 0 , $sCiudad = '' )
    {
    	$aPisoHabitacion = array();
    	//
	    $sFiltro = '';
    	$sParametros = 'd';
	    $valores = array($fPrecio);
		//
        //
        if( $sCalle  != '' )
        {
            $sParametros .= 's';
            $sCalle = '%'.$sCalle.'%';
            $sFiltro .= ' AND Calle LIKE ? ';
            $valores[] = $sCalle;
        }
        //
	    if( $nPisos != 0 )
	    {
		    $sParametros .= 'i';
		    $sFiltro .= ' AND Tipo = ? ';
	    	$valores[] = $nPisos;
	    }
	    //
	    if( $nHabitaciones != 0 )
	    {
		    $sParametros .= 'i';
		    $sFiltro .= ' AND Tipo = ? ';
		    $valores[] = $nHabitaciones;
	    }
	    //
	    if( $sCiudad  != '' )
	    {
		    $sParametros .= 's';
		    $sFiltro .= ' AND Ciudad = ? ';
		    $valores[] = $sCiudad;
	    }
	    //
	    $bindArray = array($sParametros);
	    foreach( $valores as $key => $valor)
	    {
	    	$bindArray[] = &$valores[$key];
	    }
	    $cSql = 'SELECT * FROM '.$this->sTabla.' WHERE Precio >= ? '.$sFiltro;
	    //
	    $stmt = $this->prepare( $cSql );
        //
        $ref = new \ReflectionClass('mysqli_stmt');
        $ref->getMethod("bind_param")->invokeArgs($stmt , $bindArray);
	    //
	    $stmt->execute();
	    $oResultado = $stmt->get_result();
	    while( $oRecord = $oResultado->fetch_object())
	    {
		    $aPisoHabitacion[] =  $oRecord;
	    }
	    return $aPisoHabitacion;
    }
    /**
     * Actualiza un nuevo piso o habitacion
     *
     * @param $nHabitaciones
     * @param $nToiles
     * @param $fMetros
     * @param $sCalle
     * @param $nNumero
     * @param $nCp
     * @param $sCiudad
     * @param $sDescripcion
     * @param $fLatitud
     * @param $fLogintud
     * @param $fPrecio
     * @param $nVisitas
     * @param $nTipo
     * @param $idPiso
     * @return bool
     */
    public function updatePisoHabitacion( $nHabitaciones , $nToiles , $fMetros , $sCalle , $nNumero , $nCp , $sCiudad , $sDescripcion
        , $fLatitud , $fLogintud , $fPrecio , $nVisitas , $nTipo , $nIdPiso )
    {
        $cSql = 'UPDATE '.$this->sTabla.' SET
                 NHabitaciones = ? , NBanos = ? ,
                 Metros = ? , Calle = ? ,
                 Numero = ? , CP = ? ,
                 Ciudad = ? , Descripcion = ? , 
                 Latitud = ? , Longitud = ? , 
                 Preciio = ? , Tipo = ? 
                 WHERE idPiso = ?';
        $stmt = $this->prepare( $cSql );
        $stmt = $this->prepare( $cSql );
        $stmt->bind_param('iidssissdddiii' ,  $nHabitaciones , $nToiles , $fMetros , $sCalle , $nNumero , $nCp , $sCiudad , $sDescripcion
            , $fLatitud , $fLogintud , $fPrecio , $nVisitas , $nTipo , $nIdPiso );
        $bResultado = $stmt->execute();
        if(!$bResultado)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    /**
     * Elimina un piso agregado
     *
     * @param $nIdPiso
     * @return bool
     */
    public function deletePisoHabitacion( $nIdPiso )
    {
        $cSql = 'DELETE FROM '.$this->sTabla.' WHERE idPiso = ?';
        $stmt = $this->prepare($cSql);
        $stmt->bind_param('i' , $nIdPiso);
        $bResultado = $stmt->execute();
        if(!$bResultado)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
}