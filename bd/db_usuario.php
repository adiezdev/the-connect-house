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
      $oResultado = $this->query('SELECT * FROM '.$this->sTabla);
      while ($oRecord = $oResult->fetch_object()) {
        array_push($aUsuarios, $oRecord);
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
        $oResultado = $this->query('SELECT * FROM '.$this->sTabla .' WHERE idUsuario = '.$nIdUsuario);
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
    public function getLogin( $sUsuario , $sPassword)
    {
       $aCuenta = array();
       $ePassword = md5($sPassword);
       $oResultado = $this->query('SELECT idUsuario FROM '.$this->sTabla.' WHERE Correo = '.$sUsuario.' AND Password = '.$ePassword);
       if(!$oResultado)
       {
           return $aCuenta; //Devuelve el array vacío sino existe
       }
       while( $oRecord = $oResultado->fetch_object()) 
       {
           array_push($aCuenta , $oRecord);
       }
       return $aCuenta;
    }  
    /**
     *  
     * 
    */
    public function updateUsuario( $nIdUsuario, $sCorreo, $sNombre, $sApellidos, $sDescripcion) 
    {
        
    }
}

?>