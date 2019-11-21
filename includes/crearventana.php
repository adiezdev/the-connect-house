<?php
/*
    -------------------------------------
    Archivo de: Alejandro Díez
    GitHub: @adilosa95
    Proyecto: the-connect-house
    Nombre del archivo: crearventana.php
    -------------------------------------
*/
/**
 * Funcion para generar una ventana emegente
 *
 * @param string $frase
 * @param array null $arraybtons
 * @param array null $funcionalidades
 */
function getVentana( $frase , $arraybtons , $funcionalidades)
{
    $Ventana = '<div id="miVentana" class="ventana">';
    $Ventana .= '<div class="ventana-content">';
    $Ventana .= '<span class="close">&times;</span>';
    $Ventana .= '<h3>'.$frase.'</h3>';
    if( $arraybtons != null )
    {
        foreach (array_combine($arraybtons , $funcionalidades) as $arraybton => $funcionalidad)
        {
            $Ventana .='<button class="button" onclick="'.$funcionalidad.'">'.$arraybton.'</button>';
        }
    }
    $Ventana .='</div>
        </div>';
    echo $Ventana;
}






