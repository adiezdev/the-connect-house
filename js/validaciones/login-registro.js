/**
 * Validamos los campos del registro
 *
 * @param e
 * @returns {boolean}
 */
function validarCamposRegistro()
{
    var nombre = $('#registro #nombre').val().trim();
    var apellidos = $('#registro #apellidos').val();
    var correo = $('#registro #email').val().trim();
    var selector = $('#registro #selector').val();
    var ciudad = $('#registro #selectorciudad').val();
    var contrasena = $('#registro #password').val().trim();
    var contrasena2 = $('#registro #password2').val().trim();
    //Nombre
    if (nombre == '' || nombre.indexOf(" ") > -1)
    {
        $('#registro #nombre').notify("Indica el nombre" , "error");
        return false;
    }
    //Apellidos
    if (apellidos == '')
    {
        $('#registro #apellidos').notify("Indica los Apellidos" , "error");
        return false;
    }
    //Correo
    if (correo == '' || correo.indexOf(" ") > -1)
    {
        $('#registro #email').notify("Indica el correo" , "error");
        return false;
    }
    //Sexo
    if (selector == null)
    {
        $('#registro #selector').notify("Indica el Sexo" , "error");
        return false;
    }
    //ciudad
    if (ciudad == null)
    {
        $('#registro #selectorciudad').notify("Indica de donde eres" , "error");
        return false;
    }
    //Contraseña
    if (contrasena == '' || contrasena == '')
    {
        $('#registro #password').notify("No puedes dejar el campo vacío" , "error");
        return false;
    }
    if (contrasena.length < 8)
    {
        $('#registro #password').notify("Debe de tener más de 8 caracteres" , "error");
        return false;
    }
    if (contrasena.indexOf(" ") > -1) {
        $('#registro #password').notify("No puedes contener espacion" , "error");
        contrasena.focus();
        return false;
    } else {
        if (contrasena != contrasena2) {
            $('#registro #password').notify("No coinciden las contraseñas" , "error");
            return false;
        } else {

        }
    }
    //Formamos el array
    var oDatosJson = {
        Nombre: nombre,
        Apellidos: apellidos,
        Correo: correo,
        Sexo: selector,
        Password: contrasena,
        Ciudad: ciudad
    }
    //
    //Procesamos los datos
    $.ajax({
        url: '/the-connect-house/peticiones/ajax/a_UsuarioRegistro.php',
        type: 'POST',
        data: JSON.stringify(oDatosJson),
        beforeSend: function ()
        {
            $('#bnLogin').notify("Entrando..", 'info' ,{position: 'bottom center'});
        }
        })
        .done(function(oJson) {
            var oRespuesta = JSON.parse(oJson);
        if (oRespuesta.Estado == "OK")
        {
            var id = btoa("Usuario="+oRespuesta.IdUsuario);
            location.href = '/the-connect-house/completa-perfil.php?'+id+'';
            //window.open('/the-connect-house/completa-perfil.php?'+id+'' , '_self' );
        } else {
            alert(oRespuesta.Mensaje);
        }
        //console.log(oJson); //Debug
    });
}

/**
 * Validamos los campos del Login
 *
 * @param e
 * @returns {boolean}
 */
function validarCamposLogin()
{
    var sCorreo = $('#login #email').val().trim();
    var sContrasena = $('#login #pass').val().trim();
    //Correo
    if (sCorreo == '' || sCorreo.indexOf(" ") > -1)
    {
        $('#login #email').notify("Por favor indica el correo" , "error");
        return false;
    }
    if (sContrasena == '' || sContrasena == '')
    {
        $('#login #pass').notify("Por favor introduce una contraseña" , "error");
        return false;
    }
    //Formamos el array
    var oDatosJson = {
        Correo: sCorreo,
        Password: sContrasena
    };
    //
    //Procesamos los datos
    $.ajax({
            url: '/the-connect-house/peticiones/ajax/a_UsuarioLogin.php',
            type: 'POST',
            data: JSON.stringify(oDatosJson) ,
            beforeSend: function ()
            {
                $('#bnLogin').notify("Entrando...", 'info' ,{position: 'bottom center'});
            }
        })
        .done(function(oJson) {
            var oRespuesta = JSON.parse(oJson);
            if (oRespuesta.Estado == "OK")
            {
                window.open("/the-connect-house/perfil.php?correo="+sCorreo , "_self");
            } else {
                alert(oRespuesta.Mensaje);
            }
            //console.log(oJson);
        });
}