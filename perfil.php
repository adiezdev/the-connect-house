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
    //
    //Configuramos los estilos que necesitamos
    $estilos = array(
         ESTILOS_WIDGETS,
         ESTILOS_PERFIL,
        ESTILOS_VENTANA
    );
    //
    //Generamos la cabecera
    cabecera(TITULO_PERFIIL , $estilos , false);
    //
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
    <div class="contenedor-izquierdo">
        <div class="into-izquierdo">
            <div id="perfil">

                <?php
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
            <h2>Secciones:</h2>
            <ul>
                <li><a>Favoritos</a></li>
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
                //Array botones que aparecen
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
                getVentana( FRASE_ADD_REGISTRO , $btones);
            }else
            {
                //
                //Si tenemos pisos y habitaciones aparecerán
                foreach ( $aPisosHabitaciones as $aPisoHabitacion)
                {
                    $Html = '<h1>Tus pisos y habitaciones</h1>';
                    $Html.= '<div class="box-mas-visitados">';
                    $Html .= '<img src="img/img-modelo.jpg" alt="habitación" class="habitacion">';
                    $Html .= '<div class="datospiso">';
                    $Html .= '<h2>Calle</h2>';
                    $Html .= '<div class="descripcion">';
                    $Html .=    '<p><i class="fas fa-map-marker-alt"></i> Ubicación</p><br>';
                    $Html .=    '<p><i class="fas fa-eye"></i> Ubicación</p><br>';
                    $Html .= '</div>';
                    $Html .= '<div class="datos">';
                    $Html .=    '<p><i class="fas fa-bed"></i> Habitaciones |</p>';
                    $Html .=    '<p><i class="fas fa-bath"></i> Baños</p>';
                    $Html .= '</div>';
                    $Html .=' </div>
                            </div>';
                    echo $Html;
                }
            }
            ?>
        </div>
    </div>
    <script src="js/scriptventana.js"></script>
    <script>
		function addPisoHabitacion( tipo )
		{
            window.open('registrar-piso-habitacion.php?','_self');
		}
    </script>
</body>