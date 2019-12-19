    <?php
    //error_reporting( E_ALL );
    //ini_set( 'display_errors' , true );
    //ini_set( 'display_startup_errors' , true );
    error_reporting(0);
    /*
        -------------------------------------
        Archivo de: Alejandro Díez
        GitHub: @adilosa95
        Proyecto: the-connect-house
        Nombre del archivo: editar-piso-habitacion.php
        -------------------------------------
    */
    session_start();
    require_once(__DIR__ . "/../includes/sesion.php");
    //
    require_once(__DIR__ . "/../includes/header.php");
    require_once(__DIR__ . "/../includes/constantes.php");
    //
    //Acceso a datos
    require_once(__DIR__ . "/../bd/bd_pisos.php");
    require_once(__DIR__ . "/../bd/bd_ocupado.php");
    require_once(__DIR__ . "/../bd/bd_secciones.php");
    require_once(__DIR__ . "/../bd/bd_imagenespiso.php");
    //
    //Configuramos los estilos que necesitamos
    $estilos = array(
        ESTILOS_WIDGETS ,
        ESTILOS_MAIN ,
        ESTILOS_REGISTRAR_PISO ,
        INCLUD_SLIDE
    );
    //
    //Lo cogemos el tipo que vamos añadir
    $titulo = '';
    if($_GET)
    {
        $nTipo = $_GET['Tipo'];
        $nidPiso = $_GET['idPiso'];
    }
    //
    //Titulo dependiendo de lo que sea
    if( $nTipo == 1)
    {
        $titulo = 'Editar piso';
    }
    else if($nTipo == 2)
    {
        $titulo = 'Editar habitación';
    }
    else //Sino está inicializamo vuelve al perfil
    {
        header( "location:/the-connect-house/perfil.php" );
        return;
    }
    //
    //Generamos la cabecera
    cabecera( $titulo , $estilos , false );
    //
    $oDbPisoHabitacion = new Pisos();
    $aDbPisoHabitacion = $oDbPisoHabitacion->getById($nidPiso);
    //
    if($aDbPisoHabitacion[0]->idUsuario != $_SESSION['idUsuario'])
    {
        header( "location:/the-connect-house/perfil.php" );
        return;
    }
    //
    //Accedemos al 1 que son las comodidades
    $odbComodidades = new Secciones(1);
    //Sacamos todos los registros
    $oComodidades = $odbComodidades->getAll();
    //
    $oComodidadesId = $odbComodidades->getById($nidPiso);
    //
    //Comprobamos si los dos arrays coinciden
    $array = json_decode(json_encode($oComodidadesId), true);
    $array1 = json_decode(json_encode($oComodidades), true);
    //Con el resultado hacemos uno
    $arrayMacth = array_intersect_assoc($array , $array1);
    //
    //Sacamos las normas
    $odbComodidades = new Secciones(2);
    //Sacamos todos los registros
    $oNormas = $odbComodidades->getAll();
    //
    $oNormasId = $odbComodidades->getById($nidPiso);
    //
    //Comprobamos si los dos arrays coinciden
    $array2 = json_decode(json_encode($oNormasId), true);
    $array3 = json_decode(json_encode($oNormas), true);
    //Con el resultado hacemos uno
    $arrayMacthN = array_intersect_assoc($array2 , $array3);
    //
    //
    $oDbImagenesPisoH  = new Imagenes();
    $aDbImagenesPisoH  = $oDbImagenesPisoH->getByIdPiso($nidPiso)
    ?>
