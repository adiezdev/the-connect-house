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
		<div class="cabeceras"><h2>Editar</h2></div>
         <div class="comodidad">
            <div class="comodidades" ><label for="calle">Calle: </label></div>
            <div class="comodidades" ><input type="text" id="calle" name="calle" class="credential"  value="<?php echo $aDbPisoHabitacion[0]->Calle?>" readonly></div>
            <div class="comodidades" ><label for="numero">Portal Nº y piso: </label></div>
            <div class="comodidades" ><input type="text" id="numero" name="numero" class="credential" value="<?php echo $aDbPisoHabitacion[0]->Numero?>" readonly></div>
            <div class="comodidades" ><label for="cp">Codigo Postal: </label></div>
             <div class="comodidades"><input type="text" id="cp" name="cp" class="credential"  value="<?php echo $aDbPisoHabitacion[0]->CP?>" readonly ></div>
         </div>
    <br>
        <div class="comodidad">
            <div class="comodidades"><label for="ciudad">Ciudad: </label></div>
            <div class="comodidades">
                <div class="comodidades"><input type="text" id="ciudad" name="ciudad" class="credential" value="<?php echo $aDbPisoHabitacion[0]->Ciudad?>" readonly ></div>
            </div>
            <div class="comodidades"><label for="descripcion">Descripción (*): </label></div>
            <div class="comodidades"><textarea  class="credential" id="descripcion" name="user_post_textarea" maxlength="320" style="height: 125px !important;"><?php echo $aDbPisoHabitacion[0]->Descripcion?></textarea>
                <br><p>600\<span id="contador"> 600</span></p>
            </div>
        </div>

        <div>* Campos editables</div>
</div>