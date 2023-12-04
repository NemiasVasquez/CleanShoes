$(document).ready(function(){
    var header = $("header");
    var scrollPosition = 0;

    $(window).scroll(function(){
        var currentScroll = $(this).scrollTop();

        // Verifica si el scroll es hacia abajo y la barra no está ya "scroll"
        if (currentScroll > scrollPosition && !header.hasClass("scroll")) {
            header.addClass("scroll");
        } 
        // Verifica si el scroll es hacia arriba y la barra está "scroll"
        else if (currentScroll < scrollPosition && header.hasClass("scroll")) {
            header.removeClass("scroll");
        }

        scrollPosition = currentScroll;
    });
});