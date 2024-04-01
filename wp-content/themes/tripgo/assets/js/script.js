(function($){
	"use strict";

	/* Menu */
	function tripgo_menu(){
		var $btn = $('.main-navigation .menu-toggle'),
        $menu = $('.main-navigation');
        $btn.on('click', function () {
            $menu.toggleClass('toggled');
        });

        if ($menu.length > 0) {
            $menu.find('.menu-item-has-children > a, .page_item_has_children > a').each((index, element) => {
                var $dropdown = $('<button class="dropdown-toggle"></button>');
                $dropdown.insertAfter(element);

            });
            $(document).on('click', '.main-navigation .dropdown-toggle', function (e) {
                e.preventDefault();
                $(e.target).toggleClass('toggled-on');
                $(e.target).siblings('ul').stop().toggleClass('show');
            });
        }
	}

	function tripgo_set_menu_direction($item) {
        var sub = $item.children('.sub-menu').filter(':not(.ova-mega-menu)'),
            offset = $item.offset(),
            width = $item.outerWidth(),
            screen_width = $(window).width(),
            sub_width = sub.outerWidth();
        var align_delta = offset.left + width + sub_width - screen_width;
        if (align_delta > 0) {
            if ($item.parents('.menu-item-has-children').length) {
                sub.css({ left: 'auto', right: '100%' });
            }else {
                sub.css({ left: 'auto', right: '0' });
            }
        } else {
            sub.css({ left: '', right: '' });
        }
    }

    function tripgo_hover_submenu() {
        $('.primary-navigation .menu-item-has-children').hover(function (event) {
            var $item = $(event.currentTarget);
            tripgo_set_menu_direction($item);
        });
    }
	
	/* Click scroll button at bottom */	
	function tripgo_scrollUp(options) {
	       
		var defaults = {
		    scrollName: 'scrollUp', 
		    topDistance: 600, 
		    topSpeed: 800, 
		    animation: 'fade', 
		    animationInSpeed: 200, 
		    animationOutSpeed: 200, 
		    scrollText: '<i class="ovaicon-up-arrow"></i>', 
		    scrollImg: false, 
		    activeOverlay: false 
		};

		var o = $.extend({}, defaults, options),
		        scrollId = '#' + o.scrollName;

		$('<a/>', {
		    id: o.scrollName,
		    href: '#top',
		    title: ScrollUpText.value
		}).appendTo('body');

		if (!o.scrollImg) {
		    $(scrollId).html(o.scrollText);
		}

		$(scrollId).css({'display': 'none', 'position': 'fixed', 'z-index': '2147483647'});

		if (o.activeOverlay) {
		    $("body").append("<div id='" + o.scrollName + "-active'></div>");
		    $(scrollId + "-active").css({'position': 'absolute', 'top': o.topDistance + 'px', 'width': '100%', 'border-top': '1px dotted ' + o.activeOverlay, 'z-index': '2147483647'});
		}

		$(window).scroll(function () {
		    switch (o.animation) {
		        case "fade":
		            $(($(window).scrollTop() > o.topDistance) ? $(scrollId).fadeIn(o.animationInSpeed) : $(scrollId).fadeOut(o.animationOutSpeed));
		            break;
		        case "slide":
		            $(($(window).scrollTop() > o.topDistance) ? $(scrollId).slideDown(o.animationInSpeed) : $(scrollId).slideUp(o.animationOutSpeed));
		            break;
		        default:
		            $(($(window).scrollTop() > o.topDistance) ? $(scrollId).show(0) : $(scrollId).hide(0));
		    }
		});

		$(scrollId).on( "click", function (event) {
		    $('html, body').animate({scrollTop: 0}, o.topSpeed);
		    event.preventDefault();
		});
	}

	/* Post Format - Gallery */
	$('.slide_gallery').each(function(){
		
		var autoplay = $(this).data('autoplay');
		var autoplayTimeout = $(this).data('autoplaytimeout');
		var autoplaySpeed = $(this).data('autoplayspeed');
		var stopOnHover = $(this).data('stoponhover');
		var loop = $(this).data('loop');
		var dots = $(this).data('dots');
		var nav = $(this).data('nav');
		var items = $(this).data('items');
		

		$(this).owlCarousel({
			autoplayTimeout: parseInt( autoplayTimeout ),
		    autoplay: autoplay,
		    autoplaySpeed: parseInt( autoplaySpeed ),
		    stopOnHover : stopOnHover,
		    loop:loop,
		    dots:dots,
		    nav: nav,
		    items: parseInt( items ),
		});
	});
	
	/* Header sticky */
	if( $('.header_sticky').length ){

		function sticky_menu(menu, sticky) {
		    if (typeof sticky === 'undefined' || !jQuery.isNumeric(sticky)) sticky = 0;
		    if ($(window).scrollTop() >= sticky) {
		        if ($('#just-for-height').length === 0) {
		            menu.after('<div id="just-for-height" style="height:' + menu.outerHeight() + 'px"></div>')
		        }
		        menu.addClass("active_sticky");
		    } else {
		        menu.removeClass("active_sticky");
		        $('#just-for-height').remove();
		    }
		}

		$(document).ready(function () {
		    var menu = $(".header_sticky");
		    if (menu.length) {
		        var sticky = menu.offset().top + 100;
		        if( $(".header_sticky").hasClass('mobile_sticky') ){
		        	
		            sticky_menu(menu, sticky);
		        	$(window).on('scroll', function () {
		                sticky_menu(menu, sticky);
		            });    
			        	
		        }else{
		        	if ($(window).width() > 767) {
			            sticky_menu(menu, sticky);
			            $(window).on('scroll', function () {
			                sticky_menu(menu, sticky);
			            });
			        }
		        }

		        
		    }
		});
	}

	/* Check link has Hash (#about) in landing page */
	if( $( 'ul.menu' ).length ){
		var url = $( 'ul.menu li a' ).attr('href');
	    var hash = url.substring(url.indexOf("#")+1);
	    if( hash ){
	    	$( 'ul.menu li a' ).on( 'click', function(){
		    	$( 'ul.menu li' ).removeClass( 'current-menu-item' );
		    	$(this).parent().addClass( 'current-menu-item' );
		    	$(this).closest( '.menu-canvas' ).toggleClass('toggled');
	    	});	
	    } 
	}

	/* Mansory Blog */
    $('.blog_masonry').each( function() {
        var grid = $(this);
        var run  = grid.masonry({
          itemSelector: '.post-wrap',
          gutter: 0,
          percentPosition: true,
          transitionDuration: 0,
        });

        run.imagesLoaded().progress( function() {
          run.masonry();
        });
    });

    $('.tripgo_stretch_column_left').each( function() {
		var that = $(this);
		if ( that.length != null ) {
			tripgo_calculate_width( that );
		}
	});

    $('.tripgo_stretch_column_right').each( function() {
		var that = $(this);
		if ( that.length != null ) {
			tripgo_calculate_width( that );
		}
	});

	/* Calculate width with special class */
	function tripgo_calculate_width( directly ){

		if( $(directly).length ){

			var col_offset = $(directly).offset();

			if( directly.hasClass('tripgo_stretch_column_left') ){

				var ending_left = col_offset.left;
				var width_left 	= $(directly).outerWidth() + ending_left;
				
				$('.tripgo_stretch_column_left .elementor-widget-wrap').css('width', width_left);

				if ( $('body').hasClass('rtl') ) {
					$('.tripgo_stretch_column_left .elementor-widget-wrap').css('margin-right', -ending_left);
				} else {
					$('.tripgo_stretch_column_left .elementor-widget-wrap').css('margin-left', -ending_left);
				}
			}

			if( directly.hasClass('tripgo_stretch_column_right') ){

				var ending_right 	= ($(window).width() - (col_offset.left + $(directly).outerWidth()));
				var width_right 	= $(directly).outerWidth() + ending_right;

				directly.find('.elementor-widget-wrap').css('width', width_right);
				
				if ( $('body').hasClass('rtl') ) {
					directly.find('.elementor-widget-wrap').css('margin-left', -ending_right);
				} else {
					directly.find('.elementor-widget-wrap').css('margin-right', -ending_right);
				}
			}
		}
	}

	$(window).resize(function () {
		$('.tripgo_stretch_column_left').each( function() {
			var that = $(this);
			if ( that.length != null ) {
				tripgo_calculate_width( that );
			}
		});

		$('.tripgo_stretch_column_right').each( function() {
			var that = $(this);
			if ( that.length != null ) {
				tripgo_calculate_width( that );
			}
		});
	});

    tripgo_hover_submenu();
	tripgo_menu();
	
	/* Scroll to top */
	tripgo_scrollUp();

	// Accordion customize
	$(".ova-accordion-custom").each(function(){
			
		//init
		var that = $(this).find('.elementor-accordion');
		that.find('.elementor-accordion-item').first().addClass('ova-active');

		var btn = that.find('.elementor-accordion-item');

		btn.each( function() {
			
			$(this).find('.elementor-tab-title').on('click', function(){
				var that = $(this);
				var pa = that.parent();
				var check = pa.hasClass('ova-active');
				if( check === true ) {
					pa.removeClass('ova-active');

				} else {
					
					pa.parent().find('.elementor-accordion-item').removeClass('ova-active');
					pa.addClass('ova-active');
				}
			});	

		});
		
	});
	 $('.slick-carousel').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        infinite: false,
		draggable: true,
       	prevArrow: $('.slick-prev'),
      	nextArrow: $('.slick-next'),
        // Add other options as needed
     });
})(jQuery);

