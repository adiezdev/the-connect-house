$(document).ready(function() {

    $('.likeit').change( ':checked' , function ()
    {
        //
        var favorito = $(this).find('.corazon').val();
        var corason = $(this).find("path");
        //
        //Guardamos el dato
        oDatosJson = {fav: favorito };
        //
        //Comprueba si está quecheckeado
        if ( $(this).find('.corazon').is(":checked"))
        {
            //
            $.ajax({
                url: '/the-connect-house/peticiones/ajax/a_SaveFavorito.php',
                type: 'POST',
                data: JSON.stringify(oDatosJson)
            })
                .done(function(oJson) {
                    console.log(oJson); //Debug
                    var oRespuesta = JSON.parse(oJson);
                    if (oRespuesta.Estado == "OK")
                    {
                        $(corason).attr('fill', 'red');
                       $.notify('Se ha añadido a favoritos' , 'info', {position: 'left top'});
                    }
                });
        }
        else //Revertimos el check
        {
            //Lo eliminamos
            $.ajax({
                url: '/the-connect-house/peticiones/ajax/a_DeleteFavorito.php',
                type: 'POST',
                data: JSON.stringify(oDatosJson)
            })
                .done(function(oJson) {
                    console.log(oJson); //Debug
                    var oRespuesta = JSON.parse(oJson);
                    if (oRespuesta.Estado == "OK")
                    {
                        $(corason).attr('fill', 'white');
                        location.reload();
                    }

                });
        }
    });
});