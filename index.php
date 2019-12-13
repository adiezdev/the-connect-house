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
    //Accedemos a datos
    require_once(__DIR__."/bd/bd_pisos.php");
    //
    $oDbPisosHabitaciones = new Pisos();
    $aDbPisosHabitaciones = $oDbPisosHabitaciones->getAll();
    //
    //Configuramos los estilos que necesitamos
    $estilos = array(
            ESTILOS_WIDGETS,
            ESTILOS_MAIN
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
        <form action="buscar.php" method="get">
            <input type="checkbox" name="Pisos" id="piso" value="1" >
            <label for="">Pisos</label>
            <input type="checkbox" name="Habitaciones" id="piso" value="2" >
            <label for="">Habitaciones</label>
            <div class="slidercontenedor">
                <h3>Precio: <span id="preciospan">0</span> €</h3>
                <input type="range" name="Precio" id="slider" min="0" max="1000" value="0" step="10">
            </div>
            <select name="Ciudad" id="selector" >
                <option value="0">¿Qué ciudad?</option>
                <option value="León">León</option>
                <option value="Ponferrada">Ponferrada</option>
            </select>
            <input type="search" name="Buscar" id="search" placeholder="Busca la calle que deseas">
            <button class="button">Buscar <img src="img/iconos-materiales/lupa.png" alt="Buscar"></button>
        </form>
    </div>
    <div class="titulos">
        <h2>Pisos y Habitaciones recientes</h2>
    </div>
    <div class="seccion">
        <?php
            foreach( $aDbPisosHabitaciones as $aDbPisosHabitacion)
            {
                $Html  = '<div class="box-pisos-habitacones">';
                $Html .= '<img src="img/img-modelo.jpg" alt="Piso">';
                $Html .= '<div class="descripcion">';
                $Html .= '<h3>Descripcion</h3>';
                $Html .= '<p><i class="fas fa-map-marker-alt"></i>Ubicación</p>';
                $Html .= '<p class="precio">Precio</p>';
                $Html .= '</div>';
                $Html .= '<button class="button">Me interesa</button>';
                $Html .= '</div>';
                echo $Html;
            }
        ?>
    </div>
    <div class="titulos">
        <h2 id="titulos">¿En qué ciudad buscas?</h2>
    </div>
    <div class="seccion">
        <div class="box-ciudades" onclick="window.open('buscar.php?ciudad=León', '_self');">
            <div>
                <button class="button">Enseñame que hay</button>
            </div>
            <div class="descripcion">
                <h1>Léon</h1>
            </div>
            <img src="img/ciudades/catedral-leon.jpg" alt="" srcset="">
        </div>
        <div class="box-ciudades"  onclick="window.open('buscar.php?ciudad=Ponferrada', '_self');">
            <div>
                <button class="button">Enseñame que hay</button>
            </div>
            <div class="descripcion">
                <h1>Ponferrada</h1>
            </div>
            <img src="img/ciudades/castillo-ponferrada.jpg" alt="" srcset="">
        </div>
    </div>
    <?php  require_once(__DIR__."/includes/footer.php"); ?>
</body>
<script>
    /**
     * Función para mostrar valor del slider del precio
     */
    $(document).ready(function() {
        //Posiición incial
        $('#slider').val(0);
        //Acción de cambio
        $('#slider').on("input change", function() {
            //Capturamos el valor actual
            var valor = $(this).val();
            //Lo mostramos
            $('#preciospan').html(valor)
        });
    });
</script>
</html>