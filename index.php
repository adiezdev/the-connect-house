<?php
//error_reporting( E_ALL );
//ini_set( 'display_errors' , true );
//ini_set( 'display_startup_errors' , true );
/*
    -------------------------------------
    Archivo de: Alejandro Díez
    GitHub: @adilosa95
    Proyecto: the-connect-house
    Nombre del archivo: index.php
    -------------------------------------
*/
    require_once(__DIR__."/includes/header.php");
    require_once(__DIR__."/includes/constantes.php");
    //
    //Configuramos los estilos que necesitamos
    $estilos = array(
            ESTILOS_WIDGETS,
            ESTILOS_IDEX
    );
    //
    //Generamos la cabecera
    cabecera(TITULO_INDEX , $estilos ,false);
?>
<body>
    <nav>

    </nav>
    <img class="img-fondo" src="img/img-inicio.jpg" srcset="img/img-inicio.jpg 200w">
    <div class="buscador">
        <form action="" method="get">
            <input type="checkbox" name="Pisos" id="piso">
            <label for="">Pisos</label>
            <input type="checkbox" name="Habitaciones" id="piso">
            <label for="">Habitaciones</label>
            <div class="slidercontenedor">
                <h3>Precio: <span id="preciospan">0</span> €</h3>
                <input type="range" name="precio" id="slider" min="0" max="1000" value="0" step="10">
            </div>
            <select name="ciudad" id="selector">
                <option value="1">León</option>
                <option value="2">Ponferrada</option>
            </select>
            <input type="search" name="Buscar" id="search" placeholder="Buscas lo que quieras">
            <button class="button">Buscar <img src="img/iconos-materiales/lupa.png" alt="Buscar"></button>
        </form>
    </div>
    <div class="titulos">
        <h2>Pisos y Habitaciones recientes</h2>
    </div>
    <div class="seccion">
        <div class="box-pisos-habitacones">
            <img src="img/img-modelo.jpg" alt="Piso">
            <div class="descripcion">
                <h3>Descripción</h3>
                <p><i class="fas fa-map-marker-alt"></i>Ubicación</p>
                <p class="precio">Precio</p>
            </div>
            <button class="button">Me interesa</button>
        </div>
        <div class="box-pisos-habitacones">
            <img src="img/img-modelo.jpg" alt="Piso">
            <div class="descripcion">
                <h3>Descripción</h3>
                <p><i class="fas fa-map-marker-alt"></i>Ubicación</p>
                <p class="precio">Precio</p>
            </div>
            <button class="button">Me interesa</button>
        </div>
        <div class="box-pisos-habitacones">
            <img src="img/img-modelo.jpg" alt="Piso">
            <div class="descripcion">
                <h3>Descripción</h3>
                <p><i class="fas fa-map-marker-alt"></i>Ubicación</p>
                <p class="precio">Precio</p>
            </div>
            <button class="button">Me interesa</button>
        </div>
    </div>
    <div class="titulos">
        <h2 id="titulos">¿En qué ciudad buscas?</h2>
    </div>
    <div class="seccion">
        <div class="box-ciudades">
            <div class="descripcion">
                <h1>Léon</h1>
            </div>
            <img src="img/ciudades/catedral-leon.jpg" alt="" srcset="">
            <button class="button">Enseñame que hay</button>
        </div>
        <div class="box-ciudades">
            <div class="descripcion">
                <h1>Ponferrada</h1>
            </div>
            <img src="img/ciudades/castillo-ponferrada.jpg" alt="" srcset="">
            <button class="button">Enseñame que hay</button>
        </div>
    </div>
    <div class="titulos">
        <h2>Los más vistos</h2>
        <div class="seccion">
            <div class="box-mas-visitados">
                <img src="img/img-modelo.jpg" alt="habitación">
                <h2>Calle</h2>
                <div class="descripcion">
                    <p><i class="fas fa-map-marker-alt"></i> Ubicación</p><br>
                    <p><i class="fas fa-eye"></i>  Ubicación</p><br>
                </div>
                <div class="datos">
                    <p><i class="fas fa-bed"></i> Habitaciones |</p>
                    <p><i class="fas fa-bath"></i> Baños</p>
                </div>
            </div>
            <div class="box-mas-visitados">
                <img src="img/img-modelo.jpg" alt="habitación">
                <h2>Calle</h2>
                <div class="descripcion">
                    <p><i class="fas fa-map-marker-alt"></i> Ubicación</p><br>
                    <p><i class="fas fa-eye"></i> Ubicación</p><br>
                </div>
                <div class="datos">
                    <p><i class="fas fa-bed"></i> Habitaciones |</p>
                    <p> Baños</p>
                </div>
            </div>
            <div class="box-mas-visitados">
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
    <script src="js/slider-verde.js"></script>
</body>

</html>