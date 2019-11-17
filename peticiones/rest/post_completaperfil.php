<?php
//error_reporting( E_ALL );
//ini_set( 'display_errors' , true );
//ini_set( 'display_startup_errors' , true );
/*
    -------------------------------------
    Archivo de: Alejandro Díez
    GitHub: @adilosa95
    Proyecto: the-connect-house
    Nombre del archivo: post_completaperfil.php
    -------------------------------------
*/
    require_once(__DIR__ . '/../../bd/bd_usuario.php');
    //
    session_start();
    //
    if(isset($_POST['siguiente']))
    {
        $dbUsuario = new Usuario();
        //
        //Debug
        //echo $value . "<br />";
        //Cojo la iimagen
        $value = $_POST['imagen'];
        if(isset($_POST['imagen']))
        {
            $datos = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $value));
            $nom = md5(rand());
            //Marco la ruta
            $filepathsql = "uploads/".$nom.".jpg";
            $archivoRuta = __DIR__ ."/../../".$filepathsql;
            //Paso la imagen a la ruta
            file_put_contents( $archivoRuta , $datos);
            //Permisos al archivo
            chmod($archivoRuta, 0777);
        }
        $sDescripcion = $_POST['descripcion'];
        //
        $sCorreo = $_SESSION['correo'];
        $lResult = $dbUsuario->updateCampos( $sCorreo , $sDescripcion , $filepathsql);
        if(!$lResult)
        {
            header("Location: ../../perfil.php");
        }
        else
        {
            header("Location: ../../perfil.php");
        }
    }