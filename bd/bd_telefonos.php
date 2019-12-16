<?php
/*
    -------------------------------------
    Archivo de: Alejandro Díez
    GitHub: @adilosa95
    Proyecto: the-connect-house
    Nombre del archivo: bd_telefonos.php
    -------------------------------------
*/

class Telefonos extends Conexion
{
    //
    //Nombre de la tabla
    private $sTabla = 'telefonos';
    //
    //
    /**
     * Devuelve todas los numeros de los usuarios
     *
     * @return array
     */
    public function getAll()
    {
        $aTelefonos = array();
        $cSql = 'SELECT * FROM '.$this->sTabla;
        $stmt = $this->prepare($cSql);
        $stmt->execute();
        $oResultado = $stmt->get_result();
        while ($oRecord = $oResultado->fetch_object())
        {
            $aTelefonos[] = $oRecord;
        }
        return $aTelefonos;
    }
    /**
     * Devuelve los telefonos por ID del Usuario
     *
     * @param $nIdImg
     * @return array
     */
    public function getByIdUsuario( $nIdUsuario )
    {
        $aTelfId = array();
        $cSql = 'SELECT * FROM '.$this->sTabla.' WHERE idUsuario = ?';
        $stmt = $this->prepare($cSql);
        $stmt->bind_param('i', $nIdUsuario );
        $stmt->execute();
        $oResultado = $stmt->get_result();
        while( $oRecord = $oResultado->fetch_object())
        {
            $aTelfId[] =  $oRecord;
        }
        return $aTelfId;
    }
    /**
     * Inserta un nuevo numero de telefono
     *
     * @param $sURL
     * @param $idPiso
     * @return bool
     */
    public function addTelf( $nNumero , $idUsario )
    {
        $cSql = 'INSERT INTO '.$this->sTabla.' ( Numero , idUsuario) VALUES ( ? , ? )';
        $stmt = $this->prepare( $cSql );
        $stmt->bind_param('ii', $nNumero , $idUsario );
        $bResultado = $stmt->execute();
        // $stmt->error;
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