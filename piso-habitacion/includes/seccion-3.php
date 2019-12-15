<?php
/*
-------------------------------------
Archivo de: Alejandro Díez
GitHub: @adilosa95
Proyecto: the-connect-house
Nombre del archivo: seccion-3.php
-------------------------------------
*/?>
<div class="seccion 3">

		<div class="cabeceras"><h2 style="color: #aac759">Comodidiades</h2></div>
         <div class="comodidad">
		<?php
			//Mostramos todos los registros
			foreach ( $oComodidades as $oComodidad)
			{
				$cSecciones  = '<div class="comodidades"><label class="checkeable">';
				$cSecciones .= '<input type="checkbox" class="comodidad" name="comodidad" value="'.$oComodidad->idComodidad.'"/>';
				$cSecciones .= '<img id="cimagen" src="'.$oComodidad->Imagen.'" >';
                $cSecciones .= '<p>'.$oComodidad->Nombre.'</p>';
				$cSecciones .= '</label></div>';
				echo $cSecciones;
			}
		?>
         </div>
		<div class="cabeceras" ><h2 style="color: #aac759">Normas</h2></div>
        <div class="norma">
		<?php
			//Mostramos todos los registros
			foreach ($oNormas as $oNorma)
			{
				$cSecciones  = '<div class="normas" ><label class="checkeable">';
				$cSecciones .= '<input type="checkbox" class="norma" name="norma" value="'.$oNorma->idNorma.'"/>';
				$cSecciones .= '<img id="cimagen" src="'.$oNorma->Imagen.'" >';
                $cSecciones .= '<p>'.$oNorma->Nombre.'</p>';
				$cSecciones .= '</label></div>';
				echo $cSecciones;
			}
		?>
        </div>
</div>