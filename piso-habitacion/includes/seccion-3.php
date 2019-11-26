<?php
/*
-------------------------------------
Archivo de: Alejandro Díez
GitHub: @adilosa95
Proyecto: the-connect-house
Nombre del archivo: seccion-3.php
-------------------------------------
*/?>
<table>
	<tbody class="seccion3">
	<tr>
		<th colspan="6" ><h2 style="color: #aac759">Comodidiades</h2></th>
	</tr>
	<tr>
		<?php
			//Mostramos todos los registros
			foreach ( $oComodidades as $oComodidad)
			{
				$cSecciones  = '<td colspan="1"><label class="checkeable">';
				$cSecciones .= '<input type="checkbox" id="comodidad" name="comodidad" value="'.$oComodidad->idComodidad.'"/>';
				$cSecciones .= '<img id="cimagen" src="'.$oComodidad->Imagen.'" >';
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