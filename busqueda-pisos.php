<?php
//error_reporting( E_ALL );
//ini_set( 'display_errors' , true );
//ini_set( 'display_startup_errors' , true );
/*
    -------------------------------------
    Archivo de: Alejandro Díez
    GitHub: @adilosa95
    Proyecto: the-connect-house
    Nombre del archivo: busqueda-pisos.php
    -------------------------------------
*/
    require_once(__DIR__."/includes/header.php");
    require_once(__DIR__."/includes/constantes.php");
    require_once(__DIR__."/includes/sesion.php");
    require_once(__DIR__."/bd/bd_usuario.php" );
    //
    //Configuramos los estilos que necesitamos
    $estilos = array(
        ESTILOS_WIDGETS,
        ESTILOS_BUSQUEDA
    );
    //
    //Generamos la cabecera
    cabecera(TITULO_BUSQUEDA , $estilos ,true);
    //
    //Extraemos los datos del usuario por si id
    $bdUsuario = new Usuario();
?>
<body>
  <div class="content">
    <div class="contenedor-izquierdo">
        <div class="into-izquierdo">
            <div id="perfil">
                <img id="user" src="img/isset/isset-user.png" alt="imgen-perfil" srcset="">
                <h3><?php echo $_SESSION['correo'] ?></h3>
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


  </div>
  <?php  require_once(__DIR__."/includes/footer.php"); ?>
</body>
<script src="<?php echo get_root_uri() ?>/the-connect-house/js/like.js"></script>
<script src="<?php echo get_root_uri() ?>/the-connect-house/js/mapa.js"></script>
</html>