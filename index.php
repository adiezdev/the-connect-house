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
    session_start();
    require_once(__DIR__."/includes/header.php");
    require_once(__DIR__."/includes/constantes.php");
    require_once(__DIR__."/includes/tarjetas.php");
    //
    //Accedemos a datos
    require_once(__DIR__."/bd/bd_pisos.php");
    require_once(__DIR__."/bd/bd_imagenespiso.php");
    require_once(__DIR__."/bd/bd_usuario.php");
    //
    $oDbPisosHabitaciones = new Pisos();
    $aDbPisosHabitaciones = $oDbPisosHabitaciones->getPaginado();
    //
    //Configuramos los estilos que necesitamos
    $estilos = array(
            ESTILOS_WIDGETS,
            ESTILOS_MAIN,
            ESTILOS_MENU,
            ESTILOS_SLIDER_INICIO
    );
    //
    //Generamos la cabecera
    cabecera(TITULO_INDEX , $estilos ,false);
?>
<body>
<!--Menu-->
<?php require_once(__DIR__ . '/includes/menu.php'); ?>
    <div class="content">
        <!--Imagen principal-->
    <img class="img-fondo" src="img/img-inicio.jpg" srcset="img/img-inicio.jpg 200w">
        <!--Buscador-->
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
            <button class="button" id="btbuscador">Buscar <img src="img/iconos-materiales/lupa.png" alt="Buscar"></button>
        </form>
    </div>
        <!--Pisos/habitaciones añadidos reciente mente solo se ven 9 ultimos-->
    <div class="titulos">
        <h2>Pisos y Habitaciones recientes</h2>
    </div>
    <div class="seccion">
        <?php
            //
            //Recorremos los datos de los pisos
            getPisosHabitacionesVertical( $aDbPisosHabitaciones );
        ?>
        <!--Flechas de siguientes y anteriores pisos/habitaciones-->
    </div>
        <div class="flechas">
            <input type="hidden" value="3" id="cont" name="cont">
            <div class="izquierda" onclick="PaginadoAnterior()">&#10094;</div>
            <div class="derecha" onclick="PaginadoSiguiente()">&#10095;</div>
        </div>
        <!-- Busqueda por ciudad -->
    <div class="titulos">
        <h2 id="titulos">¿En qué ciudad buscas?</h2>
    </div>
    <div class="seccion">
        <div class="box-ciudades" onclick="window.open('buscar.php?Ciudad=León', '_self');">
            <div>
                <button class="button">Enseñame que hay</button>
            </div>
            <div class="descripcion">
                <h1>Léon</h1>
            </div>
            <img src="img/ciudades/catedral-leon.jpg" alt="" srcset="">
        </div>
        <div class="box-ciudades"  onclick="window.open('buscar.php?Ciudad=Ponferrada', '_self');">
            <div>
                <button class="button">Enseñame que hay</button>
            </div>
            <div class="descripcion">
                <h1>Ponferrada</h1>
            </div>
            <img src="img/ciudades/castillo-ponferrada.jpg" alt="" srcset="">
        </div>
    </div>
    </div>
<!--Footer-->
    <?php  require_once(__DIR__."/includes/footer.php"); ?>
</body>
<!--Scripts-->
<script src="<?php echo get_root_uri() ?>/js/menu.js"></script>
<script src="<?php echo get_root_uri() ?>/js/paginado-pisos.js"></script>
<script>
    /**
     * Función para mostrar valor del slider del precio
     */
    $(document).ready(function() {
        //Posición incial
        $('#slider').val(0);
        //Acción de cambio
        $('#slider').on("input change", function() {
            //Capturamos el valor actual
            var valor = $(this).val();
            //Lo mostramos
            $('#preciospan').html(valor)
        });
        //
        $('#btbuscador').click(function () {
            $(this).notify('Buscando...' , 'success')
        });
    });
</script>
</html>