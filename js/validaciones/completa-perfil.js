function completaPerfil()
{
    //
    var img = $('input[name=imagen]').val();
    var telf = $('#telefono').val();
    var textarea = $('#descripcion').val();
    //
    //Formamso JSOM
    let oDatos = {img:img , telefono: telf , descripcion: textarea }
    //
    //Accedemos a la petición
    $.ajax({
        url: '/the-connect-house/peticiones/ajax/a_Completaperfil.php',
        type: 'POST',
        data: JSON.stringify(oDatosJson)
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