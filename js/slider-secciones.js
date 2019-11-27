var indice = 1;
showDiv(1)
function siguienteImg(n) {
    showDiv(indice += n)
}

function thisImg(n) {
    showDiv(indice = n)
}
function showDiv(n) {
    let i;
    var x = document.getElementsByClassName("seccion");
    var seccion = document.getElementById("todassecciones");
    if (n > x.length)
    {
        indice = 1
    }
    if (n < 1)
    {
        indice = x.length
    }
    var contador = 0;
    for (i = 0; i < x.length; i++)
    {

        x[i].style.display = "none";
        seccion.innerHTML = contador++;
    }


    x[indice - 1].style.display = "table";
}