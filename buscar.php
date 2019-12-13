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
	//Respuesta del GET
	if( $_GET )
	{
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
	}
    //Sacar los datos del usuario
    $aDbUsuario = new Usuario();
    if(isset($_SESSION['idUsuario']))
    {
        $oDatosUsuario = $aDbUsuario->getById($_SESSION['idUsuario']);
    }
    //
    //Accedemos a la busqueda
    $oDbPisosHabitaciones = new Pisos();
	try
	{
		$aDbPisosHabitaciones = $oDbPisosHabitaciones->buscarPiso( $sPrecio , $sBuscar , $sPisos , $sHabitaciones , $sCiudad );
	}
	catch( ReflectionException $e )
	{
	     $e;
	}
?>
<body>
  <?php require_once(__DIR__ . '/includes/menu.php'); ?>
  <div class="content">
      <div class="contenedor-centro">
        <div class="into-centro busqueda">
            <h2 class="title">Resultados</h2>
            <?php
                if($aDbPisosHabitaciones != null)
                {
                    $ltlgs = array();
                    $ciudades = array();
                    foreach ( $aDbPisosHabitaciones as $aDbPisosHabitacion )
                    {
                        //Guardamos la latitud y longitud en un array
                        $ltlgs[] = array( "Latitud" => $aDbPisosHabitacion->Latitud , "Longitud" => $aDbPisosHabitacion->Longitud);
                        $ciudades[] = array( $aDbPisosHabitacion->Ciudad);
                        $Html  = '<div class="box-mas-visitados" id="buttonVentana" onclick="" >';
                        $Html .= '<div class="likeit">'.file_get_contents("img/iconos-materiales/like.svg").'</div>';
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
                        echo $Html;
                    }
                }
            ?>
        </div>
    </div>
      <div class="contenedor-derecho mapa">
        <div id="mapid"></div>
      </div>
  </div>
  <?php  require_once(__DIR__."/includes/footer.php"); ?>
</body>
<script src="<?php echo get_root_uri() ?>/the-connect-house/js/like.js"></script>
<script src="<?php echo get_root_uri() ?>/the-connect-house/js/menu.js"></script>
<script>var touch = false;</script>
<script src="<?php echo get_root_uri() ?>/the-connect-house/js/mapa.js"></script>
<script>
    <?php
            //Si hacemos filtro por ciudad
            if(isset($_GET["Ciudad"]) == 'León'  )
            {
                echo "mymap.panTo(['42.598287' , '-5.567038']);";
            }
            else
            {
                echo "mymap.panTo(['42.550042' , ' -6.598184']);";
            }
            //
            foreach ($ltlgs as $ltlg)
            {
                echo 'L.marker([  '.$ltlg['Latitud'].' ,  '.$ltlg['Longitud'].' ]).addTo(mymap).bindPopup("");';
            }
    ?>
   var tarjetas = $('.box-mas-visitados');

   tarjetas.each(function (index) {
        $(tarjetas[index]).on( 'mouseenter', function () {
            console.log($(this).find('#ciudad').text());

            if ($(this).find('#ciudad').text() == 'Ponferrada')
            {
                mymap.panTo(['42.550042' , ' -6.598184']);
            }
            else
            {
                mymap.panTo(['42.598287' , '-5.567038']);
            }
        });
       });
</script>
</html>