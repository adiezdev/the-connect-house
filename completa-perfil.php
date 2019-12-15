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
        ESTILOS_MAIN,
        ESTILOS_REGISTRAR_PISO
    );
    //
    //Se lo envíamos al metodo
    cabecera(TITULO_INDEX, $estilos, false);
?>
<body>
    <div class="content">
    <div class="contenedor-izquierdo">
        <div class="into-izquierdo">
            <h1 class="cabeceras">¡YA CASI HEMOS ACABADO!</h1>
            <img id="imgpertefl"  src="img/hand-cell.png" title="movil">
        </div>
    </div>
        <div class="contenedor-centro">
            <div class="into-centro seccioncasi">
                <label for="imgperfil">Imagen de perfil (opcional):</label><br><br>
                <img id="imgperfil" src="img/isset/isset-user.png"><br><br>
                <label for="inputperfil">Subir Imagen</label>
                <input type="file" name="archivos" id="inputperfil"/><br><br>
                <form id="campos-isset" action="peticiones/ajax/a_Completaperfil.php" method="POST" >
                    <div id="plus" style="cursor: pointer">+ Otro numero de teléfono</div>
                    <label for="telefono">Número de telefono (opcional):</label><br><br>
                    <input type="text" class="credential" id="telefono" name="telefono[]" placeholder="Numero de telefono"><br>
                    <div id="telefono2"></div>
                    <label for="">Descripción (opcional):</label><br><br>
                    <textarea  class="credential" id="descripcion" name="user_post_textarea" maxlength="320" placeholder="Pon una descripción" style="height: 125px !important;" ></textarea>
                    <br><p>600\<span id="contador"> 600</span></p>
                    <div id="hiddens"></div>
                    <input type="button" value="Siguiente" name="siguiente" class="button">
                </form>
            </div>
        </div>
    </div>
    <?php  require_once(__DIR__."/includes/footer.php"); ?>
</body>
<script src="<?php echo get_root_uri() ?>/the-connect-house/js/precarga-imagen-perfil.js"></script>
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