<?php
    //error_reporting( E_ALL );
    //ini_set( 'display_errors' , true );
    //ini_set( 'display_startup_errors' , true );
    /*
        -------------------------------------
        Archivo de: Alejandro Díez
        GitHub: @adilosa95
        Proyecto: the-connect-house
        Nombre del archivo: tarjetas.php
        -------------------------------------
        Archivo que llama a funciones para mostrar los pisos de un formato u otro
    */
    require_once(__DIR__."/../bd/bd_imagenespiso.php");
    require_once(__DIR__."/../bd/bd_favoritos.php");
    /**
     * Función que devuelve una tarjeta con el array de pisos que le pasamos
     *
     * @param $aDbPisosHabitaciones
     * @param array $arrayciudades //Si necesitamos guardar Ciudades para el mapa
     * @param array $arrayLtLg //Latitud y longitud
     */
    function getPisosHabitacionesHorizontal($aDbPisosHabitaciones  )
    {
        //Si si hay pisos habitaciones los recorremos
        foreach ( $aDbPisosHabitaciones as $aDbPisosHabitacion )
        {
            //Formamos la tarjeta
            $Html  = '<div class="box-mas-visitados">';
            //
            //Si la idAsignada del piso/habitacion es diferente a la de la sessiión entonces dejar hacer like
            if(isset($_SESSION['idUsuario']))
            {
                if($aDbPisosHabitacion->idUsuario != $_SESSION['idUsuario'])
                {
                    $oDbFavoritos = new Favoritos();
                    $aDbFavoritos = $oDbFavoritos->getById( $_SESSION['idUsuario']);
                    //
                    $check = '';
                    foreach ( $aDbFavoritos as $aDbFavorito )
                    {
                        if($aDbFavorito->idPiso == $aDbPisosHabitacion->idPiso )
                        {
                            $check = 'checked';
                        }
                    }
                    //
                    //Si es así mostramos el like
                    $Html .= '<div class="likeit derecha"><label><input type="checkbox" class="corazon" value="'.$aDbPisosHabitacion->idPiso.'" '.$check.' style="display:none">' . file_get_contents("img/iconos-materiales/like.svg") . '</label></div>';
                }
            }
            //
            //Div de datos
            $Html .= '<div onclick="window.open(\'/piso.php?'.base64_encode('idPiso='.$aDbPisosHabitacion->idPiso).'\', \'_self\');" >';
                //
                //Accedemos a la imagen del piso
                $aDbImagen = new Imagenes();
                $ImagenDestacada =  $aDbImagen->getByIdPisoPrimeraFoto( $aDbPisosHabitacion->idPiso );
                if($ImagenDestacada == null)
                {
                    $Html .= '<img src="/img/img-modelo.jpg" alt="habitación">';
                }
                else
                {
                    //
                    //Recorremos la imagen
                    foreach ($ImagenDestacada as $ImagenDestacad)
                    {
                        $Html .= '<img src="'.$ImagenDestacad->Url.'" alt="habitación">';
                    }
                }
                //
                //Contenido a mostrar en la tarjeta
                $Html .= '<div class="contenido">';
                    $Html .= '<h2 >'.$aDbPisosHabitacion->Calle.'</h2>';
                    //Caractericitcas
                    $Html .= '<div class="descripcion">';
                        $Html .= '<p><i class="fas fa-map-marker-alt"></i><span id="ciudad">'.$aDbPisosHabitacion->Ciudad.'</span> , '.$aDbPisosHabitacion->Calle.'</p><br>';
                        $Html .= '<p id="descripcionPH">'.$aDbPisosHabitacion->Descripcion.'</p><br>';
                        $Html .= '</div>';
                        //Datos del piso/habitacion
                        $Html .= '<div class="datos">';
                        $Html .= '<p><i class="fas fa-bed"></i> Habitaciones '.$aDbPisosHabitacion->NHabitaciones.' |</p>';
                        $Html .= '<p><i class="fas fa-bath"></i> Baños '.$aDbPisosHabitacion->NBanos.'</p>';
                    $Html .= '</div>';
                $Html .= '</div>';
                $Html .= '<div class="precio">'.$aDbPisosHabitacion->Precio.' €/mes</div>';
                $Html .= '</div>';
            $Html .= '</div>';
            //
            //Botón editar piso/habitación
            if(isset($_SESSION['idUsuario']))
            {
                if(  $aDbPisosHabitacion->idUsuario ==$_SESSION['idUsuario'] )
                {
                    $Html .= '<div class="editar-piso" onclick="window.open(\'/piso-habitacion/editar-piso-habitacion.php?idPiso='.$aDbPisosHabitacion->idPiso.'&Tipo='.$aDbPisosHabitacion->Tipo.'\', \'_self\');" ><i class="fas fa-pen"></i> Editar</div>';

                }
            }
            //Mostramos el resultado
            echo $Html;
        }
    }
    /**
     * Función que devuelve una tarjeta de pisos de manera vertical
     *
     * @param $aDbPisosHabitaciones
     */
    function getPisosHabitacionesVertical($aDbPisosHabitaciones)
    {
        foreach( $aDbPisosHabitaciones as $aDbPisosHabitacion)
        {
            $Html  = '<div class="box-pisos-habitacones"  onclick="window.open(\'/piso.php?'.base64_encode('idPiso='.$aDbPisosHabitacion->idPiso).'\', \'_self\');" >';
            //
            //Accedemos a la imagen del piso
            $aDbImagen = new Imagenes();
            $ImagenDestacada =  $aDbImagen->getByIdPisoPrimeraFoto( $aDbPisosHabitacion->idPiso );
            //
            if($ImagenDestacada == null)
            {
                $Html .= '<img src="/img/img-modelo.jpg" alt="habitación">';
            }
            else
            {
                //
                //Recorremos la imagen
                foreach ($ImagenDestacada as $ImagenDestacad)
                {
                    $Html .= '<img src="'.$ImagenDestacad->Url.'" alt="habitación">';
                }
            }
            //
            $Html .= '<div class="descripcion">';
            $Html .= '<h3>'.$aDbPisosHabitacion->Calle.'</h3>';
            $Html .= '<p><i class="fas fa-map-marker-alt"></i>'.$aDbPisosHabitacion->Ciudad.'</p>';
            $Html .= '<div class="precio">'.$aDbPisosHabitacion->Precio.' €/mes</div>';
            $Html .= '</div>';
            $Html .= '<button class="button">Me interesa</button>';
            $Html .= '</div>';
            //
            //Lo mostramos
            echo $Html;
        }
    }