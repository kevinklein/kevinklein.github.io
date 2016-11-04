(function ($) {
    
   $(document).ready(function() {
       
        $(function() {
            $('.match-height').matchHeight();
        });
		
		$('.toggle-target').click(function() {
            var target = '#' + $(this).data('target');
            $(target).slideToggle('fast');    
        });
        
        $('.toggle-target-next').next().hide();
        
        $('.toggle-target-next').click(function() {
            $(this).next().slideToggle('fast');
        });
        
        $('.toggle-is-toggled').click(function() {
    		if ($(this).hasClass('is-toggled')) {
                $(this).removeClass('is-toggled');
            } else {
                $(this).addClass('is-toggled');
            }
        });
        
        $('.toggle-section-menu').click(function() {
    		if ($('body').hasClass('section-menu-is-visible')) {
                $('body').removeClass('section-menu-is-visible');
            } else {
                $('body').addClass('section-menu-is-visible');
            }
        });
        
        $('.read-more a').click(function(e) {
            $(this).parents('.read-more-parent').toggleClass('read-more-parent-expanded');
            $(this).html() == 'Read Less' ? $(this).html('Read More') : $(this).html('Read Less');
            e.preventDefault();
        });
        
        $('.toggle-target-chevron').click(function() {
    		$(this).find('span').html() == '<i class="fa fa-chevron-up"></i>' ? $(this).find("span").html('<i class="fa fa-chevron-down"></i>') : $(this).find("span").html('<i class="fa fa-chevron-up"></i>'); 
        });
        
        $('.toggle-target-plus-minus').click(function() {
    		$(this).find('span').html() == '<i class="fa fa-plus-circle"></i>' ? $(this).find("span").html('<i class="fa fa-minus-circle"></i>') : $(this).find("span").html('<i class="fa fa-plus-circle"></i>'); 
        });
        
        $('[data-toggle="tooltip"], .tooltip-trigger').tooltip();
        
        $('.popover-dismiss').popover({
          trigger: 'focus'
        });
        
        $('[data-toggle="popover"]').popover({
            container: 'body',
            html: true,
            content: function () {
                var clone = $($(this).data('popover-content')).clone(true).removeClass('hide');
                return clone;
            }
        }).click(function(e) {
            e.preventDefault();
        });
        
/*
        if (window.innerWidth  > 768 ) {
            if(document.getElementById("sticky-block")) {	
                var stickyBlockWidth = $('#sticky-block').width();
                var waypoint = new Waypoint({
                  element: $('.sticky-block'),
                  handler: function(direction) {
                    $('#sticky-block').toggleClass('stuck').width(stickyBlockWidth);
                  },
                  offset: '0',
                })
            }
        }
*/
				
	});

}(jQuery));