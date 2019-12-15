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
    //
    //Acceso a datos
    require_once(__DIR__."/bd/bd_usuario.php");
    require_once(__DIR__."/bd/bd_pisos.php");
    require_once(__DIR__."/bd/bd_imagenespiso.php");
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
    //Sacar los datos del usuario
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
    //Sacar los pisos/Habitaciones del usuario
    $aDbPisosHabitaciones = new Pisos();
    $aDbPisosHabitaciones = $aDbPisosHabitaciones->getByUsuario( $oDatosUsuario[0]->idUsuario );
?>
<body>
<?php require_once(__DIR__ . '/includes/menu.php'); ?>
    <div class="content">
        <div class="contenedor-izquierdo">
            <div class="into-izquierdo">
                <div id="perfil">
                    <?php
                    //Datos perfil
                    foreach ( $oDatosUsuario as $oDatoUsuario )
                    {
                        $idUsuario = $oDatoUsuario->idUsuario;
                        $Html = '<img id="user" src="'.$oDatoUsuario->Imgperfil.'" alt="imgen-perfil" srcset="">';
                        $Html .= '<h3>'.$oDatoUsuario->Nombre.' '.$oDatoUsuario->Apellidos.'</h3><br>';
                        $Html .= '<div class="titleciudad"><p><i class="fas fa-map-pin"></i>'.$oDatoUsuario->Ciudad.'</p></div><br>';
                        $Html .= '<fieldset><legend>Descripción :</legend>';
                        $Html .= '<div id="descripcion"><p>'.$oDatoUsuario->Descripcion.'</p></div><br>';
                        $Html .= '</fieldset>';
	                    if( $idUsuario == $_SESSION['idUsuario'])
	                    {
		                    $Html .= '<div class="editar-piso"><i class="fas fa-pen"></i> Editar Perfil</div>';

	                    }
                        echo $Html;
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="contenedor-centro">
            <div class="into-centro">
                <?php
                //
                //Si no tenemos piso en la base de datos , te aparecerá para agregarlo
                if(!isset($aDbPisosHabitaciones))
                {
	                $Html  = '<div id="vacio">';
	                if( $aDbPisosHabitaciones->idUsuario == $_SESSION['idUsuario'] )
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
	                }
	                else
                    {
	                    $Html .= '<h2>Este usuario no tiene ningún piso</h2><br>';
                    }
                    $Html  = '</div>';
	                echo $Html;
                }else
                {
                    foreach ( $aDbPisosHabitaciones as $aDbPisosHabitacion )
                    {
                        $Html  = '<div class="box-mas-visitados" onclick="window.open(\'/the-connect-house/piso.php?'.base64_encode('idPiso='.$aDbPisosHabitacion->idPiso).'\', \'_self\');">';
                        //
                        if(  $aDbPisosHabitacion->idUsuario != $_SESSION['idUsuario'] )
                        {
                        $Html .= '<div class="likeit">'.file_get_contents("img/iconos-materiales/like.svg").'</div>';
                        }
                        //
                        //Accedemos a la imagen del piso
                        $aDbImagen = new Imagenes();
                        $ImagenDestacada =  $aDbImagen->getByIdPisoPrimeraFoto( $aDbPisosHabitacion->idPiso );
                        //
                        foreach ($ImagenDestacada as $ImagenDestacad)
                        {
                            $Html .= '<img src="'.$ImagenDestacad->Url.'" alt="habitación">';
                        }
                        $Html .= '<div class="contenido">';
                        $Html .= '<h2 >'.$aDbPisosHabitacion->Calle.'</h2>';
                        $Html .= '<div class="descripcion">';
                        $Html .= '<p><i class="fas fa-map-marker-alt"></i><span id="ciudad">'.$aDbPisosHabitacion->Ciudad.'</span> , '.$aDbPisosHabitacion->Calle.'</p><br>';
                        $Html .= '<p id="descripcionPH">'.$aDbPisosHabitacion->Descripcion.'</p><br>';
                        $Html .= '</div>';
                        $Html .= '<div class="datos">';
                        $Html .= '<p><i class="fas fa-bed"></i> Habitaciones '.$aDbPisosHabitacion->NHabitaciones.' |</p>';
                        $Html .= '<p><i class="fas fa-bath"></i> Baños '.$aDbPisosHabitacion->NBanos.'</p>';
                        $Html .= '</div>';
                        $Html .= '</div>';
                        $Html .= '<div class="precio">'.$aDbPisosHabitacion->Precio.' €/mes</div>';
                        //
                        $Html .= '</div>';
                        if(  $aDbPisosHabitacion->idUsuario == $_SESSION['idUsuario'])
                        {
                            $Html .= '<div class="editar-piso"><i class="fas fa-pen"></i> Editar</div>';

                        }
                        echo $Html;
                    }

                }
                ?>
            </div>
        </div>
                <?php
                    //
                    //Contenedor de la derecha
                if(!empty($aDbPisosHabitaciones))
                {
                    $Html  = '<div class="contenedor-derecho">';
                    $Html .= '<div class="into-derecho">';
                    $Html .= '<div id="vacio">';
                    $Html .= '<img src="img/key.png" alt="llaves" style="width: 40%">';
                    $Html .= '<h2>Añade más pisos o habitaciones, que quieras alquilar</h2>';
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

                    $Html .= '</div>
                    </div>';
                echo $Html;
                }
                ?>
    </div>
    <!--Footer-->
    <?php  require_once(__DIR__."/includes/footer.php"); ?>
</body>
<script src="<?php echo get_root_uri() ?>/the-connect-house/js/crearventana.js"></script>
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