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
    session_start();
    require_once(__DIR__."/includes/sesion.php");
    //
    //Respuesta del GET
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
        header( "location:/perfil.php" );
        return;
    }
	require_once(__DIR__."/includes/header.php" );
    require_once(__DIR__."/includes/crearventana.php" );
	require_once(__DIR__."/includes/constantes.php" );
	require_once(__DIR__."/includes/carrusel-de-img.php");
    //
    //Acceso a datos
    require_once(__DIR__."/bd/bd_usuario.php");
    require_once(__DIR__."/bd/bd_pisos.php");
    require_once(__DIR__."/bd/bd_imagenespiso.php");
    require_once(__DIR__."/bd/bd_secciones.php");
	require_once(__DIR__."/bd/bd_ocupado.php");
    require_once(__DIR__."/bd/bd_favoritos.php");
    require_once(__DIR__."/bd/bd_telefonos.php");
	//
    //Configuramos los estilos que necesitamos
    $estilos = array(
		 ESTILOS_WIDGETS ,
		 ESTILOS_MAIN ,
		 INCLUD_SLIDE,
        ESTILOS_VENTANA
	);
    //
    //Accedemos a los datos del piso o Habitacion
    $oDbPisoHabitacion = new Pisos();
    $aDatosPisosHabitaciones  = $oDbPisoHabitacion->getById($idPisoHabitacion);
    //
    //Generamos la cabecera
	cabecera( $aDatosPisosHabitaciones[0]->Calle , $estilos , true );
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
    $oDbUsuarios = new Usuario();
    //Sacamos los datos del usuario logue
    $aDBUser = $oDbUsuarios->getById( $_SESSION['idUsuario']);
    //
    $oDbTelefono = new Telefonos();
    $aDBUsertel =  $oDbTelefono->getByIdUsuario( $_SESSION['idUsuario'] );
?>
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
    <div class="content">
        <div class="atras" onclick="window.history.back()">
            <div class="flecha">&#8592; Atrás</div>
        </div>
        <?php
        //Incializamos estas varbles, necesitaremos la latitud y longitud fuera del foreach, para darselo al mapa
                $lt = 0.00;
                $lg = 0.00;
                foreach ( $aDatosPisosHabitaciones as $aDatosPisosHabitacion)
                {
                    //Si la idAsignada del piso/habitacion es diferente a la de la sessiión entonces dejar hacer like
                    if($aDatosPisosHabitaciones[0]->idUsuario != $_SESSION['idUsuario'])
                    {
                        $oDbFavoritos = new Favoritos();
                        $aDbFavoritos = $oDbFavoritos->getById( $_SESSION['idUsuario']);
                        //
                        $check = '';
                        foreach ( $aDbFavoritos as $aDbFavorito )
                        {
                            if($aDbFavorito->idPiso == $aDatosPisosHabitacion->idPiso )
                            {
                                $check = 'checked';
                            }
                        }
                        //
                        //Si es así mostramos el like
                        $Html1 = '<div class="likeit"><label><input type="checkbox" class="corazon" value="'.$aDatosPisosHabitacion->idPiso.'" '.$check.' style="display:none">' . file_get_contents("img/iconos-materiales/like.svg") . '</label></div>';
                        echo $Html1;
                    }
                    //Asignamos datos
                    $lt = $aDatosPisosHabitacion->Latitud;
                    $lg = $aDatosPisosHabitacion->Longitud;
                    //Accedemos al usuario del piso
                    $aDbUsuarios = $oDbUsuarios->getById( $aDatosPisosHabitacion->idUsuario );
                    //
                    //Recorremos sus datos
                    foreach( $aDbUsuarios as $aDbUsuario)
                    {
	                    $Html2 = ' <div class="contenedor-izquierdo">';
	                    $Html2 .= ' <div class="into-izquierdo">';
	                    $Html2 .=    '<div id="perfil">';
	                    //Click en el perfil
	                    $Html2 .=        '<div style="cursor: pointer;" onclick="window.open(\'/perfil.php?correo='.$aDbUsuario->Correo.'\', \'_self\');">';
	                    //Datos del usuario que pone en alquiker
	                    $Html2 .=        '<img class="user" src="'.$aDbUsuario->Imgperfil.'" alt="">';
	                    $Html2 .=        '<h3>'.$aDbUsuario->Nombre.'</h3>';
	                    $Html2 .=        '<h2>'.$aDatosPisosHabitacion->Precio.' €/Mes</h2>';
	                    //
	                    //Sacamos el telelfono del usuario
	                    $aDbTelefonos = $oDbTelefono->getByIdUsuario($aDbUsuario->idUsuario );
	                    //
                        foreach ( $aDbTelefonos as $key=>$aDbTelefono)
                        {
                            $Html2 .= '<h2>Num '.($key+1).': '.$aDbTelefono->Numero.'</h2>';
	                    }
                        $Html2 .=     '</div>';

	                    //
                        //Si conincide el usuario podemos editar piso
	                    if( $aDbUsuario->idUsuario != $_SESSION['idUsuario'])
                        {
                            $Html2 .='<button class="button" id="buttonVentana">Me interesa</button>';
                            //
                            //Array botones que aparecen en la ventana
                            $btones = array(
                                "Enviar Correo",
                            );
                            $btonesfuncion = array(
                                "enviarcorreo()",
                            );
                            //
                            //Generamos la ventana
                            getVentana( '¿Te interesa? Díselo tú mismo' , $btones , $btonesfuncion , true);
                        }
	                    else
                        {
                            $Html2 .= '<div class="editar-piso"  onclick="window.open(\'/piso-habitacion/editar-piso-habitacion.php?idPiso='.$aDatosPisosHabitacion->idPiso.'&Tipo='.$aDatosPisosHabitacion->Tipo.'\', \'_self\');" ><i class="fas fa-pen"></i> Editar Piso</div>';
                        }
                        $Html2 .='</div>';
	                    $Html2 .=  '</div>';
	                    $Html2 .= '</div>';
	                    echo $Html2;
                    }
	                //
                    //Datelles del piso
                       $Html = '<div class="contenedor-centro">';
                        $Html .= '<div class="into-centro pisodescripcion">';
                        $Html .= '<h1>'.$aDatosPisosHabitacion->Calle.'</h1>';
                        $Html .= '<p><i class="fas fa-map-marker-alt"></i> '.$aDatosPisosHabitacion->Calle.','.$aDatosPisosHabitacion->Ciudad.'</p><br>';
                        $Html .= '<hr>';
                        $Html .= '<div class="caracteristicas">';
                        $Html .= '<h3> Características </h3>';
                        $Html .= '<p><i class="fas fa-bath"></i>  '.$aDatosPisosHabitacion->NBanos.' Baños</p>';
                        $Html .= '<p><i class="fas fa-bed"></i> '.$aDatosPisosHabitacion->NHabitaciones.'  Habitaciones</p>';
                        //
                        //Si es una habitacion
                        if( $aDatosPisosHabitacion->Tipo == 2)
                        {
                            //Accedemos a lagente que tiene en el piso
                            $odbOcupado = new Ocupado();
                            $aOcupados = $odbOcupado->getById( $aDatosPisosHabitacion->idPiso );
                            foreach( $aOcupados as $aOcupado)
                            {
                                $sSexo = '';
                                if( $aOcupado->Sexo == 'M' )
                                {
                                    $sSexo = 'Chicos';
                                }
                                else
                                {
                                    $sSexo = 'Chicas';
                                }
                                //
                                //Muestra la gente
                                $Html .= '<p><i class="fas fa-child"></i>'.$sSexo.' : '.$aOcupado->Num.'</p>';
                            }
                        }
                        //
                        $Html .= '</div>';
                        $Html .= '<br>';
                        $Html .= '<hr>';
                        $Html .= '<h3 class="title">Descripción</h3>';
                        $Html .= '<p>'.$aDatosPisosHabitacion->Descripcion.'</p><br>';
                        $Html .= '<hr>';
                        //
                        //Si hay comodidades asignadas
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
                        //
                        //Si hay normas asignadas
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
                        //
                        //Asignamos el mapa
                        $Html .= '<div id="mapid"></div>';
                        //
                        $Html .= '</div>';
	                $Html .= '</div>';
	                //
                    //Mostramos en pantalla los datos
                    echo $Html;
                }
                ?>
    </div>
