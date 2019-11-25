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
    require_once(__DIR__."/includes/header.php" );
    require_once(__DIR__."/includes/constantes.php" );
    require_once(__DIR__."/includes/sesion.php");
	//
	//Acceso a datos
    require_once(__DIR__."/bd/bd_pisos.php");
    require_once(__DIR__."/bd/bd_secciones.php");
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
    <h1 class="title"><?php echo $titulo; ?></h1><br>
        <table>
                <!--Seccion1 -->
            <form method="post">
            <tbody class="seccion">
                <h2>¿Dónde está?</h2>
                <tr>
                    <td><label for="calle">Calle: </label></td>
                    <td><input type="text" name="calle" class="credential"  placeholder="Calle donde está..."></td>
                    <td><label for="numero">Portal Nº: </label></td>
                    <td><input type="text" name="numero" class="credential" placeholder="Número..." style="width: 10%"></td>
                    <td><label for="cp">CP: </label></td>
                    <td><input type="text" name="cp" class="credential" placeholder="Codigo Postal..." style="width: 10%"></td>
                </tr>
                <tr>
                    <td><label for="ciudad">Ciudad: </label></td>
                    <td>
                        <select name="ciudad" id="selector" class="credential">
                            <option value="León">León</option>
                            <option value="Ponferrada">Ponferrada</option>
                        </select>
                    </td>
                    <td><label for="descripcion">Descripción: </label></td>
                    <td><textarea class="credential" id="descripcion" cols="28" rows="35" name="user_post_textarea" maxlength="320" placeholder="Pon una descripción" style="height: 125px !important;">
                    </textarea><br><p>320\<span id="contador"> 320</span></p>
                    </td>
                </tr>
            </tbody>
                <!--Seccion2-->
            <tbody class="seccion">
            <h2>¿Cómo es?</h2>
                <tr>
                    <td> <td><label for="metros">Metro del piso: </label></td></td>
                    <td><input type="text" name="metros" class="credential"  placeholder="Cuantos metros tiene el piso"></td>
                    <td><label for="precio">Precio: </label></td>
                    <td><input type="text" name="precio" class="credential"  placeholder="¿Qué precio tiene?">€</td>
                </tr>
                <tr>
                    <td><label for="toilet">Baños: </label></td>
                    <td><input type="text" name="toilet" class="credential"  placeholder="Nº de Baños"></td>
                    <td><label for="habitaciones">Habitaciones: </label></td>
                    <td> <input type="text" name="habitaciones" class="credential"  placeholder="numero de habitaciones"></td>
                </tr>
            </tbody>
            <tbody class="seccion">
            <h2>Comodidades</h2>
                <tr>
	                <?php
		                //Mostramos todos los registros
		                foreach ($oComodidades as $comodidad)
		                {
			                $cSecciones  = '<td><label class="checkeable">';
			                $cSecciones .= '<input type="checkbox" id="comodidad" name="comodidad" value="'.$comodidad->idComodidad.'"/>';
			                $cSecciones .= '<img id="cimagen" src="'.$comodidad->Imagen.'" >';
			                $cSecciones .= $comodidad->Nombre;
			                $cSecciones .= '</label></td>';
			                echo $cSecciones;
		                }

	                ?>
                </tr>
            <h2>Normas</h2><br>
                <tr>
	                <?php
		                //Mostramos todos los registros
		                foreach ($oNormas as $oNorma)
		                {
			                $cSecciones  = '<td><label class="checkeable">';
			                $cSecciones .= '<input type="checkbox" id="comodidad" name="comodidad" value="'.$oNorma->idNorma.'"/>';
			                $cSecciones .= '<img id="cimagen" src="'.$oNorma->Imagen.'" >';
			                $cSecciones .= $oNorma->Nombre;
			                $cSecciones .= '</label></td>';
			                echo $cSecciones;
		                }

	                ?>
                </tr>
            </tbody>
            <!--Seccion3-->
            <tbody class="seccion">

            </tbody>
            <!--Seccion4-->
            <tbody class="seccion">
            <h2>¿Donde se encuentra en el mapa?</h2>
            </tbody>
                <!--Seccion5-->
                <tbody class="seccion">
                <h2>Sube imagenes</h2>
                </tbody>
            </form>
        </table>
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
