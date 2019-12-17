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
        <div class="cabeceras"><h2>Editar</h2></div>
    <div class="comodidad">
        <div class="comodidades"><label for="metros">Metro del piso: </label></div>
        <div class="comodidades"><input type="text" id="metros" name="metros" class="credential"   value="<?php echo $aDbPisoHabitacion[0]->Metros?>" readonly></div>
        <div class="comodidades"><label for="precio">Precio (*): </label></div>
        <div class="comodidades"><input type="text" id="precio" name="precio" class="credential" value="<?php echo $aDbPisoHabitacion[0]->Precio?>">€/mes</div>
    </div>
    <div class="comodidad">
        <div class="comodidades"><label for="toilet">Baños: </label></div>
        <div class="comodidades"><input type="text" id="toilet" name="toilet" class="credential" value="<?php echo $aDbPisoHabitacion[0]->NBanos?>" readonly></div>
        <div class="comodidades"><label for="habitaciones">Habitaciones: </label></div>
        <div class="comodidades"> <input type="text" id="habitaciones" name="habitaciones" class="credential"  value="<?php echo $aDbPisoHabitacion[0]->NHabitaciones?>" readonly></div>
    </div>
		<?php
        // Si es una habitación aparecerá cuantos chicos y chicas hay en el piso.
        if($nTipo == 2)
        {
            //
            $oDbOcupado = new Ocupado();
            $aDbOcupados = $oDbOcupado->getById($nidPiso);
            //
            $Html  = '<div class="cabeceras"><h2>Persinas que ya hay en el piso</h2></div>';
            $Html  .= '<div class="comodidad">';
            foreach ($aDbOcupados as $aDbOcupado)
            {
                $sSexo = '';
                if( $aDbOcupado->Sexo == 'M' )
                {
                    $sSexo = 'Chicos';
                }
                else
                {
                    $sSexo = 'Chicas';
                }

                $Html .=  '<div class="comodidades"><label for="chicos">'.$sSexo.' (*): </label></div>';
                $Html .=  '<div class="comodidades"><input type="text" id="'.$sSexo.'" name="'.$sSexo.'" class="credential" value="'.$aDbOcupado->Num.'" ></div>';
            }
            $Html .= '</div>';
            echo $Html;
        }
        ?>
    <div>* Campos editables</div>
</div>