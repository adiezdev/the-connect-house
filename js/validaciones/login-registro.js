//Nicializamos la pantalla de login
$("#registro").css("display", "none");
/**
 * Acciones para mostrar os campos del registro o login
 * y los botone de login y regiistro
 */
$(function() {
    $('#atras').click(function(e) {
        $("#registro").fadeOut(100);
        $("#login").delay(100).fadeIn(100);
    });
    $('#registrarse').click(function(e) {
        $("#login").fadeOut(100);
        $("#registro").delay(100).fadeIn(100);
    });
    $('#bnRegistro').click(function(e) {
        validarCamposRegistro(e);
    });
    $('#bnLogin').click(function(e) {
        validarCamposLogin(e);
    });
});
/**
 * Validamos los campos del registro
 *
 * @param e
 * @returns {boolean}
 */
function validarCamposRegistro(e) {
    var nombre = $('#registro #nombre').val().trim();
    var apellidos = $('#registro #apellidos').val();
    var correo = $('#registro #email').val().trim();
    var selector = $('#registro #selector').val();
    var contrasena = $('#registro #password').val().trim();
    var contrasena2 = $('#registro #password2').val().trim();
    //Nombre
    if (nombre == '' || nombre.indexOf(" ") > -1) {
        alert("Indica el nombre");
        e.preventDefault();
        return false;
    }
    //Apellidos
    if (apellidos == '') {
        alert("Indica los Apellidos");
        e.preventDefault();
        return false;
    }
    //Correo
    if (correo == '' || correo.indexOf(" ") > -1) {
        alert("Indica el correo");
        e.preventDefault();
        return false;
    }
    //Sexo
    if (selector == null) {
        alert("Indica los Apellidos");
        e.preventDefault();
        return false;
    }
    //Contraseña
    if (contrasena == '' || contrasena == '') {
        alert("No puedes dejar el campo vacío");
        e.preventDefault();
        return false;
    }
    if (contrasena.length < 8) {
        alert("Tiene que constar con mas de 8 caracteres");
        e.preventDefault();
        return false;
    }
    if (contrasena.indexOf(" ") > -1) {
        alert("No puede contener espocios");
        e.preventDefault();
        contrasena.focus();
        return false;
    } else {
        if (contrasena != contrasena2) {
            alert("Los dos campos no coinciden");
            e.preventDefault();
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
    }
    //
    //Procesamos los datos
    $.ajax({
        url: '/the-connect-house/peticiones/ajax/a_UsuarioRegistro.php',
        type: 'POST',
        data: JSON.stringify(oDatosJson)
        })
        .done(function(oJson) {
        var oRespuesta = JSON.parse(oJson);
        if (oRespuesta.Estado == "OK") {
            window.open("/the-connect-house/completa-perfil.php", "_self");
        } else {
            alert(oRespuesta.Mensaje);
        }
        //console.log(oJson); //Debug
    });;
}

/**
 * Validamos los campos del Login
 *
 * @param e
 * @returns {boolean}
 */
function validarCamposLogin(e) {
    var sCorreo = $('#login #email').val().trim();
    var sContrasena = $('#login #pass').val().trim();
    //Correo
    if (sCorreo == '' || sCorreo.indexOf(" ") > -1) {
        alert("Por favor indica el correo");
        e.preventDefault();
        return false;
    }
    if (sContrasena == '' || sContrasena == '') {
        alert("Por favor introduce una contraseña");
        e.preventDefault();
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
            data: JSON.stringify(oDatosJson)
        })
        .done(function(oJson) {
            var oRespuesta = JSON.parse(oJson);
            if (oRespuesta.Estado == "OK") {
                window.open("/the-connect-house/perfil.php", "_self");
            } else {
                alert(oRespuesta.Mensaje);
            }
            //console.log(oJson);
        });
}