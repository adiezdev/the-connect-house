<?php
require_once(__DIR__."/includes/header.php");
require_once(__DIR__."/includes/constantes.php");
require_once(__DIR__."/includes/sesion.php");
//
$a = array(
    "widgets" => ESTILOS_WIDGETS,
    "cperfil" => "estilos-per"
);
//
//Codificamos los objetos
$objects = json_decode(json_encode($a), FALSE);
//
//Se lo envíamos al metodo
cabecera(TITULO_INDEX,$objects,false);
?>
<body>
    <h1 class="cabeceras">¡YA CASI HEMOS ACABADO!</h1>
    <div>

    </div>
</body>
