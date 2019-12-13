$('.menucabecera div').click(function()
{
    $('#menumovil').width('250px');
    $('body').css('overflow-x', 'hidden');

});

$('.botoncerrar').click(function()
{
    $('#menumovil').width('0');
    $('.content').css('margin-left','0');
});