<body>
<div class="content">
    <h1 class="title" style="text-align: center"><?php echo $titulo; ?></h1><br>
    <div id="todassecciones"></div>
    <form method="post" >
        <input type="hidden" value="<?php echo $nTipo ?>" id="IdTipo">
        <input type="hidden" value="<?php echo $aDbPisoHabitacion[0]->idPiso ?>" id="IdPiso">
        <!--Seccion1 -->
        <?php include("includes/editar/seccion-1.php"); ?>
        <!--Seccion2-->
        <?php include("includes/editar/seccion-2.php"); ?>
        <!--Seccion3-->
        <?php include("includes/editar/seccion-3.php"); ?>
        <!--Seccion5-->
        <?php include("includes/editar/seccion-5.php"); ?>
        <!--Guardemos-->
        <div class="guardardatos">
            <input type="button"  class="button" value="Guardar"  onclick="validarDatosEditados()"> <input type="button"  class="button"  value="Cancelar" onclick="window.history.back()" >
    </form>
    <input type="button"  class="eliminarpiso" value="ELIMINAR"  onclick="eliminarDatos()">
</div>
<?php require_once(__DIR__ . "/../includes/footer.php"); ?>
</body>
<!-- Scripts necesarios -->
    <script src="<?php echo get_root_uri() ?>/the-connect-house/js/slider-secciones.js"></script>
    <script src="<?php echo get_root_uri() ?>/the-connect-house/piso-habitacion/js/precarga-imagenes.js"></script>
    <script src="<?php echo get_root_uri() ?>/the-connect-house/js/eliminar-precargada.js"></script>
    <script src="<?php echo get_root_uri() ?>/the-connect-house/piso-habitacion/js/validar-edicion-piso-habitacion.js"></script>
    <script src="<?php echo get_root_uri() ?>/the-connect-house/piso-habitacion/js/validar-eliminacion-piso-habitacion.js"></script>
    <script>
     var maximo = 600;
    //Si detecta el teclado

        //Congemos de la descipcion la longitud del valor
        var caracteres = $('#descripcion').val().length;
        //se lo restamos al maximo
        var restantes = maximo - caracteres;
        //lo mostramos
        $('#contador').html(restantes);
    //
    $(document).ready(function(){

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
            if ( $(this).find('.comodidad').is(':checked'))
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
    });

    var checks = $('.checkeable');
    checks.each(function (index)
    {
        //
        //Buscamos dentro del label la imagem
        var idimg =  $(this).find('#cimagen');
        //Sacamos la url de la imagen
        var imgsrc  = idimg.attr('src');
        var imgsrcrem = '';
    <?php
        //Recorremos el array y si es igual al valor se chekea
    foreach ( $arrayMacth as $arrayMact)
    {
        $arrayMact["idComodidad"];
        echo  "if( $(checks[index]).find('.comodidad').val() == ".$arrayMact["idComodidad"].")
                {
                     $(checks[index]).find('.comodidad').attr('checked', true);
                     imgsrcrem = imgsrc.replace('808080', '000000');
                     idimg.attr('src', imgsrcrem );
                }";
    }
    //Aquellos que tengan de valor el mismo que el del array se checkea
    foreach ( $arrayMacthN as $arrayMacth )
    {
        $arrayMacth["idNorma"];
            echo  "if( $(checks[index]).find('.norma').val() == ".$arrayMacth["idNorma"].")
                {
                     $(checks[index]).find('.norma').attr('checked', true);
                     imgsrcrem = imgsrc.replace('808080', '000000');
                     idimg.attr('src', imgsrcrem );
             }";
    }
    ?>
    });
    //Elimina la imagen que ya hay en la base de datos
    $('.contenedores').click(function ()
    {
        var cont = $(this);
        //Cogemos la URL
        var imageliminar  = $(this).find('#imgeliminar').attr('title');
        var imageliminarsrc  = $(this).find('#imgeliminar').attr('src');
        //console.log(imageliminar);
        //Formamso JSON
        var oDatosJson = {imagedelete: imageliminar , src: imageliminarsrc };
        //Se lo mandamos a eliminar
        $.ajax({
            url: '/the-connect-house/piso-habitacion/ajax/a_deleteImg.php',
            type: 'POST',
            data: JSON.stringify(oDatosJson)
        })
            .done(function(oJson )
            {
                console.log(oJson);
                var oRespuesta = JSON.parse(oJson);
                if (oRespuesta.Estado == "OK")
                {
                    $(cont).hide();
                }
            });
    });
</script>
