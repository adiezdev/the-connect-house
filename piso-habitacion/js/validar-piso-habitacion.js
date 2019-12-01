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
    var comodididades = []
    $("input[name^='comodidad']").change(function () {
        if (this.checked) //Si hacemos check se agrega
        {
            comodididades.push($(this).val())
            //console.log(comodididades);
        } else // si lo quitamos el chek lo quitamos del array
        {
            comodididades.splice(($(this).val() - 1), 1)
            //console.log(comodididades);
        }
    });
    //
    var normas = []
    $("input[name^='norma']").change(function () {
        if (this.checked) //Si hacemos check se agrega
        {
            normas.push($(this).val())
            //console.log(normas);
        } else // si lo quitamos el chek lo quitamos del array
        {
            normas.splice(($(this).val() - 1), 1)
            //console.log(normas);
        }
    });
    //
    var latitud = $('#latitud').val();
    var longitud = $('#longitud').val();
    //
    var imagenes  = [];
    //
    $( "input[name=imagenes]" ).val();
}