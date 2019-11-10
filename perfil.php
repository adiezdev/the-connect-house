<?php
require_once(__DIR__."/includes/header.php");
require_once(__DIR__."/includes/constantes.php");
require_once(__DIR__."/includes/sesion.php");
//
$a = array(
    "widgets" => ESTILOS_WIDGETS,
    "perfil" => ESTILOS_PERFIL
);
//
//Codificamos los objetos
$objects = json_decode(json_encode($a), FALSE);
//
//Se lo envíamos al metodo
cabecera(TITULO_INDEX,$objects,false);
?>
<body>
    <div class="contenedor-izquierdo">
        <div class="into-izquierdo">
            <div id="perfil">
                <img id="user" src="img/isset/isset-user.png" alt="imgen-perfil" srcset="">
                <h3>Nombre</h3><br>
                <div class="titleciudad"><p><i class="fas fa-map-pin"></i> Ciudad</p></div><br>
                <div id="descripcion"><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p></div><br>
            </div>
            <ul>
                <li><a>Favoritos</a></li>
                <li><a>Buscar...</a></li>
            </ul>
        </div>
    </div>
    <div class="contenedor-centro">
        <div class="into-centro">
            <h1>Tus pisos y habitaciones</h1>
            <div class="box-mas-visitados">
                <img src="img/img-modelo.jpg" alt="habitación">
                <h2>Calle</h2>
                <div class="descripcion">
                    <p><img src="img/iconos-materiales/bandera.png" alt="habitación"> Ubicación</p><br>
                    <p><img src="img/iconos-materiales/visitas.png" alt="habitación"> Ubicación</p><br>
                </div>
                <div class="datos">
                    <p><img src="img/iconos-materiales/cama.png" alt="habitación"> Habitaciones |</p>
                    <p><img src="img/iconos-materiales/shower.png" alt="habitación"> Baños</p>
                </div>
            </div>
        </div>
    </div>
</body>