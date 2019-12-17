<?php
/*
    -------------------------------------
    Archivo de: Alejandro Díez
    GitHub: @adilosa95
    Proyecto: the-connect-house
    Nombre del archivo: a_editarPisoHabitacion.php
    -------------------------------------
*/
//Recorremos las imagenes
foreach($oDatosJson["Imagenes"] as $imagen=>$value)
{
    //Decodificamos la imagen
    $datos = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $value));
    //
    //Generamso un nombre
    $nom = md5(rand());
    //
    //URL que se guarda en la bbd
    $filesave = 'uploads/'.$aUsuarios[0]->Carpeta.'/'.$carpeta.'/'.$nom.'.jpg';
    //
    //URL completa
    $root = $_SERVER['DOCUMENT_ROOT'].'/the-connect-house/'.$filesave;
    //
    //Llamamos a las imagenes
    $oDdImagenes = new Imagenes();
    //
    //Añadimos las imagenes a la Base de Datos
    $lResult = $oDdImagenes->addImg( $filesave ,  $ultimaId[0]->idPiso );
    //
    //Si es correcto
    if($lResult)
    {
        //Guardamos la imagen en la ruta
        file_put_contents($root , $datos);
    }
}