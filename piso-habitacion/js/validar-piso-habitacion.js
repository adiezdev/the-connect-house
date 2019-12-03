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
    var comodididades = [];
    //
    $("input[name^='comodidad']").change(function () {
        if (this.checked) //Si hacemos check se agrega
        {
            comodididades.push( $(this).val() );
            //console.log(comodididades);
        } else // si lo quitamos el chek lo quitamos del array
        {
            comodididades.splice(($(this).val() - 1), 1);
            //console.log(comodididades);
        }
    });
    //
    var normas = [];
    //
    $("input[name^='norma']").change(function () {
        if (this.checked) //Si hacemos check se agrega
        {
            normas.push( $(this).val() );
            //console.log(normas);
        } else // si lo quitamos el chek lo quitamos del array
        {
            normas.splice(($(this).val() - 1), 1);
            //console.log(normas);
        }
    });
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
        calle.focus();
        return false;
    }
    if( numero.trim() == '' )
    {
        alert("Indica por favor el numero del por tal");
        numero.focus();
        return false;
    }
    if( cp.trim() == '' || isNaN(toilet) )
    {
        alert("Indica el codigo postal");
        cp.focus();
        return false;
    }
    if( descripcion.trim() == '')
    {
        alert("Indica la descripción");
        descripcion.focus();
        return false;
    }
    if( metros.trim() == '' || isNaN(metros))
    {
        alert("Metros cuadrados del piso que sea válidos");
        metros.focus();
        return false;
    }
    if( precio.trim() == '' || isNaN(precio))
    {
        alert("Indique un precio válido");
        precio.focus();
        return false;
    }
    if( toilet.trim() == '' || isNaN(toilet))
    {
        alert("Indique un precio válido");
        precio.focus();
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
}