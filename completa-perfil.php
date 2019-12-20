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
    session_start();
    require_once(__DIR__."/includes/sesion.php");
    //
    //Hacemos ésto para sí solo poder entrar una manera segura
    //si tenemos una respuesta GET
    if( $_GET)
    {
        //Cogemos la url por si la encriptación iinterpresta mal
        $url= $_SERVER["REQUEST_URI"];
        //Cogemos el string a partir de la interrogación
        $urls = explode("?", $url);
        //decodificamos
        $decofificados = base64_decode($urls[1]);
    }
    else
    {
        header( "location:/index.php" );
        return;
    }
    //
    require_once(__DIR__."/includes/header.php");
    require_once(__DIR__."/includes/constantes.php");
    //
    //Cogemos los estilos
    $estilos = array(
        ESTILOS_WIDGETS,
        ESTILOS_MAIN,
        ESTILOS_REGISTRAR_PISO
    );
    //
    //Se lo envíamos al metodo
    cabecera(TITULO_INDEX, $estilos, false);
?>
<body>
    <div class="content">
        <!--Lado izquierdo-->
    <div class="contenedor-izquierdo">
        <div class="into-izquierdo">
            <h1 class="cabeceras">¡YA CASI HEMOS ACABADO!</h1>
            <img id="imgpertefl"  src="img/hand-cell.png" title="movil">
        </div>
    </div>
        <!--Lado izquierdo-->
        <div class="contenedor-centro">
            <div class="into-centro seccioncasi">
                <!--Imagen del perfil-->
                <label for="imgperfil">Imagen de perfil (opcional):</label><br><br>
                <img id="imgperfil" class="user" src="img/isset/isset-user.png"><br><br>
                <label for="inputperfil">Subir Imagen</label>
                <!--Formulario-->
                <input type="file" name="archivos" id="inputperfil"/><br><br>
                <form id="campos-isset">
                    <div id="plus" style="cursor: pointer">+ Otro numero de teléfono</div>
                    <label for="telefono">Número de telefono:</label><br><br>
                    <input type="text" class="credential" id="telefono" name="telefono[]" placeholder="Numero de telefono"><br>
                    <div id="telefono2"></div>
                    <label for="">Descripción (opcional):</label><br><br>
                    <textarea  class="credential" id="descripcion" name="user_post_textarea" maxlength="320" placeholder="Pon una descripción" style="height: 125px !important;" ></textarea>
                    <br><p>600\<span id="contador"> 600</span></p>
                    <div id="hiddens"></div>
                    <input type="button" value="Siguiente" name="siguiente" class="button" onclick="completaPerfil()">
                </form>
            </div>
        </div>
    </div>
    <!--Footer-->
    <?php  require_once(__DIR__."/includes/footer.php"); ?>
</body>
<!--Scripts necesarios-->
<script src="<?php echo get_root_uri() ?>/js/precarga-imagen-perfil.js"></script>
<script src="<?php echo get_root_uri() ?>/js/validaciones/completa-perfil.js"></script>
<script>
    $(document).ready(function(){
        //Máixmo de caracteres en la descripción
        var maximo = 600;
        //Si detecta el teclado
        $('#descripcion').keyup(function()
        {
            //Congemos de la descipcion la longitud del valor
            var caracteres = $(this).val().length;
            //se lo restamos al maximo
            var restantes = maximo - caracteres;
            //lo mostramos
            $('#contador').html(restantes);
        });
    });
    //
    //Añadir un segundo telefono
    $('#plus').click(function ()
    {
        var tlf = '<input type="text" class="credential" id="telefono" name="telefono[]" placeholder="Numero de telefono">';
        $('#telefono2').html(tlf);
    });
</script>
</html>