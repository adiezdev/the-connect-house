//Nicializamos la pantalla de login
$("#registro").css("display", "none");

$(function() {
    $('#atras').click(function(e) {
        $("#registro").fadeOut(100);
        $("#login").delay(100).fadeIn(100);
    });
    $('#registrarse').click(function(e) {
        $("#login").fadeOut(100);
        $("#registro").delay(100).fadeIn(100);
    });
    $('#registro').click(function(e) {
        validarCamposRegistro(e);
    });
    $('#bnLogin').click(function(e) {
        validarCamposLogin(e);
    });
});
/**
 * @param  {} e
 */
function validarCamposRegistro(e) {
    var nombre = $('#registro #nombre').val().trim();
    var apellidos = $('#registro #apellidos').val().trim();
    var correo = $('#registro #email').val().trim();
    var selector = $('#registro #email').val();
    var contrasena = $('#registro #password').val().trim();
    var contrasena2 = $('#registro #password2').val().trim();
    //Nombre
    if (nombre == '' || nombre.indexOf(" ") > -1) {
        alert("Indica el nombre");
        e.preventDefault();
        nombre.focus();
        return false;
    }
    //Apellidos
    if (apellidos == '') {
        alert("Indica los Apellidos");
        e.preventDefault();
        apellidos.focus();
        return false;
    }
    //Correo
    if (correo == '' || correo.indexOf(" ") > -1) {
        alert("Indica el correo");
        e.preventDefault();
        correo.focus();
        return false;
    }
    //Sexo
    if (selector == null) {
        alert("Indica los Apellidos");
        e.preventDefault();
        correo.focus();
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
        contrasena.focus();
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
            contrasena.focus();
            return false;
        } else {

        }
    }
    return true;
}

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
            url: '/the-conect-house/ajax/aloginUsuario.php',
            type: 'POST',
            contentType: "application/json",
            data: JSON.stringify(oDatosJson),
        })
        .fail(function(oJson) {
            console.log("Error");
        })
        .done(function(oJson) {
            console.log(oJson);
            alert(oJson);
        });
}