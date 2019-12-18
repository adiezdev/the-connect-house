<?php
/*
-------------------------------------
Archivo de: Alejandro Díez
GitHub: @adilosa95
Proyecto: the-connect-house
Nombre del archivo: seccion-5.php
-------------------------------------
*/?>
<div class="seccion 5">
		<div class="cabeceras"><h2>¿Cómo es?</h2></div>
        <div align="center"><label for="inputperfil">Subir Imagen</label><input type="file" name="archivos" id="inputperfil" multiple /></div>
        <div align="center">Preferiblemente horizontales</div>
        <div id="galeria" style="border: dashed 8px #aac759; height: 350px; margin: 30px;">
            <output id="gallery">
                <?php
                //Mostramos imagenes si el piso tiene
                foreach ($aDbImagenesPisoH  as $aDbImagenesPiso )
                {
                    $Img = '<div class="contenedores" >';
                    $Img .= '<p style="position: relative; top: 20px; line-height: normal; background: red; width: 31px; border-radius: 500px; height: 31px;">X</p>';
                    $Img .= '<img id="imgeliminar" title="'.$aDbImagenesPiso->idImagen.'" style="width: 280px; margin: 5px" src="/the-connect-house/'.$aDbImagenesPiso->Url.'">';
                    $Img .= '</div>';
                    echo $Img;
                }
                ?>
        </div>
</div>
<div id="hiddens">

</div>