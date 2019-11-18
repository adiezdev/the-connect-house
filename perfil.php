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
    //
    //Acceso a datos
    require_once(__DIR__."/bd/bd_usuario.php");
    require_once(__DIR__."/bd/bd_pisos.php");
    //
    $a = array(
        "widgets" => ESTILOS_WIDGETS,
        "perfil" => ESTILOS_PERFIL
    );
    //
    //Codificamos los objetos
    $objects = json_decode(json_encode($a), FALSE);
    //
    //Se lo envíamos al metodo
    cabecera(TITULO_INDEX,$objects,false);
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
    $aDbPisosHabitaciones = new PisosHabitaciones();
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
            <h1>Tus pisos y habitaciones</h1>
            <?php
            if(empty($aPisosHabitaciones))
            {

            }else
            {
                foreach ( $aPisosHabitaciones as $aPisoHabitacion)
                {
                    $Html  = '<div class="box-mas-visitados">';
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
</body>