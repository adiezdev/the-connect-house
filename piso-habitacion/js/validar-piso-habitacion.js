/**
 * Valida los campos deuna habitación o piso
 *
 * @returns {boolean}
 */
function validarDatos()
{
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
    metros = metros.replace(',','.');
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
    var latitud = $('#latitud').val();
    var longitud = $('#longitud').val();
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
    //VALIDACIONES
   if( calle.trim() == '')
    {
        alert("Indica por favor la calle donde está");
        $('#calle').focus();
        return false;
    }
    if( numero.trim() == '' )
    {
        alert("Indica por favor el numero del por tal");
        $('#numero').focus();
        return false;
    }
    if( cp.trim() == '' || isNaN(toilet) )
    {
        alert("Indica el codigo postal");
        $('#cp').focus();
        return false;
    }
    if( descripcion.trim() == '')
    {
        alert("Indica la descripción");
        $('#descripcion').focus();
        return false;
    }
    if( metros.trim() == '' || isNaN(metros))
    {
        alert("Metros cuadrados del piso que sea válidos");
        $('#metros').focus();
        return false;
    }
    if( precio.trim() == '' || isNaN(precio))
    {
        alert("Indique un precio válido");
        $('#precio').focus();
        return false;
    }
    if(id == 2)
    {
        if( chicos.trim() == '' || chicas.trim() == '')
        {
            alert("Indique si hay gente en el piso");
            return false;
        }
    }
    if( toilet.trim() == '' || isNaN(toilet))
    {
        alert("Indique un precio válido");
        $('#toilet').focus();
        return false;
    }
    if(latitud == '' || longitud == '')
    {
        alert("Indique donde está en el mapa");
        return false;
    }
    if(imagenes == '' )
    {
        alert("Inserte alguna imagen");
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
        url: '/the-connect-house/piso-habitacion/ajax/a_savePisoHabitacion.php',
        type: 'POST',
        data: JSON.stringify(oDatosJson)
    })
        .done(function(oJson) {
            var oRespuesta = JSON.parse(oJson);
            if (oRespuesta.Estado == "OK")
            {
                window.open("/the-connect-house/perfil.php", "_self");
            } else {
                alert(oRespuesta.Mensaje);
            }
           //console.log(oJson);
        });
}