(function($){
	"use strict";
	
	$(window).on('elementor/frontend/init', function () {
		
        elementorFrontend.hooks.addAction('frontend/element_ready/tripgo_elementor_gallery_filter.default', function(){
	       
	        /* Add your code here */
	        $(".ova-gallery-filter").each(function(){

				var that 		= $(this);
				var gallery     = that.find('.gallery-column')
				var filter_btn  = that.find('.filter-btn-wrapper .filter-btn')

				that.imagesLoaded( function() {

	                gallery.isotope({ 
	             		itemSelector : '.gallery-item',
	                  	animationOptions: { 
	                      	duration: 750, 
	                      	easing: 'linear', 
	                      	queue: false, 
	                	},
	                	layoutMode: 'masonry',
	                    percentPosition: true,
	                    masonry: {
	                        columnWidth: '.gallery-item',
	                        gutter: 30
	                    }
	                });  

	            });

				filter_btn.click(function(){
          
		            $('.filter-btn-wrapper .filter-btn').removeClass("active-category");

		            $(this).addClass("active-category");      

		                var selector = $(this).attr('data-slug'); 

		                gallery.isotope({ 
	                     	filter: selector, 
	                      	animationOptions: { 
	                          	duration: 750, 
	                          	easing: 'linear', 
	                          	queue: false, 
	                    	},
	                    	layoutMode: 'masonry',
	                        percentPosition: true,
	                        masonry: {
	                            columnWidth: '.gallery-item',
	                            gutter: 30
	                        }
		                });  

		            return false;

        		}); 

        		Fancybox.bind('[data-fancybox="gallery-filter"]', {
				   	Image: {
				    	zoom: false,
				  	},
				});

		    });
	    	
        });
        
   });

})(jQuery);
