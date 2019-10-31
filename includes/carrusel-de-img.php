<?php

function getCarrusel( $img , $aCont)
{
    $carrousel = '';
    $carrousel .= '<div class="carrusel" style="max-width:100%">';
    $carrousel .= '<img class="imgSlides" src="'.$img.'" alt="" srcset="">';
    $carrousel .= '<div class="items"><div class="left" onclick="siguienteImg(-1)">&#10094;</div>';
    $carrousel .= '<div class="right" onclick="siguienteImg('.count($aCont).')">&#10095;</div>';
    $carrousel .= '<span class="circulo" onclick="thisImg(1)"></span>'; 
    $carrousel .= '</div>';
    $carrousel .= '</div>';
    echo $carrousel;
}