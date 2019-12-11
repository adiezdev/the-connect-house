/**
 *
 * @param evt
 */
function precarfarImagens(evt)
{
    //Detectamos los  archivos
    var files = evt.target.files;
    //
    //Recorremos y comprobamos que sean imagenes
    for (var i = 0, f; f = files[i]; i++)
    {
        if (!f.type.match('image.*'))
        {
            continue; //Continuamos
        }
        //
        //Inicializamos para leer archivos
        var reader = new FileReader();
        //Leemos el archivo
        reader.onload = (function(theFile)
        {
            //Retornamos la funcion
            return function(e)
            {
                //El archivo tiene que ser menos de 7MB
                if (theFile.size <= 7000000)
                {
                    //Creamos una etiqueta span
                    var span = document.createElement('div');
                    //Añadimos la clase contenedor
                    span.setAttribute("class", "contenedor");
                    //Añadimos la imagen
                    span.innerHTML = [
                        '<img style="width: 280px; margin: 5px" src="',
                        e.target.result,
                        '" title="', escape(theFile.name),
                        '"/><br><span class="delete">Eliminar</span>'
                    ].join('');
                    //Añadimos las imagenes cantes de acabar la etiqueta de gallery
                    document.getElementById('gallery').insertBefore(span, null);
                    //Añadimos un input para poder guardar en bbdd la URL de la imagen
                    document.getElementById('hiddens').innerHTML += '<input type="hidden" name="imagenes[]" id=' + theFile.name + ' value = ' + e.target.result + '>';
                } else
                    {
                    alert("No pueden pesar mas de 7MG") //Si es mayor a 16 MB
                }

            };
        })(f);
        //
        reader.readAsDataURL(f);//Leemos el contenido y codificamos en base 64
    }
}
//Añadimos la funcion de precargar la imagen al input
document.getElementById('inputperfil').addEventListener('change', precarfarImagens, false);