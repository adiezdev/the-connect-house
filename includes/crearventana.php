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
function getVentana( $frase , $arraybtons , $funcionalidades = null )
{
    $Ventana = '<div id="miVentana" class="ventana">';
    $Ventana .= '<div class="ventana-content">';
    $Ventana .= '<span class="close">&times;</span>';// La X para cerrar la ventana
    $Ventana .= '<h3>'.$frase.'</h3>';//False de la ventana
    //Comptovamos si le pasamos para crear botones, es decir diferente a nulo
    if( $arraybtons != null )
    {
    	//Combinamos el array del nombre del botón con el nombre del método al hacer click
        foreach (array_combine($arraybtons , $funcionalidades) as $arraybton => $funcionalidad)
        {
        	//Generamos los botones
            $Ventana .='<button class="button" onclick="'.$funcionalidad.'">'.$arraybton.'</button>';
        }
    }
    $Ventana .='</div>
        </div>';
    echo $Ventana;
}






