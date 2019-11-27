/**
 * Funcion para visualizar la imagen de perfil antes de ser subida
 *
 * @param evt
 */
function precarfarImagenPerfil(evt) {
    var files = evt.target.files;

    for (var i = 0, f; f = files[i]; i++) {

        if (!f.type.match('image.*')) {
            continue;
        }


        var reader = new FileReader();

        reader.onload = (function(theFile) {
            return function(e) {
                if (theFile.size <= 16000000)
                {
                    document.getElementById("imgperfil").src =  e.target.result;
                    document.getElementById('hiddens').innerHTML += '<input type="hidden" name="imagen" id=' + theFile.name + ' value = ' + e.target.result + '>';
                } else {
                    alert("No pueden pesar mas de 16MB");
                }

            };
        })(f);

        reader.readAsDataURL(f);
    }
}

document.getElementById('inputperfil').addEventListener('change', precarfarImagenPerfil, false);