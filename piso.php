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
	$a = array(
		"widgets" => ESTILOS_WIDGETS ,
		"login" => ESTILOS_PISO ,
		"slider" => INCLUD_SLIDE
	);
	$objects = json_decode( json_encode( $a ) , false );
	cabecera( TITULO_LOGIN , $objects , true );
?>
<body>
<?php
	$a = array(
		"uno" => "img/img-inicio.jpg" ,
		"uno2" => "img/img-modelo.jpg"
	);
	$objects = json_decode( json_encode( $a ) , false );
	foreach( $objects as $object )
	{
		echo getCarrusel( $object ) ;
	}
?>
<div class="contenedor-izquierdo">
    <div id="perfil">
        <img id="user" src="img/isset/isset-user.png" alt="">
        <h3>Nombre</h3>
    </div>
    <h2>Precio</h2>
    <button class="button">Hola</button>
</div>
<div class="contenedor-derecho">
    <h1>Calle</h1>
    <div class="caracteristicas">
        <p><i class="fas fa-map-marker-alt"></i> León</p>
        <p><i class="fas fa-bath"></i> Baños</p>
        <p><i class="fas fa-bed"></i> Dormitorios</p>
    </div>
    <br>
    <p>Lorem ipsum dolor sit amet consectetur adipiscing elit dignissim, facilisi netus metus nisl suscipit nec praesent
        scelerisque, justo porttitor fusce duis class id tempus. Mauris interdum orci pretium penatibus sociosqu vivamus
        at posuere et metus pharetra taciti erat, placerat fusce class id massa facilisi dapibus fermentum cursus nullam
        feugiat congue. Pharetra per elementum et feugiat vulputate mattis leo viverra mauris, duis lobortis tellus
        aliquam fusce euismod natoque nisi, sed venenatis ad quam pulvinar dictumst cubilia dui.
        Phasellus lectus eu vel mattis vitae nascetur hendrerit interdum, natoque vehicula euismod varius arcu nam nisi
        montes a, maecenas porta cum dignissim integer felis hac. Non commodo blandit aliquam orci habitant dictumst
        nibh iaculis magna pharetra, quis praesent cursus penatibus nisl magnis odio sociis ac, egestas leo tempus
        mattis donec montes varius convallis fringilla. Faucibus duis facilisi tempus blandit at venenatis vivamus
        elementum suscipit, taciti mus eget aliquet ultrices rhoncus orci proin non ullamcorper, cum odio iaculis
        laoreet dignissim per vitae sed.</p>
    <br>
    <h3>Comodidades</h3>
</div>
</body>
<script src="js/slider.js"></script>

</html>