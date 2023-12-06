$(document).ready(function(){
    $('ul.tabs li a:first').addClass('activoCaja');
    $('.tabs-seccion article').hide();
    $('.tabs-seccion article:first').show();

    $('ul.tabs li a').hover(function(){
        $('ul.tabs li a').removeClass('activoCaja');
        $(this).addClass('activoCaja');
        $('.tabs-seccion article').hide();

        var tablaActiva = $(this).attr('href');
        $(tablaActiva).show();
        return false;
    });
});