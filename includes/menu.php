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
    <?php
    echo '<a href="'.get_root_uri().'/index.php">Incio</a>';
    if(isset($_SESSION['idUsuario']))
    {
        //
        //Accedemos a la base de datos
        $aDbUsuarios = new Usuario();
        //
        //Accedemos a datos del usuario
        $oDatosUsuarios = $aDbUsuarios->getById($_SESSION['idUsuario']);
        //
        echo ' <a href="'.get_root_uri().'/perfil.php?correo='.$oDatosUsuarios[0]->Correo.'">Perfil</a>';
        echo ' <a href="'.get_root_uri().'/favoritos.php">Mis favoritos</a>';
        echo ' <a href="'.get_root_uri().'/cerrar-session.php">Cerrar Sesión</a>';
    }
    else
    {
        echo '<a href="'.get_root_uri().'/login-registro.php">Inciar sesión</a>';
    }
    ?>
</div>

<nav class="menucabecera">
    <div><i class="fa fa-bars"></i></div>
        <?php
        echo '<a href="'.get_root_uri().'/index.php">Incio</a>';
        if(isset($_SESSION['idUsuario']))
        {
            //
            //Accedemos a la base de datos
            $aDbUsuarios = new Usuario();
            //
            //Accedemos a datos del usuario
            $oDatosUsuarios = $aDbUsuarios->getById($_SESSION['idUsuario']);
            //
            echo ' <a href="'.get_root_uri().'/perfil.php?correo='.$oDatosUsuarios[0]->Correo.'">Perfil</a>';
            echo ' <a href="'.get_root_uri().'/favoritos.php">Mis favoritos</a>';
            echo ' <a href="'.get_root_uri().'/cerrar-session.php">Cerrar Sesión</a>';
        }
        else
        {
            echo '<a href="'.get_root_uri().'/login-registro.php">Inciar sesión</a>';
        }
        ?>
        <form method="get" action="<?php get_root_uri()?>/buscar.php">
            <input type="search" name="Buscar" id="search" placeholder="Buscar por calle ...">
        </form>
</nav>

