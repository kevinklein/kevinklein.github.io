$(document).ready(function(){

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
  
});