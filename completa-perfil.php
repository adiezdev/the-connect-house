<?php
//error_reporting( E_ALL );
//ini_set( 'display_errors' , true );
//ini_set( 'display_startup_errors' , true );
/*
    -------------------------------------
    Archivo de: Alejandro Díez
    GitHub: @adilosa95
    Proyecto: the-connect-house
    Nombre del archivo: completa-perfil.php
    -------------------------------------
*/
    require_once(__DIR__."/includes/header.php");
    require_once(__DIR__."/includes/constantes.php");
    require_once(__DIR__."/includes/sesion.php");
    //
    //Cogemos los estilos
    $estilos = array(
        ESTILOS_WIDGETS,
        ESTILOS_CASI
    );
    //
    //Se lo envíamos al metodo
    cabecera(TITULO_INDEX, $estilos, false);
?>
<body>
    <div class="content">
    <div class="contenedor-izquierdo">
        <h1 class="cabeceras">¡YA CASI HEMOS ACABADO!</h1>
        <img src="img/hand-cell.png" title="movil">
    </div>
        <div class="contenedor-centro">
            <label for="imgperfil">Imagen de perfil (opcional):</label><br><br>
            <img id="imgperfil" src="img/isset/isset-user.png"><br><br>
            <input type="file" name="archivos" id="inputperfil"/><br><br>
            <label for="">Descripción (opcional):</label><br><br>
            <textarea rows="15" cols="40" name="descripcion" form="campos-isset" placeholder="Inserta una descripción sobre tí..."></textarea>
            <form id="campos-isset" action="peticiones/rest/post_completaperfil.php" method="POST" >
                <div id="hiddens"></div>
                <input type="submit" value="Siguiente" name="siguiente" class="button">
            </form>
        </div>
    </div>
    <?php  require_once(__DIR__."/includes/footer.php"); ?>
</body>
<script src="<?php echo get_root_uri() ?>/the-connect-house/js/precarga-imagen-perfil.js"></script>
</html>