function validarDatos() {
    var calle = $('#calle').val();
    var numero = $('#numero').val();
    var cp = $('#cp').val();
    var ciudad = $('#selector').val();
    var descripcion = $('#descripcion').val();
    var metros = $('#metros').val();
    var precio = $('#precio').val();
    var chicos = $('#chicos').val();
    var chicas = $('#chicas').val();
    var toilet = $('#toilet').val();
    var habitaciones = $('#habitaciones').val();
    //
    metros = metros.replace(',','.');
    precio = precio.replace(',','.');
    //
    //
    var comodididades = [];
    //
    var c = $('.comodidad');
    for (var i = 0; i < c.length ; i++)
    {
        if ($(c[i]).prop('checked') == true)
        {
            comodididades.push($(c[i]).val());
        }
    }
    //
    var normas = [];
    //
    var n = $('.norma');
    for (var i = 0; i < n.length ; i++)
    {
        if ($(n[i]).prop('checked') == true)
        {
            normas.push($(n[i]).val());
        }
    }
    //
    var latitud = $('#latitud').val();
    var longitud = $('#longitud').val();
    //
    var imagenes  = [];
    //
    //Guardamos las imagenes en un array
    imagenes.push( $( "input[name=imagenes]" ).val() );
    //
    //VALIDACIONES
   if( calle.trim() == '')
    {
        alert("Indica por favor la calle donde está");
        $('#calle').focus();
        return false;
    }
    if( numero.trim() == '' )
    {
        alert("Indica por favor el numero del por tal");
        $('#numero').focus();
        return false;
    }
    if( cp.trim() == '' || isNaN(toilet) )
    {
        alert("Indica el codigo postal");
        $('#cp').focus();
        return false;
    }
    if( descripcion.trim() == '')
    {
        alert("Indica la descripción");
        $('#descripcion').focus();
        return false;
    }
    if( metros.trim() == '' || isNaN(metros))
    {
        alert("Metros cuadrados del piso que sea válidos");
        $('#metros').val();
        return false;
    }
    if( precio.trim() == '' || isNaN(precio))
    {
        alert("Indique un precio válido");
        $('#precio').val();
        return false;
    }
    if( toilet.trim() == '' || isNaN(toilet))
    {
        alert("Indique un precio válido");
        $('#toilet').val();
        return false;
    }
    //Formamos el JSON
    var DatosJson =
        {
            Calle: calle ,
            Numero: numero ,
            Cp: cp ,
            Ciudad: ciudad ,
            Descripcion: descripcion ,
            Metros: metros ,
            Precio: precio ,
            Chicos: chicos ,
            Chicas: chicas ,
            Toilet: toilet ,
            Habotaciones: habitaciones ,
            Comodidades: comodididades ,
            Normas: normas ,
            Latitud: latitud ,
            Longitud: longitud ,
            Imagenes: imagenes
        };
    //
    console.log(DatosJson);
}