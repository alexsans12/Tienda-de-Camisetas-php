(function () {
    "use strict";

    document.addEventListener('DOMContentLoaded', function () {

        // Borra las alertas
        if(document.getElementById('alerta')) {
            setTimeout(function() {
                $('#alerta').fadeOut();
            }, 8000);
            setTimeout(function() {
                $('#alerta').remove();
            }, 13000);

        }

        // Realizar pedido sin estar logueado
        if(document.getElementById('alerta-aside')) {
            if ($(window).width() >= 768) {
                $('.lateral').css({
                    'width': '60%'
                });

                $('#alerta-aside').css({
                   'display': 'flex'
                });
            }
        }

        //Menu Responsive
        $('.menu-movil').click(function (e) {
            e.preventDefault();
            $('.nav-menu').slideToggle();
        });

        if($(window).width() >= 768) {
            $('.nav-menu').css({
                'display': 'block'
            });
        }

        $('.options-movil').click(function (e) {
            e.preventDefault();
            $('.despliege').slideToggle();
            if($('.options-movil i').hasClass('fa-chevron-down')) {
                $('.options-movil i').removeClass('fa-chevron-down');
                $('.options-movil i').addClass('fa-chevron-up');
            } else {
                $('.options-movil i').removeClass('fa-chevron-up');
                $('.options-movil i').addClass('fa-chevron-down');
            }
        });

        if($(window).width() >= 768) {
            $('.despliege').css({
                'display': 'block'
            });
        }

        $(window).resize(function(){
            if($(window).width() >= 768) {
                $('.despliege').css({
                    'display': 'block'
                });

                $('.nav-menu').css({
                    'display': 'block'
                });
            }
        });
    }); //DOM CONTENT LOADED
})();

// Eliminar el aside lateral si esta logueado en realizar pedido
if(document.getElementById('pedido-form')) {
    $('.lateral').remove();
}
