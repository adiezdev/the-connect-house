<?php
//error_reporting( E_ALL );
//ini_set( 'display_errors' , true );
//ini_set( 'display_startup_errors' , true );
/*
    -------------------------------------
    Archivo de: Alejandro Díez
    GitHub: @adilosa95
    Proyecto: the-connect-house
    Nombre del archivo: registrar-piso-habitacion.php
    -------------------------------------
*/
    require_once( __DIR__."/../../../includes/header.php" );
    require_once( __DIR__."/../../../includes/constantes.php" );
    require_once( __DIR__."/../../../includes/sesion.php" );
	//
	//Acceso a datos
    require_once( __DIR__."/../../../bd/bd_pisos.php" );
    require_once( __DIR__."/../../../bd/bd_secciones.php" );
    //
    //Configuramos los estilos que necesitamos
    $estilos = array(
        ESTILOS_WIDGETS ,
        ESTILOS_REGISTRAR_PISO ,
    );
    //
    //Lo cogemos el tipò que vamos añadir
	$titulo = '';
    if($_GET)
    {
        $nTipo = $_GET['Tipo'];
    }
    //
    //Titulo depencidendo de lo que sea
    if( $nTipo == 1)
    {
        $titulo = 'Y el piso ¿Cómo es?';
    }
    else
    {
        $titulo = 'Y la habitación ¿Cómo es? ';
    }
    //
    //Generamos la cabecera
    cabecera( $titulo , $estilos , true );
    //
    //Accedemos al 1 que son las comodidades
    $odbComodidades = new Secciones(1);
    //Sacamos todos los registros
    $oComodidades = $odbComodidades->getAll();
    //Saca os las normas
    $odbComodidades = new Secciones(2);
    $oNormas = $odbComodidades->getAll();
?>
<body>
    <h1 class="title" style="text-align: center"><?php echo $titulo; ?></h1><br>
            <form method="post">
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
            </form>
<script>
    $(document).ready(function(){
        //Máixmo de caracteres en la descripción
        var maximo = 320;
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
        //Entramos al label checkeable de las comodidades
        $('.checkeable').change( ':checked' , function ()
        {
            //Buscamos dentro del label la imagem
            var idimg =  $(this).find('#cimagen');
            //Sacamos la url de la imagen
            var imgsrc  = idimg.attr('src');
            var imgsrcrem = '';
            //
            //Comprueba si está quecheckeado
            if ( $(this).find('#comodidad').is(":checked"))
            {
                //Si lo está cambiamos la imagen
                imgsrcrem = imgsrc.replace("808080", "000000");
                idimg.attr('src', imgsrcrem );
            }
            else //Revertimos el check
            {
                //Si revertimos el check mostramos la imagen anterios
                imgsrcrem = imgsrc.replace("000000", "808080");
                idimg.attr('src', imgsrcrem );
            }
        });
    });
</script>
</body>
