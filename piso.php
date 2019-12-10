<?php
//error_reporting( E_ALL );
//ini_set( 'display_errors' , true );
//ini_set( 'display_startup_errors' , true );
/*
    -------------------------------------
    Archivo de: Alejandro Díez
    GitHub: @adilosa95
    Proyecto: the-connect-house
    Nombre del archivo: piso.php
    -------------------------------------
*/
	require_once(__DIR__."/includes/header.php" );
	require_once(__DIR__."/includes/constantes.php" );
	require_once(__DIR__."/includes/carrusel-de-img.php");
	require_once(__DIR__."/includes/sesion.php");
    //
    //Acceso a datos
    require_once(__DIR__."/bd/bd_usuario.php");
    require_once(__DIR__."/bd/bd_pisos.php");
    require_once(__DIR__."/bd/bd_imagenespiso.php");
    require_once(__DIR__."/bd/bd_secciones.php");
    //
    //Configuramos los estilos que necesitamos
    $estilos = array(
		 ESTILOS_WIDGETS ,
		 ESTILOS_MAIN ,
		 INCLUD_SLIDE
	);
    //
    //Generamos la cabecera
	cabecera( TITULO_LOGIN , $estilos , true );
    if( $_GET )
    {
        //Decodificamos la URL
        $urldecode = base64_decode( $_SERVER['REQUEST_URI'] );
        //Sacar el valor de la ID
        $get = explode( 'idPiso=', $urldecode );
        $idPisoHabitacion = $get[1];
    }
    else
    {
        //
        //Si intentamos entrar sin una petición get nos redirecciona
        header( "location:/the-connect-house/perfil.php" );
        return;
    }
    //
    //Accedemos a los datos del piso o Habitacion
    $oDbPisoHabitacion = new Pisos();
    $aDatosPisosHabitaciones  = $oDbPisoHabitacion->getById($idPisoHabitacion);
    //
    //Accedemos al 1 que son las comodidades
    $odbComodidades = new Secciones(1);
    //Sacamos todos los registros
    $oComodidades = $odbComodidades->getById($idPisoHabitacion);
    //Sacamos las normas
    $odbNormas = new Secciones(2);
    //Sacamos todos los registros
    $oNormas = $odbNormas->getById($idPisoHabitacion);
    //
    //Sacamos el perfil del Vendedor

?>
<style>
    /*Para maquetar las caracteristicas del piso o habitacion*/
    .contenedor-centro
    {
        margin: 0% 10% 0% 36%;
    }
</style>
<script src="<?php echo get_root_uri() ?>/the-connect-house/js/mapa.js"></script>
<body>
<?php
    //
    //Formamos un array con las imagenes del piso
	$oDbImagenes = new Imagenes();
	$aImagenesPiso = $oDbImagenes->getByIdPiso($idPisoHabitacion);
	//
    //Pasamos las imagenes para el carrusel
	foreach( $aImagenesPiso as $aImagenePiso )
	{
		 getCarrusel( $aImagenePiso->Url ) ;
	}
?>
<div class="atras" onclick="javascript:window.history.back()">
    <div class="flecha">&#8592; Atrás</div>
</div>
    <div class="content">
        <div class="contenedor-izquierdo">
            <div id="perfil">
                <img id="user" src="img/isset/isset-user.png" alt="">
                <h3>Nombre</h3>
                <h2>Precio</h2>
                <button class="button">Hola</button>
            </div>
        </div>
        <div class="contenedor-centro">
            <div class="into-centro">
                <?php
                foreach ( $aDatosPisosHabitaciones as $aDatosPisosHabitacion) {
                    $Html = ' <h1>'.$aDatosPisosHabitacion->Calle.'</h1>';
                    $Html .= '<div class="caracteristicas">';
                    $Html .= '<p><i class="fas fa-map-marker-alt"></i> '.$aDatosPisosHabitacion->Calle.','.$aDatosPisosHabitacion->Ciudad.'</p>';
                    $Html .=  '<p><i class="fas fa-bath"></i>  '.$aDatosPisosHabitacion->NBanos.' Baños</p>';
                    $Html .=  '<p><i class="fas fa-bed"></i> '.$aDatosPisosHabitacion->NHabitaciones.'  Habitaciones</p>';
                    $Html .= '</div>';
                    $Html .= '<br>';
                    $Html .= '<h3 class="title">Descripción</h3>';
                    $Html .= '<p>'.$aDatosPisosHabitacion->Descripcion.'</p>';
                    if($oComodidades != null)
                    {
                        $Html .= '<h3 class="title">Comodidades</h3>';
                        $Html .= '<div class="comodidad">';
                        foreach ($oComodidades as $oComodidad)
                        {
                            $Html .= '<div class="comodidades">';
                            $Html .= '<img src="'.$oComodidad->Imagen.'">';
                            $Html .= '<p>'.$oComodidad->Nombre.'</p>';
                            $Html .= '</div>';
                        }
                        $Html .= '</div>';
                    }
                    if($oNormas != null)
                    {
                        $Html .= '<h3 class="title">Normas</h3>';
                        $Html .= '<div class="norma">';
                        foreach ($oNormas as $oNorma)
                        {
                            $Html .= '<div class="normas">';
                            $Html .= '<img src="'.$oNorma->Imagen.'">';
                            $Html .= '<p>'.$oNorma->Nombre.'</p>';
                            $Html .= '</div>';
                        }
                        $Html .= '</div>';
                    }
                    $Html .= '<div id="mapid"></div>';
                    $Html .= '<script>
                            //Llamamos al mapa
                                llamarMapa(false , false , false  , '.$aDatosPisosHabitacion->Latitud.' , '.$aDatosPisosHabitacion->Longitud.' );
                              </script>';
                    echo $Html;
                }
                ?>

            </div>
        </div>
    </div>
<?php  require_once(__DIR__."/includes/footer.php"); ?>
</body>
<script src="<?php echo get_root_uri() ?>/the-connect-house/js/slider.js"></script>
<script>
    //Scroll del vendedOr
    $(document).scroll(function()
    {
        //Cuando el contenedor llega al footer queda quieto para no sobrepasarlo
        if($('#perfil').offset().top + $('#perfil').height() > $('footer').offset().top )
        {
            $('#perfil').css('position', 'absolute');
            $('#perfil').css('left', '110px');
            $('#perfil').css('top', '110%');
        }
        //Si la altura de la pantalla mas el scroll es menos que el footer el perfil y el presio se moverá
        if($(document).scrollTop() + window.innerHeight < $('footer').offset().top)
        {
            $('#perfil').css('position', 'fixed');
            $('#perfil').css('left', '110px');
            $('#perfil').css('top', '');
        }
    });
</script>
</html>