//Inicializamos contados
var contador = 0;
/**
 * Función para ver los siguientes 3 pisos/habitaciones en el index
 *
 * @constructor
 */
function PaginadoSiguiente()
{
    //Incrementamos contador
    var c =  contador+=3
    //Ponemos un tope
    if(contador > 3)
    {
        c = 3;
    }
    //
    //Formamos Json
    var oDatosJson = {paginado: c };
    //
    //Enviamos la peticion
    $.ajax({
        url: '/the-connect-house/peticiones/ajax/a_PaginadoInicio.php',
        type: 'POST',
        data: JSON.stringify(oDatosJson)
    })
        .done(function(oJson) {
            //Parseamos la respuesta
            var oRespuesta = JSON.parse(oJson);
            //Array de los pisos
            var BoxHabi = [];
            //Recorremos la respuesta
            for (let i = 0 ; i < oRespuesta.length; i++)
            {
                //Formamos el hmtl
                var stri = '<div class="box-pisos-habitacones">';
                stri += '<img src="'+oRespuesta[i].Imagen+'" alt="habitación">';
                stri += '<div class="descripcion">';
                stri += '<h3>'+oRespuesta[i].Calle+'</h3>';
                stri += '<p><i class="fas fa-map-marker-alt"></i>'+oRespuesta[i].Ciudad+'</p>';
                stri += '<div class="precio">'+oRespuesta[i].Precio+' €/mes</div>';
                stri += '</div>';
                stri +=  '<button class="button">Me interesa</button>';
                stri += '</div>';
                stri += '<div id="contador" style="display: none">'+c+'</div>';
                //Guardamos en el array
                BoxHabi.push( stri );
            }
            //Añadimos a la sección
            var seccion = $('.seccion');
            $(seccion[0]).fadeOut(200, function ()
            {
                //Mostramos los pisos/habitaciones
                $(seccion[0]).html(BoxHabi).fadeIn(200);
            });
        });
}
/**
 * Función para ver los anteriores 3 pisos/habitaciones en el index
 *
 * @constructor
 */
function PaginadoAnterior( )
{
    //Cogemos el contador
    var cont = $('#contador').text()
    var c =  cont-=3
    //Ponemos un tope mimo
    if(cont <= 0)
    {
        c = 0;
    }
    //
    //Formamos Json
    var oDatosJson = {paginado: c }
    //
    //Enviamos la peticion
    $.ajax({
        url: '/the-connect-house/peticiones/ajax/a_PaginadoInicio.php',
        type: 'POST',
        data: JSON.stringify(oDatosJson)
    })
        .done(function(oJson) {
            //Parseamos la respuesta
            var oRespuesta = JSON.parse(oJson);
            //Array de los pisos
            var BoxHabi = [];
            //Recorremos la respuesta
            for (let i = 0 ; i < oRespuesta.length; i++)
            {
                //Formamos el hmtl
                var stri = '<div class="box-pisos-habitacones">';
                stri += '<img src="'+oRespuesta[i].Imagen+'" alt="habitación">';
                stri += '<div class="descripcion">';
                stri += '<h3>'+oRespuesta[i].Calle+'</h3>';
                stri += '<p><i class="fas fa-map-marker-alt"></i>'+oRespuesta[i].Ciudad+'</p>';
                stri += '<div class="precio">'+oRespuesta[i].Precio+' €/mes</div>';
                stri += '</div>';
                stri +=  '<button class="button">Me interesa</button>';
                stri += '</div>';
                stri += '<div id="contador" style="display: none">'+c+'</div>';
                //Guardamos el array
                BoxHabi.push( stri );
            }
            //Añadimos a la sección
            var seccion = $('.seccion');
            $(seccion[0]).fadeOut(200, function ()
            {
                //Mostramos los pisos/habitaciones
                $(seccion[0]).html(BoxHabi).fadeIn(200);
            });
        });
}