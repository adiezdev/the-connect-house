<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/slider-images.css">
</head>

<body>
     <?php
        require_once(__DIR__.'/includes/carrusel-de-img.php');
        $a = array(
            "uno" => "img/img-inicio.jpg",
            "uno2" => "img/img-modelo.jpg" 
        );
        $objects = json_decode(json_encode($a), FALSE);
        foreach( $objects as $object)
        {
             print_r(getCarrusel($object, $a));
        }
     ?>
</body>
<script src="js/slider.js"></script>

</html>