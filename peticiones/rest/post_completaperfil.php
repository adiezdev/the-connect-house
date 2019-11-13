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
    require_once(__DIR__ . '/../bd/bd_usuario.php');
    //
    session_start();
    //
    if(isset($_POST['siguiente']))
    {
        $dbUsuario = new Usuario();
        //
        //echo $value . "<br />";
        $value = $_POST['imagen'];
        $sDescripcion = $_POST['descripcion'];
        $datos = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $value));
        $nom = md5(rand());
        $filepath = "uploads/".$nom.".jpg";
        file_put_contents($filepath,$datos);
        //
        $sCorreo = $_SESSION['correo'];
        $lResult = $dbUsuario->updateCampos( $sCorreo , $sDescripcion , $filepath);
        if(!$lResult)
        {
            header("Location: ../login-registro.php");
        }
        else
        {
            header("Location: ../login-registro.php");
        }
    }