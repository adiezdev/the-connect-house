<?php
//error_reporting( E_ALL );
//ini_set( 'display_errors' , true );
//ini_set( 'display_startup_errors' , true );
/*
    -------------------------------------
    Archivo de: Alejandro Díez
    GitHub: @adilosa95
    Proyecto: the-connect-house
    Nombre del archivo: db_comodidades.php
    -------------------------------------
*/
require_once( __DIR__.'/bd_conexion.php' );
//
//
class ComodidadesNormas extends Conexion
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
            $this->sTablaIntermedia = 'comodidades-piso';
            $this->idSeccion = 'idComodidad';
        }
        else
        {
            $this->sTabla = 'normas';
            $this->sTablaIntermedia = 'normas-piso';
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
}