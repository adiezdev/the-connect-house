<?php
/*
-------------------------------------
Archivo de: Alejandro Díez
GitHub: @adilosa95
Proyecto: the-connect-house
Nombre del archivo: seccion-2.php
-------------------------------------
*/?>
<table class="seccion 2">
	<tbody >
	<tr>
		<th colspan="5" ><h2>¿Cómo es?</h2></th>
	</tr>
	<tr>
		<td><label for="metros">Metro del piso (*): </label></td>
		<td><input type="text" id="metros" name="metros" class="credential"  placeholder="Cuantos metros tiene el piso"></td>
        <td><label for="precio">Precio (*): </label></td>
        <td><input type="text" id="precio" name="precio" class="credential"  placeholder="¿Qué precio tiene?">€</td>
	</tr>
    <tr>
        <?php
        // Si es una habitación aparecerá cuantos chicos y chicas hay en el piso.
        if($nTipo == 2)
        {
            $Html  = '<td><label for="chicos">Chicos que ya están en el piso: </label></td>';
            $Html .=  '<td><input type="text" id="chicos" name="chicos" class="credential" ></td>';
            $Html .= '<td><label for="chicas">Chicas que ya están en el piso: </label></td>';
            $Html .=  '<td><input type="text"  id="chicas" name="chicas" class="credential" ></td>';
            echo $Html;
        }
        else //Sino no aparecerá nada
        {
            $Html = '<td></td>';
            $Html .= '<td></td>';
            $Html .= '<td></td>';
            $Html .= '<td></td>';
            echo $Html;
        }
        ?>
    </tr>
	<tr>
		<td><label for="toilet">Baños (*): </label></td>
		<td><input type="text" id="toilet" name="toilet" class="credential"  placeholder="Nº de Baños"></td>
		<td><label for="habitaciones">Habitaciones (*): </label></td>
		<td> <input type="text" id="habitaciones" name="habitaciones" class="credential"  placeholder="numero de habitaciones"></td>
	</tr>
    <tr>
        <td>* Campos obligatorios</td>
    </tr>
	</tbody>
</table>