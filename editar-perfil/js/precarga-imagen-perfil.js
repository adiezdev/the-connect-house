/**
 * Funcion para visualizar la imagen de perfil antes de ser subida
 *
 * @param evt
 */
function precarfarImagenPerfil(evt)
{
    //Detectamos los  archivos
    var files = evt.target.files;
    //
    //Recorremos y comprobamos que sea imagen
    for (var i = 0, f; f = files[i]; i++)
    {
        if (!f.type.match('image.*'))
        {
            continue;
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
                //El archivo tiene que ser menos de 16MB
                if (theFile.size <= 16000000)
                {
                    //Sustituimos la imagen de perfil por defecto por la que estamos cargardo
                    document.getElementById("imgperfil").src =  e.target.result;
                    //Añadimos un input para poder guardar en bbdd la URL de la imagen
                    document.getElementById('hiddens').innerHTML += '<input type="hidden" name="imagen" id=' + theFile.name + ' value = ' + e.target.result + '>';
                }
                else
                    {
                    alert("No pueden pesar mas de 16MB"); //Si es mayor a 16 MB
                }
            };
        })(f);
        //
        reader.readAsDataURL(f);//Leemos el contenido y codificamos en base 64
    }
}
//Añadimos la funcion de precargar la imagen al input
document.getElementById('inputperf').addEventListener('change', precarfarImagenPerfil, false);