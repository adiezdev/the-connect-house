<?php
//
//Variables locales
/*$hostlocal = "localhost";
$usuariolocal = "root";
$passwordlocal = "";
$db_local = "conecthouse_bd";*/
//
//https://remotemysql.com
/*$sHostremote = "remotemysql.com";
$sUsuarioremote = "pD1cDq7b3Z";
$sPasswordremote = "RxYW7PpaEW";
sD= "pD1cDq7b3Z";
$puerto = "3306";*/
class Conexion{
    private $oConexion;
    private $sHostremote = "remotemysql.com";
    private $sUsuarioremote = "pD1cDq7b3Z";
    private $sPasswordremote = "RxYW7PpaEW";
    private $sDb_remote = "pD1cDq7b3Z";
    private $sPuerto = "3306";

    public function __construct() {
        $this->oConexion = new mysqli($this->sHostremote, $this->sUsuarioremote, $this->sPasswordremote, $this->sDb_remote, $this->sPuerto);
    }

    public function prepare($sql){
        return $this->oConexion->prepare($sql);
    }
    public function execute() {
        return $this->oConexion->execute();
    }
}
?>