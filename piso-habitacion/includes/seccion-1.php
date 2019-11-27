<?php
/*
-------------------------------------
Archivo de: Alejandro Díez
GitHub: @adilosa95
Proyecto: the-connect-house
Nombre del archivo: seccion-1.php
-------------------------------------
*/?>
<table class="seccion 1">
	<tbody>
	<tr>
		<th colspan="6" ><h2>¿Dónde está?</h2></th>
	</tr>
	<tr>
		<td><label for="calle">Calle (*): </label></td>
		<td><input type="text" name="calle" class="credential"  placeholder="Calle donde está..."></td>
		<td><label for="numero">Portal Nº (*): </label></td>
		<td><input type="text" name="numero" class="credential" placeholder="Número..."></td>
		<td><label for="cp">CP (*): </label></td>
		<td><input type="text" name="cp" class="credential" placeholder="Codigo Postal..." ></td>
	</tr>
	<tr>
		<td ><label for="ciudad">Ciudad (*): </label></td>
		<td>
			<select name="ciudad" id="selector" class="credential">
				<option value="Leon" selected>León</option>
				<option value="Ponferrada" >Ponferrada</option>
			</select>
		</td>
		<td><label for="descripcion">Descripción (*): </label></td>
		<td colspan="2"><textarea class="credential" id="descripcion" cols="30" rows="36" name="user_post_textarea" maxlength="320" placeholder="Pon una descripción" style="height: 125px !important;">
                    </textarea><br><p>320\<span id="contador"> 320</span></p>
		</td>
	</tr>
    <tr>
        <td>* Campos obligatorios</td>
    </tr>
	</tbody>
</table>
<script>

</script>