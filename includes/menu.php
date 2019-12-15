<?php
	//error_reporting( E_ALL );
	//ini_set( 'display_errors' , true );
	//ini_set( 'display_startup_errors' , true );
	/*
		-------------------------------------
		Archivo de: Alejandro Díez
		GitHub: @adilosa95
		Proyecto: the-connect-house
		Nombre del archivo: menu.php
		-------------------------------------
	*/
?>
<div id="menumovil" class="navmovil">
    <a href="javascript:void(0)" class="botoncerrar">&times;</a>
    <a href="#">About</a>
    <a href="#">Features</a>
    <a href="#">Contact Us</a>
</div>

<nav class="menucabecera">
    <div><i class="fa fa-bars"></i></div>
    <?php
        echo '<a href="'.get_root_uri().'/the-connect-house/index.php">Incio</a>';
        if(isset($oDatosUsuario))
        {
            echo ' <a href="'.get_root_uri().'/the-connect-house/perfil.php?correo='.$oDatosUsuario[0]->Correo.'">Perfil</a>';
        }
        else
        {
            echo '<a href="'.get_root_uri().'/the-connect-house/login-registro.php">Inciar sesión</a>';
        }
    ?>
    <form method="get" action="<?php get_root_uri()?>/the-connect-house/buscar.php">
        <input type="search" name="Buscar" id="search" placeholder="Buscar por calle ...">
    </form>
</nav>

