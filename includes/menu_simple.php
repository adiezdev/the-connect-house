<?php
	//error_reporting( E_ALL );
	//ini_set( 'display_errors' , true );
	//ini_set( 'display_startup_errors' , true );
	/*
		-------------------------------------
		Archivo de: Alejandro Díez
		GitHub: @adilosa95
		Proyecto: the-connect-house
		Nombre del archivo: menu_simple.php
		-------------------------------------
	*/
	require_once (__DIR__.'/funciones.php');
	//
	require_once (__DIR__.'/../bd/bd_usuario.php');
	session_start();
	//
	//Accedemos al usuario
	$oDbUsuario = new Usuario();
	$aDbUsuario = $oDbUsuario->getById( $_SESSION['idUsuario'] ) ;
?>
<div class="menu">
	<ul>
		<li><a href="<?php get_root_uri() ?> /the-connect-house/index.php">Inicio</a></li>
		<li><a href="<?php get_root_uri() ?> /the-connect-house/busqueda-piso.php?correo=<?php $aDbUsuario[0]->Correo ?>" >Perfil</a></li>
		<li><a href="<?php get_root_uri() ?> /the-connect-house/buscar.php">Buscar...</a></li>
		<li><a>Mis Favoritos</a></li>
	</ul>
</div>

