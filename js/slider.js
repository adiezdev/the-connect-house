var indice = 1; //Incializamos el indice
showDiv(1); //Incializamos la funcion
//
//Función siguiente, con esto mostramnos la siguiente imagen
function siguienteImg(n) {
    showDiv(indice += n)
}
//Función para volver a la imagen anterior
function thisImg(n) {
    showDiv(indice = n)
}
//Función para generar el carrusel
function showDiv(n) {
    let i;
    //Cogemos todos los elementos con ésta clase
    var x = $('.imgSlides')
    //Si n es mayor que la longitud de x el indice vale 1
    if (n > x.length)
    {
        indice = 1
    }
    //Si n es menos que 1 valdrá la longitus de x
    if (n < 1)
    {
        indice = x.length
    }
    //Recorremos las clases
    x.each(function (index)
    {
        x[index].style.display = "none"; //Las ocultamos
    })
    //Mostramos la primera imagen
    x[indice - 1].style.display = "block";
}