<?php  require_once(__DIR__."/includes/footer.php"); ?>
</body>
<!-- Script necesarios -->
<script src="<?php echo get_root_uri() ?>/js/slider.js"></script>
<script src="<?php echo get_root_uri() ?>/js/like.js"></script>
<script src="<?php echo get_root_uri() ?>/js/crearventana.js"></script>
<script>var touch = false;</script>
<script src="<?php echo get_root_uri() ?>/js/mapa.js"></script>
<script>
    //Quitamos el scroll del mapa
    mymap.scrollWheelZoom.disable();
    //Quitamos el doble click del mapa
    mymap.doubleClickZoom.disable();
    //Quitamos el arrastrar del mapa
    mymap.dragging.disable();
    //Visualizamos esas coordenadas en el mapa
    mymap.panTo([<?php echo $lt ?> , <?php echo $lg ?>]);
    //Ponemos una marca en el mapa con las coordenadas
    L.marker([<?php echo $lt ?> , <?php echo $lg ?>]).addTo(mymap);
    //
    //Función para enviar correo
    function enviarcorreo() {
        var descripciondada = $('#descripcion').val();
        var maildelcasero = '<?php echo $aDbUsuarios[0]->Correo ?>';
        var usuarioinquilino = '<?php echo $aDBUser[0]->Correo ?>';
        var telefonos = '<?php echo $aDBUsertel[0]->Numero ?>';
        //
        //Formamos el JSON
        var oDatosJson = {descripcion: descripciondada , mail: maildelcasero , telefono: telefonos , usuario: usuarioinquilino }
        //Enviamos los ddatos para que sean enviados por email
        $.ajax({
            url: '/mail/enviarpeticion.php',
            type: 'POST',
            data: JSON.stringify(oDatosJson)
        })
            .done(function(oJson)
            {
                console.log(oJson);
                var oRespuesta = JSON.parse(oJson);
                if (oRespuesta.Estado == "OK")
                {
                    //Cerramos la ventana
                    $('#miVentana').css('display', 'none');
                    //Limipiamos el text area
                    $('#descripcion').val('');
                    //
                    $('#buttonVentana').notify('Enviado. Se pondrá en contacto contido', 'info')
                } else {
                    //alert(oRespuesta.Mensaje);
                    $('#buttonVentana').notify('Ha sucedido un error', 'error')
                }
            });
    }
</script>
</html>