function loadAttendees(action, id){
		var formCount = Number(jQuery('.'+id).val());
		if((formCount >= 0)){
			if(action == 'minus'){
				if(formCount > 0){
					var getVasualCount = (formCount - 1); 
					jQuery('.'+id).val(getVasualCount);
				}
			}else if(action == 'plus'){
				var getVasualCount = (formCount + 1); 
				jQuery('.'+id).val(getVasualCount);
			}
		}
	}
function setCategoryValue(event, slug){

	var category = jQuery('#tour-category-filter-'+slug).is(':checked');
	console.log(slug);
	if(slug == 'all'){
		jQuery('.none-selected-color').css('background','#ddd');
		document.querySelectorAll('.tour-category-filter').forEach(function(category_filter) {
			jQuery('#tour-category-filter'+slug).prop('checked', false);
		});
		jQuery(event.target).css('background','#d3dbe9');
		return;
	}
	
	jQuery('.catSpanData').css('background','#ddd');
	if(category){
	   jQuery('#tour-category-filter-'+slug).prop('checked', false);
		jQuery(event.target).css('background','#ddd');
		return;
	  }else{
	   jQuery('#tour-category-filter-'+slug).prop('checked', true);
		jQuery(event.target).css('background','#d3dbe9');
		return;
	  }
}
function switch_btw_login_signup(action){
	if(action=='login'){
		jQuery('.vs-class-register').css('display','none');
		jQuery('.vs-class-login').css('display','block');
		jQuery('.ova-login-register-woo li:nth-child(1) a').click()[0];
		document.getElementById('login-to-view').scrollIntoView();
	}else{
		jQuery('.vs-class-login').css('display','none');
		jQuery('.vs-class-register').css('display','block');
		jQuery('.ova-login-register-woo li:nth-child(2) a').click()[0];
		document.getElementById('signup-to-view').scrollIntoView();
	}
}