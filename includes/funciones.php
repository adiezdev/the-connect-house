<?php
/*
    -------------------------------------
    Archivo de: Alejandro Díez
    GitHub: @adilosa95
    Proyecto: the-connect-house
    Nombre del archivo: funciones.php
    -------------------------------------
*/
/**
 * Funcion que devuelve la URL del server
 * @return string
 */
function get_root_uri()
{
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https://' : 'http://';
    return $protocol . $_SERVER['HTTP_HOST'];
}
