//Script para formar la ventana
//
//Sacamos la ventana modelo
/*var modal = document.getElementById("miVentana");
//Sacamos los botones de la ventana
var btn = document.getElementById("buttonVentana");
//Sacamos la clase para poder cerrar d
var span = document.getElementsByClassName("close")[0];

btn.onclick = function() {
    modal.style.display = "block";
}
span.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}*/
//
//Click en boton Ventana
$('#buttonVenta').click(function()
                       {
                           //Mostramos la ventana
                           $('#miVentana').css('display' , 'block');
                       });
//
//Click en la X
$('#close').eq(0).click(function( )
                        {
                            //cerramos la ventana
                            $('#miVentana').css('display' , 'none');
                        });
//
//Clikc dentrode la ventana se cerrará
$(window).click(function( )
                {
                    if ($(this) == $('#miVentana'))
                    {
                        $('#miVentana').css('display' , 'none');
                    }
                });