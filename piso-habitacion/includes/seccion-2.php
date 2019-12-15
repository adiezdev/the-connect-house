<?php
/*
-------------------------------------
Archivo de: Alejandro Díez
GitHub: @adilosa95
Proyecto: the-connect-house
Nombre del archivo: seccion-2.php
-------------------------------------
*/?>
<div class="seccion 2">
        <div class="cabeceras"><h2>¿Cómo es?</h2></div>
    <div class="comodidad">
        <div class="comodidades"><label for="metros">Metro del piso (*): </label></div>
        <div class="comodidades"><input type="text" id="metros" name="metros" class="credential"  placeholder="Cuantos metros tiene el piso"></div>
        <div class="comodidades"><label for="precio">Precio (*): </label></div>
        <div class="comodidades"><input type="text" id="precio" name="precio" class="credential"  placeholder="¿Qué precio tiene?">€</div>
    </div>
    <div class="comodidad">
        <div class="comodidades"><label for="toilet">Baños (*): </label></div>
        <div class="comodidades"><input type="text" id="toilet" name="toilet" class="credential"  placeholder="Nº de Baños"></div>
        <div class="comodidades"><label for="habitaciones">Habitaciones (*): </label></div>
        <div class="comodidades"> <input type="text" id="habitaciones" name="habitaciones" class="credential"  placeholder="numero de habitaciones"></div>
    </div>
		<?php
        // Si es una habitación aparecerá cuantos chicos y chicas hay en el piso.
        if($nTipo == 2)
        {
            $Html  = '<div class="cabeceras"><h2>Persinas que ya hay en el piso</h2></div>';
            $Html  .= '<div class="comodidad">';
            $Html .=  '<div class="comodidades"><label for="chicos">Chicos: </label></div>';
            $Html .=  '<div class="comodidades"><input type="text" id="chicos" name="chicos" class="credential" ></div>';
            $Html .=  '<div class="comodidades"><label for="chicas">Chicas: </label></div>';
            $Html .=  '<div class="comodidades"><input type="text"  id="chicas" name="chicas" class="credential" ></div>';
            $Html .= '</div>';
            echo $Html;
        }
        ?>
        <div>* Campos obligatorios</div>
</div>