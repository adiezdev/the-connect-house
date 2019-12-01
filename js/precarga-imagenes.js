/**
 *
 * @param evt
 */
function precarfarImagens(evt) {
    var files = evt.target.files;

    for (var i = 0, f; f = files[i]; i++) {

        if (!f.type.match('image.*')) {
            continue;
        }


        var reader = new FileReader();

        reader.onload = (function(theFile) {
            return function(e) {
                if (theFile.size <= 16000000) {
                    var span = document.createElement('span');
                    span.setAttribute("class", "contenedor");
                    span.innerHTML = [
                        '<img style="width: 280px; margin: 5px" src="',
                        e.target.result,
                        '" title="', escape(theFile.name),
                        '"/><span class="delete">&times;</span>'
                    ].join('');
                    console.log(theFile.size);

                    document.getElementById('gallery').insertBefore(span, null);
                    document.getElementById('hiddens').innerHTML += '<input type="hidden" name="imagenes" id=' + theFile.name + ' value = ' + e.target.result + '>';
                } else {
                    alert("No pueden pesar mas de 16mb")
                }

            };
        })(f);

        reader.readAsDataURL(f);
    }
}

document.getElementById('inputperfil').addEventListener('change', precarfarImagens, false);