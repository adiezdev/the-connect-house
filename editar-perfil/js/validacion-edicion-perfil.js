
function validarEdicionPerfi()
{
    if( $('input[name=imagen]').val() !== 'undefined')
    {
        var imga = $('input[name=imagen]').val();
    }
    //
    var correo = $('#correo').val();
    var textarea = $('#descripcion').val();
    var nombre = $('#nombre').val();
    var apellidos = $('#apellidos').val();
    var ciudad = $('#selector').val();
    //
    var telefonos = [];
    //
    //Guardamos las los telefonos en un array
    var telf = $('input[name="telefono"]');
    if( telf.val() == '' || isNaN(telf.val()))
    {
        alert("Indique un teléfono válido");
        $(this).focus();
        return false;
    }
    telf.each(function(index)
    {
        //
        telefonos.push($(telf[index]).val())
    });
    //Formamos el JSON
    var oDatosJson =
        {
            Correo: correo,
            Nombre: nombre,
            Apellidos: apellidos,
            Ciudad: ciudad,
            Descripcion: textarea ,
            Imagen: imga,
            Telf: telefonos
        };
    //
    $.ajax({
        url: '/the-connect-house/editar-perfil/ajax/a_editarUsuario.php',
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
                window.open("/the-connect-house/index.php", "_self");
            } else {
                alert(oRespuesta.Mensaje);
            }
        });
}