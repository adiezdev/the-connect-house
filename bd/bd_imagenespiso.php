<?php
//error_reporting( E_ALL );
//ini_set( 'display_errors' , true );
//ini_set( 'display_startup_errors' , true );
/*
    -------------------------------------
    Archivo de: Alejandro Díez
    GitHub: @adilosa95
    Proyecto: the-connect-house
    Nombre del archivo: bd_imagenespiso.php
    -------------------------------------
*/
require_once( __DIR__.'/bd_conexion.php' );
//
//
class Imagenes extends Conexion
{
    //
    //Nombre de la tabla
    private $sTabla = 'imagenes';
    /**
     * Devuelve todas las imagenes
     *
     * @return array
     */
    public function getAll()
    {
        $aImg = array();
        $cSql = 'SELECT * FROM '.$this->sTabla;
        $stmt = $this->prepare($cSql);
        $stmt->execute();
        $oResultado = $stmt->get_result();
        while ($oRecord = $oResultado->fetch_object())
        {
            $aImg[] = $oRecord;
        }
        return $aImg;
    }
    /**
     * Devuelve una imagen por su ID
     *
     * @param $nIdImg
     * @return array
     */
    public function getById( $nIdImg )
    {
        $aImgId = array();
        $cSql = 'SELECT * FROM '.$this->sTabla.' WHERE idImagen = ?';
        $stmt = $this->prepare($cSql);
        $stmt->bind_param('i', $nIdImg );
        $stmt->execute();
        $oResultado = $stmt->get_result();
        while( $oRecord = $oResultado->fetch_object())
        {
            $aImgId[] =  $oRecord;
        }
        return $aImgId;
    }
    /**
     * @param $idPiso
     * @return array
     */
    public function getByIdPiso( $idPiso )
    {
        $aImgId = array();
        $cSql = 'SELECT Url FROM '.$this->sTabla.' WHERE idPiso = ? LIMIT 1';
        $stmt = $this->prepare($cSql);
        $stmt->bind_param('i', $idPiso );
        $stmt->execute();
        $oResultado = $stmt->get_result();
        while( $oRecord = $oResultado->fetch_object())
        {
            $aImgId[] =  $oRecord;
        }
        return $aImgId;
    }
    /**
     * Añade una nueva imagen
     *
     * @param $sURL
     * @param $idPiso
     * @return bool
     */
    public function addImg( $sURL , $idPiso )
    {
        $cSql = 'INSERT INTO '.$this->sTabla.' ( Url , idPiso) VALUES ( ?, ? )';
        $stmt = $this->prepare( $cSql );
        $stmt->bind_param('si', $sURL , $idPiso );
        $bResultado = $stmt->execute();
       //return $stmt->error;
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
     * Elimina una imagen
     *
     * @param $nIdImg
     * @return bool
     */
    public function deleteImage( $nIdImg )
    {
        $cSql = 'DELETE FROM '.$this->sTabla.' WHERE idImagen = ?';
        $stmt = $this->prepare($cSql);
        $stmt->bind_param('i' , $nIdImg);
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