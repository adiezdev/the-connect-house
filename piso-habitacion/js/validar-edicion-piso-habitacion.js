/**
 * Valida los datos de edición de un piso o una habitación
 *
 * @returns {boolean}
 */
function validarDatosEditados()
{
    var id = $('#IdTipo').val();
    var idpiso = $('#IdPiso').val();
    var descripcion = $('#descripcion').val();
    var precio = $('#precio').val();
    var chicos = $('#Chicos').val();
    var chicas = $('#Chicas').val();
    //
    precio = precio.replace(',','.');
    //
    //
    var comodididades = [];
    //
    var c = $('.comodidad');
    c.each(function(index)
    {
        if ($(c[index]).prop('checked') == true)
        {
            comodididades.push($(c[index]).val());
        }
    });
    //
    var normas = [];
    //
    var n = $('.norma');
    n.each(function(index)
    {
        if ($(n[index]).prop('checked') == true)
        {
            normas.push($(n[index]).val());
        }
    });
    //
    var imagenes  = [];
    //
    //Guardamos las imagenes en un array
    var imgs = $('input[name="imagenes[]"]');
    imgs.each(function(index)
    {
        imagenes.push($(imgs[index]).val())
    });
    //
    if( descripcion.trim() == '')
    {
        $.notify("Indica la descripción" , 'error');
        $('#descripcion').focus();
        return false;
    }
    if( precio.trim() == '' || isNaN(precio))
    {
        $.notify("Indique un precio válido" , 'error');
        $('#precio').focus();
        return false;
    }
    if(id == 2)
    {
        if( chicos == '' || chicas == '')
        {
            $.notify("Indique si hay gente en el piso");
            return false;
        }
    }
    //Formamos el JSON
    var oDatosJson =
        {
            Tipo: id,
            IdPipo: idpiso,
            Descripcion: descripcion ,
            Precio: precio ,
            Chicos: chicos ,
            Chicas: chicas ,
            Comodidades: comodididades ,
            Normas: normas ,
            Imagenes: imagenes
        };
    //
    $.ajax({
        url: '/piso-habitacion/ajax/a_editarPisoHabitacion.php',
        type: 'POST',
        data: JSON.stringify(oDatosJson),
        beforeSend: function ()
        {
            $.notify("Se está guardando. Espere...", 'info' ,{position: 'bottom center'});
        }
    })
        .done(function(oJson) {
            //console.log(oJson);
            var oRespuesta = JSON.parse(oJson);
            if (oRespuesta.Estado == "OK")
            {
                window.open("/index.php", "_self");
            } else {
                //alert(oRespuesta.Mensaje);
                $.notify(oRespuesta.Mensaje , 'error')
            }
        });
}