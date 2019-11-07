<?php 
require_once(__DIR__.'/db_conexion.php');
//
//
class Usuario extends Conexion{
    //
    //Nombre de la tabla
    private $sTabla = 'usuarios';
    /**
     * Devuel todos los usuarios de la base de datos
     * 
     * @param string $sId
     * 
     * @return array $aUsuarios
     */
    public function getAll()
    {
      $aUsuarios = array();
      $cSql = 'SELECT * FROM '.$this->sTabla;
      $oResultado = $this->query( $cSql );
      while ($oRecord = $oResultado->fetch_object()) {
        $aUsuarios[] = $oRecord;
      }
      return $aUsuarios;
    }
    /**
     * Devuelve todos los datos de un suario por su Id
     *
     * @param string $sId
     * 
     * @return array $aUsuariosPorId
     */
    public function getById( $nIdUsuario )
    {
        $aUsuariosPorId = array();
        $cSql = 'SELECT * FROM '.$this->sTabla.' WHERE idUsuario = '.$nIdUsuario;
        $oResultado = $this->query( $cSql );
        while( $oRecord = $oResultado->fetch_object()) 
        {
            array_push($aUsuariosPorId , $oRecord);
        }
        return $aUsuariosPorId;
    }
    /**
     * Comprueba si el usuario existe. Si es así devuelve el idUsuario
     * 
     * @param string $sUsuario
     * @param string $sPassword
     * 
     * @return array $aCuenta
     */
    public function getLogin( $sCorreo , $sPassword)
    {
       $aCuenta = array();
       $cSql = 'SELECT idUsuario FROM '.$this->sTabla.' WHERE Correo = ? AND Password = ?';
       $stmt = $this->prepare($cSql);
       $stmt->bind_param('ss', $sCorreo, $sPassword);
       $stmt->execute();
       $oResultado = $stmt->get_result();
       while( $oRecord = $oResultado->fetch_object()) 
       {
         $aCuenta[] = $oRecord;
       }
       return $aCuenta;
    }  
    /**
     * Actualiza los campos del usuario
     * 
     * @param string $nIdUsuario
     * @param string $sCorreo
     * @param string $sNombre
     * @param string $sApellidos
     * @param string $sDescripcion
     * 
     * @return array $aCuenta
     */
    public function updateUsuario( $nIdUsuario, $sCorreo, $sNombre, $sApellidos, $sDescripcion) 
    {
        $aCuenta = array();
        $cSql = 'UPDATE '.$this->sTabla.' SET Correo = '.$sCorreo.', Nombre = '.$sNombre.', Apellidos = '.$sApellidos.', Descripciion = '.$sDescripcion.' WHERE idUsuario = '.$nIdUsuario;
        $oResultado = $this->query( $cSql );
        while( $oRecord = $oResultado->fetch_object()) 
        {
            array_push($aCuenta , $oRecord);
        }
        return $aCuenta;
    }
    /**
     * Elimina el usuario por su id
     * 
     * @param string $nIdUsuario
     * 
     * @return boolean 
     */
    public function deleteUsuario( $nIdUsuario )
    {
        $cSql = 'DELETE FROM'.$this->sTabla.' WHERE idUsuario = '.$nIdUsuario;
        $oResultado = $this->query( $cSql );
        if(!$oResult)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
}

?>