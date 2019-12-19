<?php
    //error_reporting( E_ALL );
    //ini_set( 'display_errors' , true );
    //ini_set( 'display_startup_errors' , true );
    /*
        -------------------------------------
        Archivo de: Alejandro Díez
        GitHub: @adilosa95
        Proyecto: the-connect-house
        Nombre del archivo: bd_favoritos.php
        -------------------------------------
    */
    //
    require_once( __DIR__.'/bd_conexion.php' );
    //
class Favoritos extends Conexion
{
    //
    //Nombre de la tabla
    private $sTabla = 'favoritos';
    /**
     * funcion que devuelve los fav de un usuario
     *
     * @return array
     */
    public function getById( $nIdUsuario )
    {
        $aFavUser = array();
        $cSql = 'SELECT * FROM '.$this->sTabla.' WHERE idUsuario = ?';
        $stmt = $this->prepare($cSql);
        $stmt->bind_param('i', $nIdUsuario );
        $stmt->execute();
        $oResultado = $stmt->get_result();
        while( $oRecord = $oResultado->fetch_object())
        {
            $aFavUser[] =  $oRecord;
        }
        return $aFavUser;
    }
    /**
     * Función para agregar un piso a favoritos
     *
     * @param $nIdPiso
     * @param $nIdUsuario
     * @return bool
     */
    public function addFav( $nIdUsuario , $nIdPiso )
    {
        $cSql = 'INSERT INTO '.$this->sTabla.' ( idUsuario , idPiso ) VALUES ( ?, ? )';
        $stmt = $this->prepare( $cSql );
        $stmt->bind_param('ii',  $nIdUsuario , $nIdPiso );
        $bResultado = $stmt->execute();
        //echo $stmt->error;
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
     * Funcion para eliminar un piso de favoritos
     * @param $nIdPiso
     * @return bool
     */
    public function deleteFav( $nIdPiso )
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
    /**
     * Funcion para eliminar un piso de favoritos
     * @param $nIdPiso
     * @return bool
     */
    public function deleteFavUsuer( $nIdUser )
    {
        $cSql = 'DELETE FROM '.$this->sTabla.' WHERE idUsuario = ?';
        $stmt = $this->prepare($cSql);
        $stmt->bind_param('i' , $nIdUser);
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