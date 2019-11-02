<?php
/**
 * Función para agregar imagenes y formar el slider de imagenes
 * 
 * @param string $sImg
 */
function getCarrusel( $sImg )
{
    $carrousel = '';
    $carrousel .= '<div class="carrusel" style="max-width:100%">';
    $carrousel .= '<img class="imgSlides" src="'.$sImg.'" alt="" srcset="">';
    $carrousel .= '<div class="items"><div class="left" onclick="siguienteImg(-1)">&#10094;</div>';
    $carrousel .= '<div class="right" onclick="siguienteImg(1)">&#10095;</div>';
    $carrousel .= '</div>';
    $carrousel .= '</div>';
    echo $carrousel;
}