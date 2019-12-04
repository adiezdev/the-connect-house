<?php
//error_reporting( E_ALL );
//ini_set( 'display_errors' , true );
//ini_set( 'display_startup_errors' , true );
/*
    -------------------------------------
    Archivo de: Alejandro Díez
    GitHub: @adilosa95
    Proyecto: the-connect-house
    Nombre del archivo: bd_usuario.php
    -------------------------------------
*/
require_once( __DIR__.'/bd_conexion.php' );
//
//
class Usuario extends Conexion
{
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
     * Devuelve los campos por su correo
     * @param $sCorreo
     * @return array
     */
    public function getByCorreo( $sCorreo )
    {
        $aUsuariosPorC = array();
        $cSql = 'SELECT * FROM '.$this->sTabla.' WHERE Correo = ?';
        $stmt = $this->prepare($cSql);
        $stmt->bind_param('s', $sCorreo );
        $stmt->execute();
        $oResultado = $stmt->get_result();
        while( $oRecord = $oResultado->fetch_object())
        {
            $aUsuariosPorC[] =  $oRecord;
        }
        return $aUsuariosPorC;
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
       $cSql = 'SELECT * FROM '.$this->sTabla.' WHERE Correo = ? AND Password = ?';
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
     * @param $sCarptea
     *
     * @return bool
     */
    public function addUsuario( $sCorreo, $sPassword, $sNombre , $sApellidos, $sCiudad, $sSexo , $sCarptea )
    {
	    $sFecha =  date( "Y-m-d" );
        $cSql = 'INSERT INTO usuarios (Correo, Password, Nombre, Apellidos, Ciudad, Sexo , Carpeta , Fecha) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?)';
        $stmt = $this->prepare( $cSql );
        $stmt->bind_param( 'ssssssss' , $sCorreo, $sPassword, $sNombre , $sApellidos, $sCiudad, $sSexo , $sCarptea , $sFecha );
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
     * Devuelve la ultima ID de ultimo usuario
     *
     * @return array
     */
    public function getLastID()
    {
        $aUltimaID = array();
        $cSql = 'SELECT * FROM '.$this->sTabla.' ORDER BY idUsuario DESC LIMIT 1';
        $stmt = $this->prepare( $cSql );
        $bResultado = $stmt->execute();
        $oResultado = $stmt->get_result();
        while( $oRecord = $oResultado->fetch_object())
        {
            $aUltimaID[] = $oRecord;
        }
        return $aUltimaID;

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
     * @return bool
     */
    public function updateUsuario( $nIdUsuario, $sCorreo, $sNombre, $sApellidos, $sDescripcion) 
    {
        $cSql = 'UPDATE '.$this->sTabla.' SET Correo = ?, Nombre = ?, Apellidos = ?, Descripciion = ? WHERE idUsuario = ?';
        $stmt = $this->prepare($cSql);
        $stmt->bind_param('ssssi', $sCorreo, $sNombre, $sApellidos, $sDescripcion , $nIdUsuario);
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
     * Actualiza la descripcion y la imagen por su id
     *
     * @param $sDescripcion
     * @param string $UrlIMG
     *
     * @return bool
     */
    public function updateCampos( $nId , $sDescripcion , $UrlIMG = 'img/isset/isset-user.png')
    {
        $cSql = 'UPDATE '.$this->sTabla.' SET 
                    Descripcion = ? , 
                    Imgperfil = ? 
                    WHERE idUsuario = ?';
        //
        $stmt = $this->prepare($cSql);
        $stmt->bind_param('ssi', $sDescripcion, $UrlIMG , $nId);
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