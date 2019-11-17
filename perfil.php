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
    require_once(__DIR__."/bd/bd_usuario.php");
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
    $aDbUsuario = new Usuario();
    $oDatosUsuario = '';
    $idUsuario = '';
    if(isset($_SESSION['idUsuario']) || $_SESSION['idUsuario'] > 0)
    {
        $oDatosUsuario = $aDbUsuario->getById($_SESSION['idUsuario']);
    }
    elseif(isset($_SESSION['correo']) || $_SESSION['correo'] != '')
    {
        $oDatosUsuario = $aDbUsuario->getByCorreo($_SESSION['correo']);
        $_SESSION['correo'] = '';
    }
    //
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
            <div class="box-mas-visitados">
                <img src="img/img-modelo.jpg" alt="habitación" class="habitacion">
                <div class="datospiso">
                    <h2>Calle</h2>
                    <div class="descripcion">
                        <p><i class="fas fa-map-marker-alt"></i> Ubicación</p><br>
                        <p><i class="fas fa-eye"></i> Ubicación</p><br>
                    </div>
                    <div class="datos">
                        <p><i class="fas fa-bed"></i> Habitaciones |</p>
                        <p><i class="fas fa-bath"></i> Baños</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>