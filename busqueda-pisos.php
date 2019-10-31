<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Resultados de busqueda</title>
    <link rel="stylesheet" href="css/widgets.css">
    <link rel="stylesheet" href="css/estilos-busqueda.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
   <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
   integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
   crossorigin=""></script>
</head>

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