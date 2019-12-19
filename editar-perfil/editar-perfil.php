<?php
    //error_reporting( E_ALL );
    //ini_set( 'display_errors' , true );
    //ini_set( 'display_startup_errors' , true );
    /*
        -------------------------------------
        Archivo de: Alejandro Díez
        GitHub: @adilosa95
        Proyecto: the-connect-house
        Nombre del archivo: editar-perfil.php
        -------------------------------------
    */
    session_start();
    require_once(__DIR__ . "/../includes/sesion.php");
    //
    require_once(__DIR__ . "/../includes/header.php");
    require_once(__DIR__ . "/../includes/constantes.php");
    //
    require_once(__DIR__."/../bd/bd_usuario.php");
    require_once(__DIR__."/../bd/bd_telefonos.php");
    //
    //Formamos array de estilos
    $estilos = array(
            ESTILOS_WIDGETS ,
            ESTILOS_MAIN ,
            ESTILOS_REGISTRAR_PISO
        );
    //
    //Generamos la cabecera
    cabecera( 'Editar Perfil' , $estilos , false );
    //
    $oDatosUsuario = new Usuario();
    $aDbUsuario = $oDatosUsuario->getById( $_SESSION['idUsuario'] );
?>
<body>
    <div class="content">
            <div class="seccion 1" style="line-height: normal !important;">
                <h1>Editar Perfil</h1>
                <div id="perfil" >
                        <form method="post" >
                        <?php
                    //Datos perfil
                    foreach ( $aDbUsuario as $oDatoUsuario )
                    {
                        $Html = '<div class="izquierdo-perfil" >';
                        //Mostramos la imagen de perfil
                        $Html .= '<img id="imgperfil" class="user" src="/the-connect-house/'.$oDatoUsuario->Imgperfil.'" alt="imgen-perfil" srcset="">';
                        $Html .= '<div><label for="inputperf" class="editar-foto"><i class="fas fa-pen"></i>Subir Imagen</label><input type="file" name="archivos" id="inputperf"  style="display: none"/></div>';
                        $Html .= '<div class="eliminar-foto" onclick="eliminarImg()"><i class="fas fa-pen"></i>Eliminar fotpgrafía</div>';
                        $Html .= '<h3>Correo</h3><input id="correo" name="correo" class="credential" type="text" value="'.$oDatoUsuario->Correo.'"><br>';
                        $Html .= '</div>';
                        //
                        $Html  .= '<div class="derecha-perfil" >';
                        //Contenido de la derecha
                        $Html .= '<h3>Nombre</h3><input id="nombre" name="nombre" class="credential" type="text" value="'.$oDatoUsuario->Nombre.'"><br>';
                        $Html .= '<h3>Apellidos</h3><input id="apellidos" name="apellidos" class="credential" type="text" value="'.$oDatoUsuario->Apellidos.'"><br>';
                        $Html .= '<h3>Números de telefono</h3>';
                        //
                        //Sacamos el telelfono del usuario
                        $oDbTelefono = new Telefonos();
                        $aDbTelefonos = $oDbTelefono->getByIdUsuario($oDatoUsuario->idUsuario );
                        $Html .= '<div id="plus" style="cursor: pointer">+ Otro numero de teléfono</div>';
                        //
                        foreach ( $aDbTelefonos as $key=>$aDbTelefono)
                        {
                            $Html .= '<div><h3>Num '.($key+1).':</h3><input id="num" class="credential" name="telefono[]" type="text" value="'.$aDbTelefono->Numero.'"><div style="cursor: pointer" id="cross"><i class="fas fa-times" style="color: red"></i></div></div>';
                        }
                        $Html .= ' <div id="telefono2"></div>';
                        //
                        $Html .= '<select name="ciudad" id="selector">
                                 <option value="null">Seleccionar</option>
                                 <option value="Leon">León</option>
                                 <option value="Ponferrada">Ponferrada</option>
                                 </select>';
                        $Html .= '<h2>Descripción</h2>';
                        $Html .= '<textarea  class="credential" id="descripcion" style="height: 120px;!important;">'.$oDatoUsuario->Descripcion.'</textarea><br>';
                        //
                        $Html .= '</fieldset>';
                        //
                        $Html .= '</div>';
                        //
	                    echo $Html;
                    }
                    ?>
                            <div id="hiddens">

                            </div>
                </div>
            </div>
                <div class="guardardatos">
                <input type="button"  class="button" value="Guardar"  onclick="validarEdicionPerfi()">
                    <input type="button"  class="button"  value="Cancelar" onclick="window.history.back()" >
                </form>
                <input type="button"  class="eliminarpiso" value="ELIMINAR"  onclick="eliminarDatos()">
        </div>
    </div>
    <!--Footer-->
    <?php require_once(__DIR__ . "/../includes/footer.php"); ?>
</body>
<script src="<?php echo get_root_uri() ?>/the-connect-house/editar-perfil/js/precarga-imagen-perfil.js"></script>
<script src="<?php echo get_root_uri() ?>/the-connect-house/editar-perfil/js/validacion-edicion-perfil.js"></script>
<script>
    //
    //Añadir un segundo telefono
    $('#plus').click(function ()
    {
        var tlf = '<h3>Número nuevo</h3><input type="text" class="credential" id="telefono" name="telefono[]" placeholder="Numero de telefono">';
        $('#telefono2').html(tlf);
        $(this).hide();
    });
    $('#cross').click(function ()
    {
        $('#num').val('');
        $(this).hide();
    });

    var select = $('#selector option')
    select.each(function()
    {
      if($(this).val() == '<?php echo $aDbUsuario[0]->Ciudad ?>')
        {
            $(this).attr('selected', 'selected');
        }
    })
    function eliminarImg() {
        $('#imgperfil').attr('src' , '/the-connect-house/img/isset/isset-user.png');
        $('#hiddens').html('<input type="hidden" name="imagen" id="key.png" value="/the-connect-house/img/isset/isset-user.png">')
    }
</script>
