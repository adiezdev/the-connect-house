<?php
//error_reporting( E_ALL );
//ini_set( 'display_errors' , true );
//ini_set( 'display_startup_errors' , true );
/*
    -------------------------------------
    Archivo de: Alejandro Díez
    GitHub: @adilosa95
    Proyecto: the-connect-house
    Nombre del archivo: buscar.php
    -------------------------------------
*/
    require_once(__DIR__."/includes/header.php");
    require_once(__DIR__."/includes/constantes.php");
    //
    //Accedemos a datos
    require_once(__DIR__."/bd/bd_usuario.php" );
	require_once(__DIR__."/bd/bd_pisos.php" );
    require_once(__DIR__."/bd/bd_imagenespiso.php");
    session_start();
    //
    //Configuramos los estilos que necesitamos
    $estilos = array(
        ESTILOS_WIDGETS,
        ESTILOS_MAIN,
        ESTILOS_MENU
    );
    //
    //Generamos la cabecera
    cabecera(TITULO_BUSQUEDA , $estilos ,true);
    //
	//Respuesta del GET
	if( $_GET )
	{
	    //Si alguno de los datos está sin inicializar los incialiazamos
	    if(!empty( $_GET["Pisos"] ))
        {
	        $sPisos = $_GET["Pisos"];
        }
	    else
        {
	        $sPisos = 0;
        }
		if(!empty( $_GET["Habitaciones"] ))
		{
			$sHabitaciones =  $_GET["Habitaciones"];
		}
		else
        {
	        $sHabitaciones = 0;
        }
		if(!empty( $_GET["Precio"] ))
		{
			$sPrecio = $_GET["Precio"];
		}
		else
        {
            $sPrecio = 0;
        }
		if(!empty( $_GET["Ciudad"] ))
		{
			$sCiudad = $_GET["Ciudad"];
		}
		else
        {
            $sCiudad = '';
        }
		if(!empty( $_GET["Buscar"] ))
		{
			$sBuscar = $_GET["Buscar"];
		}
		else
        {
	        $sBuscar = '';
        }
        //
        //Accedemos a la busqueda
        $oDbPisosHabitaciones = new Pisos();
		//Buscamos por filtro
        try
        {
            $aDbPisosHabitaciones = $oDbPisosHabitaciones->buscarPiso( $sPrecio , $sBuscar , $sPisos , $sHabitaciones , $sCiudad );
        }
        catch( ReflectionException $e )
        {
            $e;
        }
	}
	//
    //Comprobamos si la sesión está existe
    if(isset($_SESSION['idUsuario']))
    {
        //
        //Accedemos a la base de datos
        $aDbUsuario = new Usuario();
        //
        //Accedemos a datos del usuario
        $oDatosUsuario = $aDbUsuario->getById($_SESSION['idUsuario']);
    }
?>
<body>
    <!--Menu-->
  <?php require_once(__DIR__ . '/includes/menu.php'); ?>
  <div class="content">
      <div class="contenedor-centro">
        <div class="into-centro busqueda">
            <h2 class="title">Resultados</h2>
            <?php
                //Si el buscador está iniicializado
                if(isset($aDbPisosHabitaciones))
                {
                    //Hacemos un array para la latiitud u longitus
                    $ltlgs = array();
                    //Hacemos otro array para las ciudades de cada uno
                    $ciudades = array();
                    //
                    //Recorremos los datos de la petición
                    foreach ( $aDbPisosHabitaciones as $aDbPisosHabitacion )
                    {
                        //Guardamos la latitud y longitud en un array
                        $ltlgs[] = array( "Latitud" => $aDbPisosHabitacion->Latitud , "Longitud" => $aDbPisosHabitacion->Longitud , "Calle" => $aDbPisosHabitacion->Calle);
                        //Guardamos las ciudades en un array
                        $ciudades[] = array( $aDbPisosHabitacion->Ciudad);
                        //
                        //Formamos las tarjetas
                        $Html  = '<div class="box-mas-visitados" onclick="" >';
                        //
                        //Comprobamos si el usuario del piso/habitación es diferen de la sesión
                        if( $aDbPisosHabitacion->idUsuario != $_SESSION['idUsuario'])
                        {
                            //Si es así mostramos el like
                            $Html .= '<div class="likeit">'.file_get_contents("img/iconos-materiales/like.svg").'</div>';
                        }
                        //
                        //Accedemos a la imagen del piso/habitaciion
                        $aDbImagen = new Imagenes();
                        //Sacamos los datos
                        $ImagenDestacada =  $aDbImagen->getByIdPisoPrimeraFoto( $aDbPisosHabitacion->idPiso );
                        //
                        //Recorremos la respuesta
                        foreach ($ImagenDestacada as $ImagenDestacad)
                        {
                            $Html .= '<img src="'.$ImagenDestacad->Url.'" alt="habitación">';
                        }
                        //Formamos las tarjetas
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
                        $Html .= '</div>';
                        //
                        //Mostramos en pantalla
                        echo $Html;
                    }
                }
            ?>
        </div>
    </div>
      <!--Contenedor derecho mostramos el mapa-->
      <div class="contenedor-derecho mapa">
        <div id="mapid"></div>
      </div>
  </div>
    <!--Footer-->
  <?php  require_once(__DIR__."/includes/footer.php"); ?>
</body>
<!--Scripts-->
<script src="<?php echo get_root_uri() ?>/the-connect-house/js/like.js"></script>
<script src="<?php echo get_root_uri() ?>/the-connect-house/js/menu.js"></script>
<!--Inicializamos a false para no dejar hacer click en el mapa y añadir marca-->
<script>var touch = false;</script>
<script src="<?php echo get_root_uri() ?>/the-connect-house/js/mapa.js"></script>
<script>
    <?php
            //Recorremos el array de latitud longitud
            foreach ($ltlgs as $key=>$ltlg)
            {
                //Creamos una marca con los datos
                echo 'var i'.$key.' = L.marker([  '.$ltlg['Latitud'].' ,  '.$ltlg['Longitud'].' ]).addTo(mymap);';
                echo 'i'.$key.'.bindPopup("'.$ltlg['Calle'].'" ,  {autoClose: false} ).openPopup();';;
            }
    ?>
    //Cogemos la tarjeta del piso
   var tarjetas = $('.box-mas-visitados');
    //Recorremos todos los pisos/habitaciones que se muestran
   tarjetas.each(function (index) {
       //Capturamos la acción de entrar con el  ratón
        $(tarjetas[index]).on( 'mouseenter', function () {
            //
            //console.log($(this).find('#ciudad').text());
            //Buscamos dentro de él, el texto de la ciudad
            if ($(this).find('#ciudad').text() == 'Ponferrada')
            {
                //Mostramos la ciudad en el mapa
                mymap.panTo(['42.550042' , ' -6.598184']);
            }
            else
            {
                //Mostramos la ciudad en el mapa
                mymap.panTo(['42.598287' , '-5.567038']);
            }
        });
       });
</script>
</html>