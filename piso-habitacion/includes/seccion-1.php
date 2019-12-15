<?php
/*
-------------------------------------
Archivo de: Alejandro Díez
GitHub: @adilosa95
Proyecto: the-connect-house
Nombre del archivo: seccion-1.php
-------------------------------------
*/?>
<div class="seccion 1">
		<div class="cabeceras"><h2>¿Dónde está?</h2></div>
         <div class="comodidad">
            <div class="comodidades" ><label for="calle">Calle (*): </label></div>
            <div class="comodidades" ><input type="text" id="calle" name="calle" class="credential"  placeholder="Calle donde está..."></div>
            <div class="comodidades" ><label for="numero">Portal Nº y piso (*): </label></div>
            <div class="comodidades" ><input type="text" id="numero" name="numero" class="credential" placeholder="Número..."></div>
            <div class="comodidades" ><label for="cp">Codigo Postal (*): </label></div>
             <div class="comodidades"><input type="text" id="cp" name="cp" class="credential" placeholder="Codigo Postal..." ></div>
         </div>
    <br>
        <div class="comodidad">
            <div class="comodidades"><label for="ciudad">Ciudad (*): </label></div>
            <div class="comodidades">
                <select name="ciudad" id="selector" class="credential">
                    <option value="León" selected>León</option>
                    <option value="Ponferrada" >Ponferrada</option>
                </select>
            </div>
            <div class="comodidades"><label for="descripcion">Descripción (*): </label></div>
            <div class="comodidades"><textarea  class="credential" id="descripcion" name="user_post_textarea" maxlength="320" placeholder="Pon una descripción" style="height: 125px !important;" ></textarea>
                <br><p>600\<span id="contador"> 600</span></p>
            </div>
        </div>

        <div>* Campos obligatorios</div>
</div>