$(document).ready(function() {
    //
    //Click en boton Ventana
    $('#buttonVentana').click( function ()
    {
        //Mostramos la ventana
        $('#miVentana').css('display', 'block');

    });
    //
    //Click en la X
    $('.close').click(function ()
    {
        //cerramos la ventana
        $('#miVentana').css('display', 'none');
    });
});