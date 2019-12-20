function completaPerfil()
{
    //
    var img = $('input[name=imagen]').val();
    var textarea = $('#descripcion').val();
    //
    var telefonos = [];
    //
    //Guardamos las los telefonos en un array
    var telf = $('input[name="telefono[]"]');
    if( telf.val() == '' || isNaN(telf.val()))
    {
        $(telf).notify("Indique un teléfono válido" , 'error');
        $(this).focus();
        return false;
    }
    telf.each(function(index)
    {
        //
        //

        telefonos.push($(telf[index]).val())
    });
    //
    //Formamso JSOM
    let oDatosJson = {imagenper: img , telefono: telefonos , descripcion: textarea }
    //
    //Accedemos a la petición
    $.ajax({
        url: '/peticiones/ajax/a_Completaperfil.php',
        type: 'POST',
        data: JSON.stringify(oDatosJson)
    })
        .done(function(oJson)
        {
            console.log(oJson);
            var oRespuesta = JSON.parse(oJson);
            if (oRespuesta.Estado == "OK")
            {
                window.open("/perfil.php?correo="+oRespuesta.Correo , "_self");
            } else {
                $.notify(oRespuesta.Mensaje , 'error')
            }
        });
}