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
         ESTILOS_VENTANA
    );
    //
    //Generamos la cabecera
    cabecera(TITULO_PERFIIL , $estilos , false);
    //
    //Sacar los datos del usuario
    $aDbUsuario = new Usuario();
    $oDatosUsuario = '';
    $idUsuario = '';
    if(isset($_SESSION['idUsuario']) || $_SESSION['idUsuario'] > 0)
    {
        $oDatosUsuario = $aDbUsuario->getById($_SESSION['idUsuario']);
    }
    //
    //
    //Sacar los pisos/Habitaciones del usuario
    $aDbPisosHabitaciones = new Pisos();
    $aPisosHabitaciones = $aDbPisosHabitaciones->getByUsuario( $_SESSION['idUsuario'] );
?>
<body>
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
                        echo $Html;
                    }
                    ?>
                </div>
                <ul>
                    <li><a>Inicio</a></li>
                    <li><a>Cofiguración</a></li>
                    <li><a>Favoritos</a></li>
                    <li><a>Perfil</a></li>
                    <li><a>Buscar...</a></li>
                </ul>
            </div>
        </div>
        <div class="contenedor-centro">
            <div class="into-centro">
                <?php
                //
                //Si no tenemos piso en la base de datos , te aparecerá para agregarlo
                if(empty($aPisosHabitaciones))
                {
                    $Html  = '<div id="vacio">';
                    $Html .= '<img src="img/key.png" alt="llaves" style="width: 40%">';
                    $Html .= '<h2>A parte de buscar piso o habitación</h2><br>';
                    $Html .= '<h2>Puesdes alquilar tú habitación o piso</h2>';
                    $Html .= '<button class="button" id="buttonVentana" >Empezar</button>';
                    $Html .= '</div>';
                    echo $Html;
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
                }else
                {
                    //
                    foreach ( $aPisosHabitaciones as $aPisoHabitacion)
                    {
                        //
                        //Pasamos el id pero codificado
                        $Html1  = '<div class="box-mas-visitados" onclick="window.open(\'/the-connect-house/piso.php?'.base64_encode('idPiso='.$aPisoHabitacion->idPiso).'\', \'_self\');">';
                        //Llamamos pasa sacar la imagen del psio
                        $aDbImagen = new Imagenes();
                        $ImagenDestacada =  $aDbImagen->getByIdPisoPrimeraFoto($aPisoHabitacion->idPiso);
                        //
                        foreach ($ImagenDestacada as $ImagenDestacad)
                        {
                            $Html1 .= '<img src="'.$ImagenDestacad->Url.'" alt="habitación">';
                        }
                        $Html1 .= '<div class="datospiso">';
                        $Html1 .= '<h2 >'.$aPisoHabitacion->Calle.'</h2>';
                        $Html1 .= '<div class="descripcion">';
                        $Html1 .=    '<p><i class="fas fa-map-marker-alt"></i> '.$aPisoHabitacion->Ciudad.'</p><br>';
                        $Html1 .=    '<p id="descripcionPH">'.$aPisoHabitacion->Descripcion.'</p><br>';
                        $Html1 .= '</div>';
                        $Html1 .= '<div class="datos">';
                        $Html1 .=    '<p><i class="fas fa-bed"></i> Habitaciones '.$aPisoHabitacion->NHabitaciones.'  |</p>';
                        $Html1 .=    '<p><i class="fas fa-bath"></i> Baños '.$aPisoHabitacion->NBanos.'</p><br>';
                        $Html1 .=    '<span>'.$aPisoHabitacion->Precio.'€/mes</span>';
                        $Html1 .= '</div>';
                        $Html1 .=' </div>
                            </div>';
                        echo $Html1;
                    }

                }
                ?>
            </div>
        </div>
        <div class="contenedor-derecho">
            <div class="into-derecho">
                <?php
                if(!empty($aPisosHabitaciones))
                {
                    $Html  = '<div id="vacio">';
                    $Html .= '<img src="img/key.png" alt="llaves" style="width: 40%">';
                    $Html .= '<h2>Añade más pisos o habitaciones, que quieras alquilar</h2>';
                    $Html .= '<button class="button" id="buttonVentana" >Empezar</button>';
                    $Html .= '</div>';
                    echo $Html;
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
                ?>
            </div>
        </div>
    </div>
    <?php  require_once(__DIR__."/includes/footer.php"); ?>
</body>
<script src="<?php echo get_root_uri() ?>/the-connect-house/js/crearventana.js"></script>
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