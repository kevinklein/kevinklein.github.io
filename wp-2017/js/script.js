$(document).ready(function(){
    
/*
    $('.slider').slick({
        dots: true,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        adaptiveHeight: true
    });
*/

    var slider = $("#women").sliderTabs({
        mousewheel: false
    })
        
    if (window.innerWidth > 800) {
        window.sr = ScrollReveal({ reset: true });
        sr.reveal('.reveal', { afterReveal: function(){ $(this).addClass('animated') } } );
        sr.reveal('.reveal2', { delay: 400 } );
        sr.reveal('.reveal3', { delay: 600 } );
        sr.reveal('.reveal4', { delay: 800 } );
    }
    
    $('.toggle-target').click(function() {
        var target = '#' + $(this).data('target');
        $(target).fadeIn(200); 
        $(this).css('z-index', '101');  
    });
    
    
  
});