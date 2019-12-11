function llamarMapa(touch , scroll, arrastrar , marca , lt = null, lg = null)
{
    //
    //Creammos donde va estar el mapa
    var mymap = L.map('mapid').setView([ 42.599267 , -5.5696127], 14,5);
    //
    //Se lo pasamos al proceso
    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox.streets',
        accessToken: 'pk.eyJ1IjoiYWRpbG9zYTk1IiwiYSI6ImNrMmRvaXR4ZDAwdWczZW8ydnlzOGNlYTQifQ.-Svrf89xf3kxyo30tj8_hw'
    }).addTo(mymap);//Se añade el mapa
    //
    //Activar el añdir una marca en el mapa
    if(touch == true)
    {
        //
        //Marca en el mapa
        var theMarker = {};
        //Capturamos cuando hacemos click en el mapa
        mymap.on('click', function(e) {
            //Cogemos la latitud y logitud
            lat = e.latlng.lat;
            lon = e.latlng.lng;
            //Eliminar marca si ya exites o la anterior
            if (theMarker != undefined) {
                mymap.removeLayer(theMarker);
            };

            //Añadimos la marca en el mapa
            theMarker = L.marker([lat, lon]).addTo(mymap);
            //Damos los valores de la latitud y longitud a los hidden
            document.getElementById("latitud").value = lat;
            document.getElementById("longitud").value = lon;
        });
    }
    //
    //Situamos el mapa en un sitio
    if(lt != null && lg != null)
    {
        //El mapa se visualiza en esas coordenadas
        mymap.panTo([lt , lg]);
        //Si necesito una marca en el mapa
        if( marca == true)
        {
            L.marker([lt , lg]).addTo(mymap);
        }
    }
    if (scroll == false)
    {
        //Si necesito desactivar su scroll
        mymap.scrollWheelZoom.disable();
    }
    if (arrastrar == false)
    {
        //Si necesito desactivar el arrastre
        mymap.dragging.disable();
    }
}
//
//Como necesitamos otras propiedades del mapa para hacer una busqueda ya que la API nos da conflictos
function MapaDeBusqueda(  )
{
    
}

