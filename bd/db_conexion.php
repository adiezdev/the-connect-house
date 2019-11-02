<?php
$hostlocal = "localhost";
$usuariolocal = "root";
$passwordlocal = "";
$db_local = "conecthouse_bd";
//
//
//https://remotemysql.com
$hostremote = "remotemysql.com";
$usuarioremote = "pD1cDq7b3Z";
$passwordremote = "RxYW7PpaEW";
$db_remote = "pD1cDq7b3Z";
$puerto = "3306";
//
//
//Conexion remota
$enlaceRemoto = mysqli_connect($hostremote,$usuarioremote,$passwordremote,$db_remote,$puerto);
if (!$enlaceRemoto) {
    //Conexion local
    $enlacelocal = mysqli_connect($hostlocal,$usuariolocal,$passwordlocal,$db_local);
    if(!$enlacelocal)
    {
        echo 'No se ha podido conectar a ninguna base de datos';
    }
}
?>