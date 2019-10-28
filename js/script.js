/**
 * Función para mostrar valor del slider 
 */
$(document).ready(function() {
    //Posiición incial
    $('#slider').val(0);
    //Acción de cambio
    $('#slider').on("input change", function() {
        //Capturamos el valor actual
        var valor = $(this).val();
        //Lo mostramos
        $('#preciospan').html(valor)
    });
});