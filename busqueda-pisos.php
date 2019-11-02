<?php
require_once(__DIR__."/includes/header.php");
require_once(__DIR__."/includes/constantes.php");
$a = array(
    "widgets" => "widgets",
    "login" => "estilos-busqueda" 
);
$objects = json_decode(json_encode($a), FALSE);
cabecera(TITULO_BUSQUEDA,$objects,true);
?>
<body>
    <div class="contenedor-izquierdo">
        <div class="into-izquierdo">
            <div id="perfil">
                <img id="user" src="img/isset/isset-user.png" alt="imgen-perfil" srcset="">
                <h3>Nombre</h3>
            </div>
            <ul>
                <li><a>Inicio</a></li>
                <li><a>Cofiguración</a></li>
                <li><a>Favoritos</a></li>
            </ul>
        </div>

    </div>
    <div class="contenedor-centro">
        <div class="into-centro">
            <form>
                <input type="search" name="search" id="search" placeholder="Buscar...">
            </form>
            <h2 class="title">Resultados</h2>
            <div class="box-mas-visitados">
                
                <?php echo '<div class="likeit">'.file_get_contents("img/iconos-materiales/like.svg").'</div>'; ?>
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
            <div class="box-mas-visitados">
                <?php echo '<div class="likeit">'.file_get_contents("img/iconos-materiales/like.svg").'</div>'; ?>
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
            <div class="box-mas-visitados">
                <?php echo '<div class="likeit">'.file_get_contents("img/iconos-materiales/like.svg").'</div>'; ?>
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
            <div class="box-mas-visitados">
                <?php echo '<div class="likeit">'.file_get_contents("img/iconos-materiales/like.svg").'</div>'; ?>
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
    <div class="contenedor-derecho">
    <div id="mapid"></div>
    </div>
</body>
<script src="js/like.js"></script>
<script src="js/mapa.js"></script>
</html>