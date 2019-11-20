<?php
//error_reporting( E_ALL );
//ini_set( 'display_errors' , true );
//ini_set( 'display_startup_errors' , true );
/*
    -------------------------------------
    Archivo de: Alejandro Díez
    GitHub: @adilosa95
    Proyecto: the-connect-house
    Nombre del archivo: bd_secciones.php
    -------------------------------------
*/
require_once( __DIR__.'/bd_conexion.php' );
//
//
class Secciones extends Conexion
{
    private $sTabla;
    private $sTablaIntermedia;
    private $idSeccion;
    /**
     * Dependiendo del tipo que llegue será la tabla comodida o norma
     *
     * ComodidadesNormas constructor.
     * @param $nTipo
     */
    public function __construct( $nTipo )
    {
        if( $nTipo == 1)
        {
            $this->sTabla = 'comodidades';
            $this->sTablaIntermedia = '`comodidades-piso`';
            $this->idSeccion = 'idComodidad';
        }
        else
        {
            $this->sTabla = 'normas';
            $this->sTablaIntermedia = '`normas-piso`';
            $this->idSeccion = 'idNorma';
        }
    }
    /**
     * Devuelve toda la seccion
     *
     * @return array
     */
    public function getAll()
    {
        $aSeccion = array();
        $cSql = 'SELECT * FROM '.$this->sTabla;
        $stmt = $this->prepare($cSql);
        $stmt->execute();
        $oResultado = $stmt->get_result();
        while ($oRecord = $oResultado->fetch_object())
        {
            $aSeccion[] = $oRecord;
        }
        return $aSeccion;
    }

    /**
     * Devuelde los datos por su ID
     *
     * @return array
     */
    public function getById()
    {
        $aPisosId = array();
        $cSql = 'SELECT * FROM '.$this->sTabla.' WHERE '.$this->idSeccion.' = ?';
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
     * Añade uno seccion al piso o habitacion
     *
     * @param $nIdPiso
     * @param $nIdSeccion
     * @return bool
     */
    public function addSeccion( $nIdPiso , $nIdSeccion )
    {
        $cSql = 'INSERT INTO '.$this->sTablaIntermedia.' ( idPiso , '.$this->idSeccion.')
                VALUES (? , ? )';
        $stmt = $this->prepare( $cSql );
        $stmt->bind_param( 'ii', $nIdPiso , $nIdSeccion);
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
     * Elimina una seccion al piso o habitacion
     *
     * @param $nIdPiso
     * @return bool
     */
    public function deleteSeccion( $nIdPiso )
    {
        $cSql = 'DELETE FROM '.$this->sTablaIntermedia.' WHERE idPiso = ?';
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