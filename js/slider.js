var indice = 1;
showDiv(1);

function siguienteImg(n) {
    showDiv(indice += n)
}

function thisImg(n) {
    showDiv(indice = n)
}

function showDiv(n) {
    let i;
    var x = document.getElementsByClassName("imgSlides");
    var c = document.getElementsByClassName("circulo");
    if (n > x.length) { indice = 1 }
    if (n < 1) { indice = x.length }
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    for (i = 0; i < c.length; i++) {
        c[i].className = c[i].className.replace(" circulgreen", " ");
    }
    x[indice - 1].style.display = "block";
    c[indice - 1].className += " circulgreen";
}