<?php
    //error_reporting( E_ALL );
    //ini_set( 'display_errors' , true );
    //ini_set( 'display_startup_errors' , true );
    /*
        -------------------------------------
        Archivo de: Alejandro Díez
        GitHub: @adilosa95
        Proyecto: the-connect-house
        Nombre del archivo: perfil.php
        -------------------------------------
    */
    require_once(__DIR__."/includes/header.php");
    require_once(__DIR__."/includes/constantes.php");
    require_once(__DIR__."/includes/sesion.php");
    require_once(__DIR__."/includes/crearventana.php");
    require_once(__DIR__."/includes/tarjetas.php");
    //
    //Acceso a datos
    require_once(__DIR__."/bd/bd_usuario.php");
    require_once(__DIR__."/bd/bd_pisos.php");
    require_once(__DIR__."/bd/bd_telefonos.php");
    //
    //Configuramos los estilos que necesitamos
    $estilos = array(
         ESTILOS_WIDGETS,
         ESTILOS_MAIN,
         ESTILOS_MENU,
         ESTILOS_VENTANA
    );
    //
    //Generamos la cabecera
    cabecera(TITULO_PERFIIL , $estilos , false);
    //
    //Respuesta del GET
    if( $_GET )
    {
        //Sacar el valor del correo
	   $sCorreo =  $_GET["correo"];
    }
    else
    {
        //
        //Si intentamos entrar sin una petición get nos redirecciona
        header( "location:/the-connect-house/index.php" );
        return;
    }
    //
    //Sacar los datos del usuario de la peticón
    $aDbUsuario = new Usuario();
    //
    //Accedemos a datos mediante el correo
    $oDatosUsuario = $aDbUsuario->getByCorreo($sCorreo);
    //
    //Sino existe nos redirigimos al index
    if(!$oDatosUsuario)
    {
        header( "location:/the-connect-house/index.php" );
        return;
    }
    //
    //
    //Sacar los pisos/Habitaciones del usuario de la peticiión get
    $aDbPisosHabitaciones = new Pisos();
    $aDbPisosHabitaciones = $aDbPisosHabitaciones->getByUsuario( $oDatosUsuario[0]->idUsuario );
    //
?>
<body>
<!--Menu-->
<?php require_once(__DIR__ . '/includes/menu.php'); ?>
    <div class="content">
        <div class="contenedor-izquierdo">
            <div class="into-izquierdo">
                <div id="perfil">
                    <?php
                    //Datos perfil
                    foreach ( $oDatosUsuario as $oDatoUsuario )
                    {
                        //Rescatamos la id
                        $idUsuario = $oDatoUsuario->idUsuario;
                        //Mostramos la imagen de perfil
                        $Html = '<img class="user" src="'.$oDatoUsuario->Imgperfil.'" alt="imgen-perfil" srcset="">';
                        //Mostamos datos
                        $Html .= '<h3>'.$oDatoUsuario->Nombre.' '.$oDatoUsuario->Apellidos.'</h3><br>';
                        $Html .= '<div class="titleciudad"><p><i class="fas fa-map-pin"></i>'.$oDatoUsuario->Ciudad.'</p></div><br>';
                        $Html .= '<fieldset><legend>Descripción :</legend>';
                        $Html .= '<div id="descripcion"><p>'.$oDatoUsuario->Descripcion.'</p></div><br>';
                        //
                        $Html .= '</fieldset>';
                        //
                        //Sacamos el telelfono del usuario
                        $oDbTelefono = new Telefonos();
                        $aDbTelefonos = $oDbTelefono->getByIdUsuario($oDatoUsuario->idUsuario );
                        //
                        $Html .= '<h3>Números de telefono</h3>';
                        foreach ( $aDbTelefonos as $key=>$aDbTelefono)
                        {
                            $Html .= '<h3>Num '.($key+1).': '.$aDbTelefono->Numero.'</h3>';
                        }
                        //
                        //Si el usuario es el mismo que sessón
	                    if( $idUsuario == $_SESSION['idUsuario'])
	                    {
		                    $Html .= '<div class="editar-piso"><i class="fas fa-pen"></i> Editar Perfil</div>';

	                    }
                    }
                    //
                    //Si el usuario es el mismo que sessón
                    if( $idUsuario == $_SESSION['idUsuario'])
                    {
                        //Si si estña inicializado el array pisos habitaciones aparecerá debajo para insertar más
                        if(!empty($aDbPisosHabitaciones))
                        {
                            $Html .= '<div id="vacio">';
                            $Html .= '<img src="img/key.png" alt="llaves">';
                            $Html .= '<h3>Añade más pisos o habitaciones, que quieras poner en alquiler</h3>';
                            $Html .= '<button class="button" id="buttonVentana" >Empezar</button>';
                            $Html .= '</div>';
                            //
                            //Array botones que aparecen en la ventana
                            $btones = array(
                                "Añadir Habitación",
                                "Añadir Piso"
                            );
                            $btonesfuncion = array(
                                "addPisoHabitacion(2)",
                                "addPisoHabitacion(1)"
                            );
                            //
                            //Generamos la ventana
                            getVentana( FRASE_ADD_REGISTRO , $btones , $btonesfuncion);
                        }
                    }
                    //Mostramos todo
                    echo $Html;
                    ?>
                </div>
            </div>
        </div>
        <div class="contenedor-centro">
            <div class="into-centro seccioncentro">
                <?php
                //
                //Si no tenemos piso en la base de datos , te aparecerá para agregarlo
                if(empty($aDbPisosHabitaciones))
                {
	                $Html  = '<div id="vacio">';
	                if( $oDatosUsuario[0]->idUsuario == $_SESSION['idUsuario'] )
	                {
		                $Html .= '<img src="img/key.png" alt="llaves" style="width: 40%">';
		                $Html .= '<h2>A parte de buscar piso o habitación</h2><br>';
		                $Html .= '<h2>Puesdes alquilar tú habitación o piso</h2>';
		                $Html .= '<button class="button" id="buttonVentana" >Empezar</button>';
		                //
		                //Array botones que aparecen en la ventana
		                $btones = array(
			                "Añadir Habitación",
			                "Añadir Piso"
		                );
		                $btonesfuncion = array(
			                "addPisoHabitacion(2)",
			                "addPisoHabitacion(1)"
		                );
		                //
		                //Generamos la ventana
		                getVentana( FRASE_ADD_REGISTRO , $btones , $btonesfuncion);
                        echo $Html;
	                }
	                else
                    {
                        //Si viisitas un usuario y no tiene pisos aparecerá este mensaje
	                    $Html .= '<h2>Este usuario no tiene ningún piso</h2><br>';
                        echo $Html;
                    }
	                //
                    $Html  = '</div>';
	                //Lo mostramos
	                echo $Html;
                }else
                {
                    getPisosHabitacionesHorizontal( $aDbPisosHabitaciones );

                }
                ?>
            </div>
        </div>
    </div>
    <!--Footer-->
    <?php  require_once(__DIR__."/includes/footer.php"); ?>
</body>
<script src="<?php echo get_root_uri() ?>/the-connect-house/js/crearventana.js"></script>
<script src="<?php echo get_root_uri() ?>/the-connect-house/js/like.js"></script>
<script src="<?php echo get_root_uri() ?>/the-connect-house/js/menu.js"></script>
<script>
    /**
     * Función para ir a registrar tu piso o habitacion
     *
     * @param tipo
     */
    function addPisoHabitacion( tipo )
    {
        window.open('/the-connect-house/piso-habitacion/registrar-piso-habitacion.php?Tipo='+tipo,'_self');
    }
</script>
</html>