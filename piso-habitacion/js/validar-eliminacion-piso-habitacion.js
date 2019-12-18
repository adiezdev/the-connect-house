/**
 * Valida los datos de edición de un piso o una habitación
 *
 * @returns {boolean}
 */
function eliminarDatos()
{
    //
    var id = $('#IdTipo').val();
    var idpiso = $('#IdPiso').val();
    //Array de normas
    var Imagenes = [];
    //Recorremos los contenedores
    var contenedor = $('.contenedores');
    contenedor.each(function(index)
    {

        Imagenes.push($(contenedor[index]).find('#imgeliminar').attr('src'));
    });
    //
    //Formamos el JSON
    var oDatosJson =
        {
            Tipo: id,
            IdPipo: idpiso,
            Imagenes:Imagenes
        };
    //
    $.ajax({
        url: '/the-connect-house/piso-habitacion/ajax/a_deletePisoHabitacion.php',
        type: 'POST',
        data: JSON.stringify(oDatosJson)
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