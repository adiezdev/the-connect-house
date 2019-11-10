<?php 
require_once(__DIR__.'/db_conexion.php');
//
//
class Usuario extends Conexion{
    //
    //Nombre de la tabla
    private $sTabla = 'usuarios';
    /**
     * Devuelve todos los usuario con sus campos
     *
     * @return array
     */
    public function getAll()
    {
      $aUsuarios = array();
      $cSql = 'SELECT * FROM '.$this->sTabla;
      $stmt = $this->prepare($cSql);
      $stmt->execute();
      $oResultado = $stmt->get_result();
      while ($oRecord = $oResultado->fetch_object()) {
        $aUsuarios[] = $oRecord;
      }
      return $aUsuarios;
    }

    /**
     * Devuelve todos los campos de un usuario por su ID
     *
     * @param $nIdUsuario
     * @return array
     */
    public function getById( $nIdUsuario )
    {
        $aUsuariosPorId = array();
        $cSql = 'SELECT * FROM '.$this->sTabla.' WHERE idUsuario = ?';
        $stmt = $this->prepare($cSql);
        $stmt->bind_param('i', $nIdUsuario );
        $stmt->execute();
        $oResultado = $stmt->get_result();
        while( $oRecord = $oResultado->fetch_object()) 
        {
            $aUsuariosPorId[] =  $oRecord;
        }
        return $aUsuariosPorId;
    }
    /**
     * Loguemos el usuario
     *
     * @param $sCorreo
     * @param $sPassword
     *
     * @return array
     */
    public function getLogin( $sCorreo , $sPassword)
    {
       $aCuenta = array();
       $cSql = 'SELECT idUsuario FROM '.$this->sTabla.' WHERE Correo = ? AND Password = ?';
       $stmt = $this->prepare( $cSql );
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
     * Añadimos un nuevo usuario
     *
     * @param $sCorreo
     * @param $sPassword
     * @param $sNombre
     * @param $sApellidos
     * @param $sSexo
     * @param $sDescripncion
     *
     * @return bool
     */
    public function addUsuario( $sCorreo, $sPassword, $sNombre , $sApellidos, $sCiudad, $sSexo)
    {
        $cSql = 'INSERT INTO usuarios (Correo, Password, Nombre, Apellidos, Ciudad, Sexo) VALUES ( ?, ?, ?, ?, ?, ?)';
        $stmt = $this->prepare( $cSql );
        $stmt->bind_param( 'ssssss' , $sCorreo, $sPassword, $sNombre , $sApellidos, $sCiudad, $sSexo);
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
     * Actualiza los datos de un usuario
     *
     * @param $nIdUsuario
     * @param $sCorreo
     * @param $sNombre
     * @param $sApellidos
     * @param $sDescripcion
     *
     * @return array
     */
    public function updateUsuario( $nIdUsuario, $sCorreo, $sNombre, $sApellidos, $sDescripcion) 
    {
        $aCuenta = array();
        $cSql = 'UPDATE '.$this->sTabla.' SET Correo = ?, Nombre = ?, Apellidos = ?, Descripciion = ? WHERE idUsuario = ?';
        $stmt = $this->prepare($cSql);
        $stmt->bind_param('ssssi', $sCorreo, $sNombre, $sApellidos, $sDescripcion , $nIdUsuario);
        $stmt->execute();
        $oResultado = $stmt->get_result();
        while( $oRecord = $oResultado->fetch_object()) 
        {
            array_push($aCuenta , $oRecord);
        }
        return $aCuenta;
    }

    /**
     * Actualiza la descripcion y la imagen
     *
     * @param $sDescripcion
     * @param string $UrlIMG
     *
     * @return array
     */
    public function updateCampos( $sCorreo, $sDescripcion , $UrlIMG = 'img/isset/isset-user.png')
    {
        $aCuenta = array();
        $cSql = 'UPDATE '.$this->sTabla.' Descripciion = ? , Imgperfil = ? WHERE Correo = ?';
        $stmt = $this->prepare($cSql);
        $stmt->bind_param('sss', $sDescripcion, $UrlIMG , $sCorreo);
        $stmt->execute();
        $oResultado = $stmt->get_result();
        while( $oRecord = $oResultado->fetch_object())
        {
            array_push($aCuenta , $oRecord);
        }
        return $aCuenta;
    }
    /**
     * Elimina un usuarip
     *
     * @param $nIdUsuario
     *
     * @return bool
     */
    public function deleteUsuario( $nIdUsuario )
    {
        $cSql = 'DELETE FROM '.$this->sTabla.' WHERE idUsuario = ?';
        $stmt = $this->prepare($cSql);
        $stmt->bind_param('i' , $nIdUsuario);
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

?>