jQuery(document).ready(function(){
	jQuery('.slider-home').slick({
        autoplay: true,
        autoplaySpeed: 9000,
        dots: false,
        arrows: false,
        infinite: true,
        speed: 300,
        slidesToShow: 1
	});
	jQuery('.slider-events').slick({
        autoplay: false,
        dots: false,
        arrows: true,
        draggable: false,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        centerMode: true,
        centerPadding: '0',
        variableWidth: true,
        touchMove: false
	});
	jQuery('.slider-conversation').slick({
        autoplay: false,
        dots: false,
        arrows: true,
        draggable: false,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        centerMode: true,
        centerPadding: '0',
        variableWidth: true,
        touchMove: false
	});
	jQuery('.menu-nav').click(function() {
    	if ( jQuery( this ).hasClass('active') ) {
        	jQuery( this ).removeClass('active');
    	    jQuery( '.menu-items,.menu-container' ).removeClass('opened');
        } else {
            jQuery( this ).addClass('active');
            jQuery( '.menu-items,.menu-container' ).addClass('opened');
        }
	});
	jQuery('.menu-items a').click(function() {
    	jQuery( '.menu-nav' ).removeClass('active');
    	jQuery( '.menu-items,.menu-container' ).removeClass('opened');
    });
});
