<?php
    //error_reporting( E_ALL );
    //ini_set( 'display_errors' , true );
    //ini_set( 'display_startup_errors' , true );
    /*
        -------------------------------------
        Archivo de: Alejandro Díez
        GitHub: @adilosa95
        Proyecto: the-connect-house
        Nombre del archivo: favoritos.php
        -------------------------------------
    */
    session_start();
    require_once(__DIR__."/includes/sesion.php");
    require_once(__DIR__."/includes/header.php");
    require_once(__DIR__."/includes/constantes.php");
    require_once(__DIR__."/includes/crearventana.php");
    require_once(__DIR__."/includes/tarjetas.php");
    //
    //Accedemos a datos
    require_once(__DIR__."/bd/bd_usuario.php" );
    require_once(__DIR__."/bd/bd_pisos.php" );
    require_once(__DIR__."/bd/bd_favoritos.php" );
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
    cabecera(TITULO_BUSQUEDA , $estilos ,true);
    //
    //Sacar los datos del usuario de la peticón
    $aDbUsuario = new Usuario();
    //
    //Accedemos a datos la id de la sesión ya que ésta sección es privada
    $oDatosUsuario = $aDbUsuario->getById($_SESSION['idUsuario']);
    //
    //
    //Sacar los pisos/Habitaciones del usuario de la peticiión get
    $aDbFavPisosHabitaciones = new Favoritos();
    $aDbFavPisosHabitaciones = $aDbFavPisosHabitaciones->getById( $_SESSION['idUsuario'] );
    //
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
                        $idUsuario = $oDatoUsuario->idUsuario;
                        $Html = '<img class="user" src="'.$oDatoUsuario->Imgperfil.'" alt="imgen-perfil" srcset="">';
                        $Html .= '<h3>'.$oDatoUsuario->Nombre.' '.$oDatoUsuario->Apellidos.'</h3><br>';
                        $Html .= '<div class="titleciudad"><p><i class="fas fa-map-pin"></i>'.$oDatoUsuario->Ciudad.'</p></div><br>';
                        $Html .= '<fieldset><legend>Descripción :</legend>';
                        $Html .= '<div id="descripcion"><p>'.$oDatoUsuario->Descripcion.'</p></div><br>';
                        $Html .= '</fieldset>';
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
                    //Mostramos
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
                if(empty($aDbFavPisosHabitaciones)) {
                    $Html = '<div id="vacio" class="centro">';
                    if ($oDatosUsuario[0]->idUsuario == $_SESSION['idUsuario']) {
                        $Html .= '<img src="img/heart.png" alt="llaves" style="width: 40%">';
                        $Html .= '<h2>Navega y selecciona</h2><br>';
                        $Html .= '<h2>Pisos y habitaciones favoritos</h2>';
                        //
                        echo $Html;
                    } else {
                        //Si viisitas un usuario y no tiene pisos aparecerá este mensaje
                        $Html .= '<h2>Este usuario no tiene ningún piso</h2><br>';
                        echo $Html;
                    }
                    //
                    $Html = '</div>';
                    //Lo mostramos
                    echo $Html;
                }
                else
                {
                    //Recorremos los favoritos
                    foreach ( $aDbFavPisosHabitaciones as $aDbFavPisosHabitacion)
                    {
                        //Sacamos los datos del idPiso
                        $aDbPisosHabitaciones = new Pisos();
                        $aDbPisosHabitaciones = $aDbPisosHabitaciones->getById( $aDbFavPisosHabitacion->idPiso );
                        //
                        //Finalmente formamos las terjetas para ver los pisos
                        getPisosHabitacionesHorizontal($aDbPisosHabitaciones);
                    }

                }
                ?>
            </div>
        </div>
    </div>
    <!--Footer-->
    <?php  require_once(__DIR__."/includes/footer.php"); ?>
</body>
<!--Scripts-->
<script src="<?php echo get_root_uri() ?>/js/like.js"></script>
<script src="<?php echo get_root_uri() ?>/js/menu.js"></script>
<script src="<?php echo get_root_uri() ?>/js/crearventana.js"></script>
<script>
    /**
     * Función para ir a registrar tu piso o habitacion
     *
     * @param tipo
     */
    function addPisoHabitacion( tipo )
    {
        window.open('/piso-habitacion/registrar-piso-habitacion.php?Tipo='+tipo,'_self');
    }
</script>