jQuery( document ).ready( function( $ ) {

    /* Superfish the menu drops ---------------------*/
    $('.menu').superfish({
    	delay: 200,
    	animation: {opacity:'show', height:'show'},
    	speed: 'fast',
    	autoArrows: true,
    	dropShadows: false
    });
    
    /* Mobile Menu ---------------------*/
    $('#sec-selector').change(function(){
        if ($(this).val()!='') {
        	window.location.href=$(this).val();
        }
    });
    
    $( document ).on( 'ready post-load', function() {
            
        /* Flexslider ---------------------*/
        $(window).load(function() { 
    	    if( $().flexslider) {
    	    	var slider = $('.flexslider');
    	    	slider.fitVids().flexslider({
    		    	slideshowSpeed		: slider.attr('data-speed'),
    		    	animationDuration	: 400,
    		    	animation			: 'fade',
    		    	video				: true,
    		    	useCSS				: false,
    		    	touch				: false,
    		    	animationLoop		: true,
    		    	smoothHeight		: true,
    		    	
    		    	start: function(slider) {
    		    	    slider.removeClass( 'loading' );
    		    	}
    	    	});	
    	    }
        });

		/* Ajax Social Button ---------------------*/
		$(document).ajaxComplete(function($) {
			gapi.plusone.go();
			twttr.widgets.load();
			try {
				FB.XFBML.parse();
			}catch(ex){}
		});
	
		/* Fit Vids ---------------------*/
		$('.featurevid, .article').fitVids();
		
		/* $ UI Tabs ---------------------*/
		$(function() {
		   $( ".organic-tabs" ).tabs();
		});
		
		/* $ UI Accordion ---------------------*/
		$(function() {
		    $( ".organic-accordion" ).accordion({
		    	collapsible: true, 
		        autoHeight: false
		    });
		});
		
		/* Close Message Box ---------------------*/
		$('.organic-box a.close').click(function() {
			$(this).parent().stop().fadeOut('slow', function() {
			});
		});
		
		/* Toggle Box ---------------------*/
		$('.toggle-trigger').click(function() {
			$(this).toggleClass("active").next().fadeToggle("slow");
		});
		
		/* Pretty Photo Lightbox ---------------------*/
		$("a[rel^='prettyPhoto']").prettyPhoto();
	
	});
    
});