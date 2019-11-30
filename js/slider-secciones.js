    //
    //1 añadir las secciones que hay para rellenear por slider
    //
    //Primeramente cogemos las clases Seccion
    var x = document.getElementsByClassName("seccion");
    //
    // Cogemos el div todas la secciones que agrupa todo
    var seccion = document.getElementById("todassecciones");
    //Inicializamos contador
    var contador = 1;
    //
    //Recorremos la secciion que hay
    for (i = 0; i < x.length; i++)
    {
       // añadimos en pantalla un contador por tantas secciones que haya
      seccion.innerHTML += '<p class="secciones" onclick="verDiv('+(contador - 1)+')" >'+ contador++ +' Sección </p>';
    }
    //De esas secciones extraemos la clase
    var secciones = document.getElementsByClassName("secciones");
    //
    //Recorremos las secciones que hay
    for (let i = 0; i < secciones.length; i++)
    {
        //Añadimos el estilo para que se muestre en un bloque de linea
        secciones[i].style.display = "inline-block";
    }
    verDiv(0)//Inicalizamos la funcion a la primera seccion
    /**
     * Funcion para mostrar cada seccion por parte
     *
     * @param n
     */
    function verDiv(n)
    {
        let i;//Incializamos el for
        //Cogemos las clases que tengan secciion
        var x = document.getElementsByClassName("seccion");
        //
        //Recorremos las secciones
        for (i = 0; i < x.length; i++)
        {
            //Las ocultamos
            x[i].style.display = "none";
        }

        x[n].style.display = "table"; //por defecto mostramos la primera seccion
    }

