<?php
    //error_reporting( E_ALL );
    //ini_set( 'display_errors' , true );
    //ini_set( 'display_startup_errors' , true );
    /*
        -------------------------------------
        Archivo de: Alejandro Díez
        GitHub: @adilosa95
        Proyecto: the-connect-house
        Nombre del archivo: cambiar-password.php
        -------------------------------------
    */
    session_start();
    require_once(__DIR__ . "/../includes/sesion.php");
    //
    require_once(__DIR__ . "/../includes/header.php");
    require_once(__DIR__ . "/../includes/constantes.php");
    //
    require_once(__DIR__."/../bd/bd_usuario.php");
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
        <h1>Editar Contraseña</h1>
        <div id="perfil" >
            <form method="post" >
                    <div class="izquierdo-perfil" >
                    <h3>Contraseña Antigua</h3><input id="pass" name="contra" class="credential" type="text" ><br>
                    <h3>Contraseña Nueva</h3><input id="passn" name="contra2" class="credential" type="text"><br>
                    </div>
        </div>
    </div>
    <div class="guardardatos">
        <input type="button"  class="button" value="Guardar Contraseña"  onclick="validarPass()"><br><br>
        <input type="button"  class="button"  value="Cancelar" onclick="window.history.back()" >
        </form>
    </div>
</div>
<!--Footer-->
<?php require_once(__DIR__ . "/../includes/footer.php"); ?>
</body>
<script src="<?php echo get_root_uri() ?>/editar-perfil/js/validacion-edicion-perfil.js"></script>
<script>
    function validarPass()
    {
        var anterior = $('#pass').val();
        var nueva = $('#passn').val();
        //
        if(anterior == '')
        {
            $('#pass').notify('No se puede dejar vacio','error');
            return false;
        }
        if(nueva == '')
        {
            $('#passn').notify('No se puede dejar vacio','error');
            return false;
        }
        if (nueva.length < 8)
        {
            $('#passn').notify("Debe de tener más de 8 caracteres" , "error");
            return false;
        }
        //
        var oDatosJson =
            {
                passwordanterior: anterior,
                passwordnueva: nueva
            };
        //
        $.ajax({
            url: '/editar-perfil/ajax/a_editarPassword.php',
            type: 'POST',
            data: JSON.stringify(oDatosJson),
            beforeSend: function ()
            {
                $.notify("Se está guardando. Espere...", 'info' ,{position: 'bottom center'});
            }
        })
            .done(function(oJson) {
                console.log(oJson);
                var oRespuesta = JSON.parse(oJson);
                if (oRespuesta.Estado == "OK")
                {
                    window.location.href = '/index.php';
                } else {
                    //alert(oRespuesta.Mensaje);
                    $.notify(oRespuesta.Mensaje , 'error')
                }
            });
    }
</script>
