$(document).ready(function() {
   /* var x = document.getElementsByClassName("likeit");
    for (let i = 0; i < x.length; i++) {
        $(x).click(function(e) {
            //alert(1);
            $(this).find("path").attr('fill', 'red');
        });

    }*/
    $('.likeit').change( ':checked' , function ()
    {
        //
        var favorito = $(this).find('.corazon').val();
        var corason = $(this).find("path");
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
                    }

                });
        }
        else //Revertimos el check
        {
            //
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
                    }

                });
        }
    });
});