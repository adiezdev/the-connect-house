<?php
require_once(__DIR__."/includes/header.php");
require_once(__DIR__."/includes/constantes.php");
require_once(__DIR__."/includes/sesion.php");
require_once( __DIR__."/bd/bd_usuario.php" );
//
// Llamamos a los estilos que necesitamos
$a = array(
    "widgets" => ESTILOS_WIDGETS,
    "busqueda" => ESTILOS_BUSQUEDA
);
//Codificamos los objetos
$objects = json_decode(json_encode($a), FALSE);
//
//Se lo envíamos al metodo
cabecera(TITULO_BUSQUEDA,$objects,true);
//
//Extraemos los datos del usuario por si id
$dbUsuario = new Usuario();

?>
<body>
    <div class="contenedor-izquierdo">
        <div class="into-izquierdo">
            <div id="perfil">
                <img id="user" src="img/isset/isset-user.png" alt="imgen-perfil" srcset="">
                <h3><?php echo $_SESSION['idUsuario'] ?></h3>
            </div>
            <ul>
                <li><a>Inicio</a></li>
                <li><a>Cofiguración</a></li>
                <li><a>Favoritos</a></li>
                <li><a>Perfil</a></li>
                <li><a>Buscar...</a></li>
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
                    <p><i class="fas fa-map-marker-alt"></i> Ubicación</p><br>
                    <p><i class="fas fa-eye"></i> Ubicación</p><br>
                </div>
                <div class="datos">
                    <p><i class="fas fa-bed"></i> Habitaciones |</p>
                    <p><i class="fas fa-bath"></i> Baños</p>
                </div>
            </div>
            <div class="box-mas-visitados">
                <?php echo '<div class="likeit">'.file_get_contents("img/iconos-materiales/like.svg").'</div>'; ?>
                <img src="img/img-modelo.jpg" alt="habitación">
                <h2>Calle</h2>
                <div class="descripcion">
                    <p><i class="fas fa-map-marker-alt"></i> Ubicación</p><br>
                    <p><i class="fas fa-eye"></i> Ubicación</p><br>
                </div>
                <div class="datos">
                    <p><i class="fas fa-bed"></i> Habitaciones |</p>
                    <p><i class="fas fa-bath"></i> Baños</p>
                </div>
            </div>
            <div class="box-mas-visitados">
                <?php echo '<div class="likeit">'.file_get_contents("img/iconos-materiales/like.svg").'</div>'; ?>
                <img src="img/img-modelo.jpg" alt="habitación">
                <h2>Calle</h2>
                <div class="descripcion">
                    <p><i class="fas fa-map-marker-alt"></i> Ubicación</p><br>
                    <p><i class="fas fa-eye"></i>Ubicación</p><br>
                </div>
                <div class="datos">
                    <p><i class="fas fa-bed"></i> Habitaciones |</p>
                    <p><i class="fas fa-bath"></i> Baños</p>
                </div>
            </div>
            <div class="box-mas-visitados">
                <?php echo '<div class="likeit">'.file_get_contents("img/iconos-materiales/like.svg").'</div>'; ?>
                <img src="img/img-modelo.jpg" alt="habitación">
                <h2>Calle</h2>
                <div class="descripcion">
                    <p><i class="fas fa-map-marker-alt"></i> Ubicación</p><br>
                    <p><i class="fas fa-eye"></i> Ubicación</p><br>
                </div>
                <div class="datos">
                    <p><i class="fas fa-bed"></i> Habitaciones |</p>
                    <p><i class="fas fa-bath"></i> Baños</p>
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