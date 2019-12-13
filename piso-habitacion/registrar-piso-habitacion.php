<?php
error_reporting( E_ALL );
ini_set( 'display_errors' , true );
ini_set( 'display_startup_errors' , true );
/*
    -------------------------------------
    Archivo de: Alejandro Díez
    GitHub: @adilosa95
    Proyecto: the-connect-house
    Nombre del archivo: registrar-piso-habitacion.php
    -------------------------------------
*/
    require_once(__DIR__ . "/../includes/header.php");
    require_once(__DIR__ . "/../includes/constantes.php");
    require_once(__DIR__ . "/../includes/sesion.php");
	//
	//Acceso a datos
    require_once(__DIR__ . "/../bd/bd_pisos.php");
    require_once(__DIR__ . "/../bd/bd_secciones.php");
    //
    //Configuramos los estilos que necesitamos
    $estilos = array(
        ESTILOS_WIDGETS ,
        ESTILOS_REGISTRAR_PISO ,
        INCLUD_SLIDE
    );
    //
    //Lo cogemos el tipo que vamos añadir
	$titulo = '';
    if($_GET)
    {
        $nTipo = $_GET['Tipo'];
    }
    //
    //Titulo dependiendo de lo que sea
    if( $nTipo == 1)
    {
        $titulo = 'Y el piso ¿Cómo es?';
    }
    else if($nTipo == 2)
    {
        $titulo = 'Y la habitación ¿Cómo es? ';
    }
    else //Sino está inicializamo vuelve al perfil
    {
        header( "location:/the-connect-house/perfil.php" );
        return;
    }
    //
    //Generamos la cabecera
    cabecera( $titulo , $estilos , true );
    //
    //Accedemos al 1 que son las comodidades
    $odbComodidades = new Secciones(1);
    //Sacamos todos los registros
    $oComodidades = $odbComodidades->getAll();
    //Sacamos las normas
    $odbComodidades = new Secciones(2);
	//Sacamos todos los registros
    $oNormas = $odbComodidades->getAll();
?>
<body>
    <div class="content">
        <h1 class="title" style="text-align: center"><?php echo $titulo; ?></h1><br>
        <div id="todassecciones"></div>
        <form method="post" >
            <input type="hidden" value="<?php echo $nTipo ?>" id="IdTipo">
            <!--Seccion1 -->
            <?php include("includes/seccion-1.php"); ?>
            <!--Seccion2-->
            <?php include("includes/seccion-2.php"); ?>
            <!--Seccion3-->
            <?php include("includes/seccion-3.php"); ?>
            <!--Seccion4-->
            <?php include("includes/seccion-4.php"); ?>
            <!--Seccion5-->
            <?php include("includes/seccion-5.php"); ?>
            <!--Guardemos-->
            <div class="guardardatos">
                <input type="button"  class="button" value="Guardar"  onclick="validarDatos()">
                <input type="button"  class="button"  value="Cancelar" onclick="window.history.back()" >
            </div>
        </form>
    </div>
    <?php require_once(__DIR__ . "/../includes/footer.php"); ?>
</body>
<!-- Scripts necesarios -->
<script>var touch = true;</script>
<script src="<?php echo get_root_uri() ?>/the-connect-house/js/mapa.js"></script>
<script src="<?php echo get_root_uri() ?>/the-connect-house/piso-habitacion/js/precarga-imagenes.js"></script>
<script src="<?php echo get_root_uri() ?>/the-connect-house/js/slider-secciones.js"></script>
<script src="<?php echo get_root_uri() ?>/the-connect-house/piso-habitacion/js/validar-piso-habitacion.js"></script>
<script>
    $(document).ready(function(){
        //
        //FUNCIÓN PARA MOSTRAR LOS CARACTERES DE LA DESCRIPCIÓN
        //
        //Máixmo de caracteres en la descripción
        var maximo = 600;
        //Si detecta el teclado
        $('#descripcion').keyup(function()
        {
            //Congemos de la descipcion la longitud del valor
            var caracteres = $(this).val().length;
            //se lo restamos al maximo
            var restantes = maximo - caracteres;
            //lo mostramos
            $('#contador').html(restantes);
        });
        //
        // FUNCIÓN PARA SELECCIONAR COMODIDADES Y NORMAS
        //
        //Entramos al label checkeable de las comodidades
        $('.checkeable').change( ':checked' , function ()
        {
        	//
            //Buscamos dentro del label la imagem
            var idimg =  $(this).find('#cimagen');
            //Sacamos la url de la imagen
            var imgsrc  = idimg.attr('src');
            var imgsrcrem = '';
            //
            //Comprueba si está quecheckeado
            if ( $(this).find('.comodidad').is(":checked"))
            {
            	//
                //Si lo está cambiamos la imagen
                imgsrcrem = imgsrc.replace("808080", "000000");
                idimg.attr('src', imgsrcrem );
            }
            else if ( $(this).find('.norma').is(":checked"))
            {
            	//
                //Si lo está cambiamos la imagen
                imgsrcrem = imgsrc.replace("808080", "000000");
                idimg.attr('src', imgsrcrem );
            }
            else //Revertimos el check
            {
            	//
                //Si revertimos el check mostramos la imagen anterios
                imgsrcrem = imgsrc.replace("000000", "808080");
                idimg.attr('src', imgsrcrem );
            }
        });
        //
        //FUNCIÓN AL SELECCIONAR UNA CIUDAD QUE APAREZCA EN EL MAPA
        //DEPENDIENDO DE LA ELEGIDA EN EL SELECTOR
        $( "select" ).change(function() {
            //
            //Capturamos cual está seleccionado
            var seleccinado = $( "select option:selected" ).text();
            //
            //Si es León
            if(seleccinado === "León")
            {
            	//
                //El mapa se situa en León
                mymap.panTo(['42.598287' , '-5.567038']);
            }
            else //Si no
            {
                //
				//El mapa se situa en Ponferrada
                mymap.panTo(['42.550042' , ' -6.598184']);
            }
        }).trigger( "change" );
    });

</script>
