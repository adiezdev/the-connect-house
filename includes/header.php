<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php
    /**
     * Función para construir la cabecera
     *
     * @param string $stitulo
     * @param array $sCss
     * @param boolean $bMapa
     *
     */
    function cabecera($stitulo, $sCss, $bMapa)
    {
        $m_cGetTheConnect = get_root_uri();
        $cabecera = '<title>'.$stitulo.'</title>';
        foreach( $sCss as $css)
        {
            $cabecera .= '<link rel="stylesheet" href="'.$m_cGetTheConnect.'css/'.$css.'.css">';
        }
        //Si le pasamos un true agregamos las dependencia del mapa
        if($bMapa == true)
        {
            $cabecera .= '<link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
            integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
            crossorigin=""/>';
            $cabecera .= '<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
            integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
            crossorigin=""></script>';
        }
        echo $cabecera;
    }
    ?>
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <?php
	    /**
         * Funcion que devuelve la URL del server
	     * @return string
	     */
	    function get_root_uri()
	    {
		    $protocol = isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] !== 'off' ? 'https://' : 'http://';
		    return $protocol.$_SERVER['HTTP_HOST'];
	    }
    ?>
</head>
