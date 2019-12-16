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
    require_once(__DIR__."/includes/tarjetas.php");
    //
    //Accedemos a datos
    require_once(__DIR__."/bd/bd_usuario.php" );
	require_once(__DIR__."/bd/bd_pisos.php" );
    require_once(__DIR__."/bd/bd_favoritos.php" );
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
	//Respuesta del GET si no la hay aparecerá un mensaje de que no se ha hecho busqueda
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
            $aDbPisosHabitacione = $oDbPisosHabitaciones->buscarPiso( $sPrecio , $sBuscar , $sPisos , $sHabitaciones , $sCiudad );
        }
        catch( ReflectionException $e )
        {
            $e;
        }
	}
?>
<body>
    <!--Menu-->
  <?php require_once(__DIR__ . '/includes/menu.php'); ?>
  <div class="content">
      <div class="contenedor-centro">
        <div class="into-centro busqueda">
            <!--Buscador-->
            <div class="buscador2">
                <form action="buscar.php" method="get">
                    <input type="checkbox" name="Pisos" id="piso" value="1" >
                    <label for="">Pisos</label>
                    <input type="checkbox" name="Habitaciones" id="piso" value="2" >
                    <label for="">Habitaciones</label>
                    <div class="slidercontenedor">
                        <h3>Precio: <span id="preciospan">0</span> €</h3>
                        <input type="range" name="Precio" id="slider" min="0" max="1000" value="0" step="10">
                    </div>
                    <select name="Ciudad" id="selector" >
                        <option value="0">¿Qué ciudad?</option>
                        <option value="León">León</option>
                        <option value="Ponferrada">Ponferrada</option>
                    </select>
                    <input type="search" name="Buscar" id="search" placeholder="Busca la calle que deseas">
                    <button class="button">Buscar <img src="img/iconos-materiales/lupa.png" alt="Buscar"></button>
                </form>
            </div>
            <h2 class="title">Resultados</h2>
            <?php
                //
                //Si el buscador está iniicializado
                if(isset($aDbPisosHabitacione))
                {
                    if(!empty($aDbPisosHabitacione))
                    {
                        //Hacemos un array para la latiitud u longitus
                        $ltlgs = array();
                        //Hacemos otro array para las ciudades de cada uno
                        $ciudades = array();
                        getPisosHabitacionesHorizontal($aDbPisosHabitacione , $ciudades , $ltlgs);
                        //
                        //Como dentro de la funcion no podemos recorremos para añadir a los array las ciudades y las latitudes y longitudes
                        foreach ($aDbPisosHabitacione as $aDbPisosHabitacion)
                        {
                            $ltlgs[] = array("Latitud" => $aDbPisosHabitacion->Latitud, "Longitud" => $aDbPisosHabitacion->Longitud, "Calle" => $aDbPisosHabitacion->Calle);
                            $ciudades[] = array($aDbPisosHabitacion->Ciudad);
                        }
                    }
                    else
                    {
                        //Si no lo está aparecerá éste mensaje
                        $Html = '<h2>No se ha encontrado ningun resultado</h2>';
                        echo $Html;
                    }
                }
                else
                {
                    //Si no lo está aparecerá éste mensaje
                    $Html = '<h2>No se ha encontrado ningun resultado</h2>';
                    echo $Html;
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
                mymap.panTo(['42.598287' , '-5.567038']);
            }
        });
       });
</script>
</html>