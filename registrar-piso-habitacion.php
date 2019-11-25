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
    <h1 class="title" style="text-align: center"><?php echo $titulo; ?></h1><br>

                <!--Seccion1 -->
            <form method="post">
                <table style="">
            <tbody class="seccion 1">
            <tr>
                <th colspan="6" ><h2>¿Dónde está?</h2></th>
            </tr>
                <tr>
                    <td><label for="calle">Calle: </label></td>
                    <td><input type="text" name="calle" class="credential"  placeholder="Calle donde está..."></td>
                    <td><label for="numero">Portal Nº: </label></td>
                    <td><input type="text" name="numero" class="credential" placeholder="Número..."></td>
                    <td><label for="cp">CP: </label></td>
                    <td><input type="text" name="cp" class="credential" placeholder="Codigo Postal..." ></td>
                </tr>
                <tr>
                    <td ><label for="ciudad">Ciudad: </label></td>
                    <td>
                        <select name="ciudad" id="selector" class="credential">
                            <option value="León">León</option>
                            <option value="Ponferrada">Ponferrada</option>
                        </select>
                    </td>
                    <td><label for="descripcion">Descripción: </label></td>
                    <td colspan="2"><textarea class="credential" id="descripcion" cols="30" rows="36" name="user_post_textarea" maxlength="320" placeholder="Pon una descripción" style="height: 125px !important;">
                    </textarea><br><p>320\<span id="contador"> 320</span></p>
                    </td>
                </tr>
            </tbody>
                </table>
                <!--Seccion2-->
                <table>
            <tbody class="seccion2">
            <tr>
                <th colspan="5" ><h2>¿Cómo es?</h2></th>
            </tr>
                <tr>
                    <td><label for="metros">Metro del piso: </label></td>
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
                </table>
                <table>
            <tbody class="seccion3">
            <tr>
                <th colspan="6" ><h2 style="color: #aac759">Comodidiades</h2></th>
            </tr>
                <tr>
	                <?php
		                //Mostramos todos los registros
		                foreach ($oComodidades as $comodidad)
		                {
			                $cSecciones  = '<td colspan="1"><label class="checkeable">';
			                $cSecciones .= '<input type="checkbox" id="comodidad" name="comodidad" value="'.$comodidad->idComodidad.'"/>';
			                $cSecciones .= '<img id="cimagen" src="'.$comodidad->Imagen.'" >';
			                $cSecciones .= '</label></td>';
			                echo $cSecciones;
		                }
	                ?>
                </tr>
            <tr>
                <th colspan="6" ><h2 style="color: #aac759">Normas</h2></th>
            </tr>
                <tr>
	                <?php
		                //Mostramos todos los registros
		                foreach ($oNormas as $oNorma)
		                {
			                $cSecciones  = '<td colspan="2"><label class="checkeable">';
			                $cSecciones .= '<input type="checkbox" id="comodidad" name="comodidad" value="'.$oNorma->idNorma.'"/>';
			                $cSecciones .= '<img id="cimagen" src="'.$oNorma->Imagen.'" >';
			                $cSecciones .= '</label></td>';
			                echo $cSecciones;
		                }

	                ?>
                </tr>
            </tbody>
                </table>
                <table>
                    <tbody class="seccion4">
                    <tr>
                        <th><h2>Donde se encuentra en el mapa</h2></th>
                    </tr>
                    </tbody>
                </table>
                <!--Seccion6-->
               <table>
                   <tbody class="seccion5">
                   <tr>
                       <th><h2>¿Cómo es?</h2></th>
                   </tr>
                   </tbody>
               </table>
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
