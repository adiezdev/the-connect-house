/**
 * Valida los campos deuna habitación o piso
 *
 * @returns {boolean}
 */
function validarDatos()
{
    //Cogemos todos los valores
    var id = $('#IdTipo').val();
    var calle = $('#calle').val();
    var numero = $('#numero').val();
    var cp = $('#cp').val();
    var ciudad = $('#selector').val();
    var descripcion = $('#descripcion').val();
    var metros = $('#metros').val();
    var precio = $('#precio').val();
    var chicos = $('#chicos').val();
    var chicas = $('#chicas').val();
    var toilet = $('#toilet').val();
    var habitaciones = $('#habitaciones').val();
    //
    //Para guardar en base de datos remplacamos la coma por el punto
    metros = metros.replace(',','.');
    precio = precio.replace(',','.');
    //
    //Array de comodidades
    var comodididades = [];
    //Recorremos las comodidades
    var c = $('.comodidad');
    c.each(function(index)
    {
        //Aquellas que tienen check las añadimos
        if ($(c[index]).prop('checked') == true)
        {
            comodididades.push($(c[index]).val());
        }
    });
    //
    //Array de normas
    var normas = [];
    //Recorremos las normas
    var n = $('.norma');
    n.each(function(index)
    {
        //Aquellas que tiene check las añadimos
        if ($(n[index]).prop('checked') == true)
        {
            normas.push($(n[index]).val());
        }
    });
    //
    //Recogemos la latitud y  longitud
    var latitud = $('#latitud').val();
    var longitud = $('#longitud').val();
    //Array de imagenes
    var imagenes  = [];
    //
    //Guardamos las imagenes en un array
    var imgs = $('input[name="imagenes[]"]');
    imgs.each(function(index)
    {
        imagenes.push($(imgs[index]).val())
    });
    //
    //VALIDACIONES
   if( calle.trim() == '')
    {
        $.notify("Indica por favor la calle donde está" , 'error');
        $('#calle').focus();
        return false;
    }
    if( numero.trim() == '' )
    {
        $.notify("Indica por favor el numero del por tal" , 'error');
        $('#numero').focus();
        return false;
    }
    if( cp.trim() == '' || isNaN(toilet) )
    {
        $.notify("Indica el codigo postal",'error');
        $('#cp').focus();
        return false;
    }
    if( descripcion.trim() == '')
    {
        $.notify("Indica la descripción",'error');
        $('#descripcion').focus();
        return false;
    }
    if( metros.trim() == '' || isNaN(metros))
    {
        $.notify("Metros cuadrados del piso que sea válidos",'error');
        $('#metros').focus();
        return false;
    }
    if( precio.trim() == '' || isNaN(precio))
    {
        $.notify("Indique un precio válido",'error');
        $('#precio').focus();
        return false;
    }
    if(id == 2)
    {
        if( chicos == '' || chicas == '')
        {
            $.notify("Indique si hay gente en el piso" , 'error');
            return false;
        }
    }
    if( toilet.trim() == '' || isNaN(toilet))
    {
        $.notify("Indique un precio válido" , 'error');
        $('#toilet').focus();
        return false;
    }
    if(latitud == '' || longitud == '')
    {
        $.notify("Indique donde está en el mapa" , 'error');
        return false;
    }
    if(imagenes == '' )
    {
        $.notify("Inserte alguna imagen" , 'error');
        return false;
    }
    //Formamos el JSON
    var oDatosJson =
        {
            Tipo: id,
            Calle: calle ,
            Numero: numero ,
            Cp: cp ,
            Ciudad: ciudad ,
            Descripcion: descripcion ,
            Metros: metros ,
            Precio: precio ,
            Chicos: chicos ,
            Chicas: chicas ,
            Toilet: toilet ,
            Habitaciones: habitaciones ,
            Comodidades: comodididades ,
            Normas: normas ,
            Latitud: latitud ,
            Longitud: longitud ,
            Imagenes: imagenes
        };
    //console.log(oDatosJson);
    //
    //Procesamos los datos
    $.ajax({
        url: '/piso-habitacion/ajax/a_savePisoHabitacion.php',
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