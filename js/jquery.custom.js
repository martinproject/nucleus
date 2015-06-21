/*-----------------------------------------------------------------------------------

 	Custom JS - All front-end jQuery
 
-----------------------------------------------------------------------------------*/
 
 
/*-----------------------------------------------------------------------------------*/
/*	Let's get ready!
/*-----------------------------------------------------------------------------------*/

jQuery(document).ready(function() {

/*-----------------------------------------------------------------------------------*/
/*	Overlay
/*-----------------------------------------------------------------------------------*/
	
	var overlay = jQuery('#overlay');
	var overlayTrigger = jQuery('#overlay-trigger a');
	
	overlay.css({
		display: 'block',
		marginTop: -overlay.height() + 5
	});
	
	var overlayState = 'close';
	
	overlayTrigger.toggle( function() {
	
		overlayState = 'open';
		
		overlayTrigger.addClass('active');
		
		overlay.animate({
			marginTop: 0
		}, 900, 'easeInOutQuart');
		
	}, function () {
		
		overlayState = 'close';
		
		overlayTrigger.removeClass('active');
		
		overlay.animate({
			marginTop: -overlay.outerHeight() + 1
		}, 900, 'easeInOutQuart');
		
	});
	
/*-----------------------------------------------------------------------------------*/
/*	Tabs and toggles
/*-----------------------------------------------------------------------------------*/
	
	jQuery("#tabs").tabs();
	jQuery(".tabs").tabs();
	
	
	jQuery(".toggle").each( function () {
		if(jQuery(this).attr('data-id') == 'closed') {
			jQuery(this).accordion({ header: 'h4', collapsible: true, active: false  });
		} else {
			jQuery(this).accordion({ header: 'h4', collapsible: true});
		}
	});
	
	
/*-----------------------------------------------------------------------------------*/
/*	Image Slider
/*-----------------------------------------------------------------------------------*/

	if(jQuery().slides){
		
		var slider = jQuery('#slider');
		var speed = slider.attr('data-speed');
		
		if(speed == '') {
			speed = 0;
		}
		
		if(jQuery('body').hasClass('single-portfolio')){
		
			slider.slides({
				generatePagination: false,
				next: 'next-slide',
				prev: 'previous-slide',
				crossfade: false,
				play: speed,
				effect: 'fade',
				autoHeight: true,
				bigTarget: true,
				preload: true,
				preloadImage: jQuery("#slider").attr('data-loader')
			});
		
		} else {
			
			slider.slides({
				generatePagination: false,
				next: 'next-slide',
				prev: 'previous-slide',
				effect: 'fade',
				crossfade: true,
				play: speed,
				preload: true,
				preloadImage: jQuery("#slider").attr('data-loader')
			});
		
		}
		
	}
	

/*-----------------------------------------------------------------------------------*/
/*	Image Overlays
/*-----------------------------------------------------------------------------------*/
	
	function tz_postThumbOverlay() {
	
		var postThumb = jQuery('.post-thumb a');
		
		postThumb.hover( function() {
		
			jQuery(this).find('.post-thumb-overlay').stop().css({
				opacity: 0,
				display: 'block'
			}).animate({
				opacity: 1
			}, 200);
			
		}, function() {
			jQuery(this).find('.post-thumb-overlay').stop().fadeOut(200);
		});
		
	}
	
	tz_postThumbOverlay();


/*-----------------------------------------------------------------------------------*/
/*	Post Thumb Hover Effects
/*-----------------------------------------------------------------------------------*/
	
	var postThumb = jQuery('#primary-blog .post-thumb a');
		
	postThumb.hover( function() {
		jQuery(this).animate({ opacity: 0.8 }, 200);
	}, function() {
		jQuery(this).animate({ opacity: 1 }, 200);
	});
	
/*-----------------------------------------------------------------------------------*/
/*	Filter States
/*-----------------------------------------------------------------------------------*/
	
	var filterLinks = jQuery('#filter li a');
	
	filterLinks.click( function(e) {
		filterLinks.removeClass('active');
		
		filterLinks.not(this).find('span.border').fadeOut(100);
		
		jQuery(this).addClass('active');
		
		e.preventDefault();
	});
	
	filterLinks.hover( function(e) {
		
		jQuery(this).not('.active').find('span.border').fadeIn(100);
		
	}, function() {
	
		jQuery(this).not('.active').find('span.border').fadeOut(100);
		
	});

/*-----------------------------------------------------------------------------------*/
/*	Sticky Footer
/*-----------------------------------------------------------------------------------*/
	
	function stickyFooter() {
		
		var windowHeight = jQuery(window).height();
		var footerHeight = jQuery('#footer').outerHeight();
		
		jQuery('#content').css('min-height', windowHeight - footerHeight - 280);
		
	}
	
	stickyFooter();
	
	jQuery(window).resize( function () {
		stickyFooter();
	});
	
   	
/*-----------------------------------------------------------------------------------*/
/*	Pause Button
/*-----------------------------------------------------------------------------------*/


			
/*-----------------------------------------------------------------------------------*/
/*	Center Function
/*-----------------------------------------------------------------------------------*/

	;(function(b,a){b.fn.center=function(c){var d,e;d=b(a);e=d.scrollTop();return this.each(function(){var h,g,f;h=b(this);g=b.extend({against:"window",top:false,topPercentage:0.5},c);f=function(){var j,i,k;if(g.against==="window"){j=d;}else{if(g.against==="parent"){j=h.parent();e=0;}else{j=h.parents(against);e=0;}}i=((j.width())-(h.outerWidth()))*0.5;k=((j.height())-(h.outerHeight()))*g.topPercentage+e;if(g.top){k=g.top+e;}h.css({left:i,top:k});};f();d.resize(f);});};})(jQuery,window);
	
	function tz_setLayout() {
		
		jQuery( '#primary-wrap' ).center({
			against : 'parent'
		});
	
	}
	
	tz_setLayout();

/*-----------------------------------------------------------------------------------*/
/*	Load More Post Functions
/*-----------------------------------------------------------------------------------*/

	
	
	if(jQuery('body').hasClass('page-template-template-home-php')) {
	
		var loader = jQuery('#loading');
		var progressBar = jQuery( ".progress-bar-bg" );
		var pause = jQuery('.pause a');
		var pauseStatus = false;
		var time = parseInt(jQuery('#progress-bar').attr('data-time'));
		var elem = jQuery('#primary');
		
		jQuery('#slide-left, #slide-right').fadeIn(200);
		
		jQuery('#primary-wrap').css({
			height: jQuery('#primary').height()
		});
		
					
		function tz_progressBar(pauseStatus) {
			
			if(pauseStatus == false) {
			
				progressBar.stop(true).animate({
					width: 181
				}, time, function() {
					var rightLink = jQuery('#slide-right a');
					var rightId = parseInt(rightLink.attr('data-id'));
					tz_getPost(rightId, false, false);
				});
				
				progressBar.animate({
					width: 0
				}, 200);
				
			}
			
		}
		
		tz_progressBar(pauseStatus);
		
		function tz_loadPost(pauseStatus) {
		
			var rightLink = jQuery('#slide-right a');
			var rightId = parseInt(rightLink.attr('data-id'));
			var leftLink = jQuery('#slide-left a');
			var leftId = parseInt(leftLink.attr('data-id'));
			
			if(pauseStatus == false) {
			
				pause.toggle( function () {
			
					jQuery(this).addClass('active');
					progressBar.stop(true);
					pauseStatus = true;
					
				}, function() {
					
					pauseStatus = false;
					var newTime = time / 181;
					var speed = (180 - progressBar.width()) * newTime;
		
					jQuery(this).removeClass('active');
					
					progressBar.stop(true).animate({
						width: 181
					}, speed, function() {
						var rightLink = jQuery('#slide-right a');
						var rightId = parseInt(rightLink.attr('data-id'));
						tz_getPost(rightId, false, pauseStatus);
					});
					
					progressBar.animate({
						width: 0
					}, 200);
			
				});
				
			} else {
			
				pause.toggle( function () {
			
					pauseStatus = false;
					var newTime = time / 181;
					var speed = (180 - progressBar.width()) * newTime;
		
					jQuery(this).removeClass('active');
					
					progressBar.stop(true).animate({
						width: 181
					}, speed, function() {
						var rightLink = jQuery('#slide-right a');
						var rightId = parseInt(rightLink.attr('data-id'));
						tz_getPost(rightId, false, pauseStatus);
					});
					
					progressBar.animate({
						width: 0
					}, 200);
					
				}, function() {
				
					jQuery(this).addClass('active');
					progressBar.stop(true);
					pauseStatus = true;

			
				});
			
			}

	
			rightLink.click(function(e) {
				
				//console.log(pauseStatus);
				
				if(pauseStatus == false) {
					progressBar.stop(true).animate({
						width: 0
					}, 200);
				}
				
				tz_getPost(rightId, false, pauseStatus);
				
				e.preventDefault();
				
			});
			
			leftLink.click(function(e) {
				
				if(pauseStatus == false) {
					progressBar.stop(true).animate({
						width: 0
					}, 200);
				}
				
				tz_getPost(leftId, true, pauseStatus);
				
				e.preventDefault();
				
			});
		
		}
		
		tz_loadPost(pauseStatus);
		
		function tz_getPost(id, reverse, pauseStatus) {
		
			//console.log(pauseStatus);
			
			var entry = jQuery('#primary .hentry');
			var distanceAmount = 100;
			var entryHeight = jQuery('#primary .hentry').height();
			var distance = -distanceAmount;
			
			jQuery('#slide-left, #slide-right').fadeOut(200);
			
			if(reverse == true) {
				distance = distanceAmount;
			}

			entry.animate({
				left: distance,
				opacity: 0
			}, 500, 'easeInOutQuart', function () {
				
				distance = distanceAmount;
				
				if(reverse == true) {
					distance = -distanceAmount;
				}
				
				jQuery('.pause').prepend('<span></span>');
					
				loader.fadeIn(200, function() {
					
					jQuery('#primary-wrap').load(elem.attr('data-src'), {
						id: id
					}, function() {
						
						jQuery('#slide-left, #slide-right').css({
							display: 'none'
						});
						
						tz_loadPost(pauseStatus);
						
						jQuery('#primary .hentry').css({
							left: distance,
							opacity: 0
						});
						
						jQuery('#magic-door').find('img').batchImageLoad( {
						
							loadingCompleteCallback: function () { 
							
								jQuery('#primary-wrap').animate({
									height: jQuery('#primary').height()
								}, 500, 'easeInOutQuart', function () {
									
									tz_setLayout();
									
									jQuery('#primary .hentry').animate({
										left: 0,
										opacity: 1
									}, 500, 'easeInOutQuart', function () {
										
										jQuery('#slide-left, #slide-right').fadeIn(200);
										
										loader.fadeOut(200, function () {
											
											jQuery('.pause').find('span').remove();
											
											tz_progressBar(pauseStatus);																					
										});
										
									});
									
								});

							}
						});

					});
						
				});
			
			});	
			
		} 	
	
	}
	
/*-----------------------------------------------------------------------------------*/
/*	PrettyPhoto Lightbox
/*-----------------------------------------------------------------------------------*/
	
	function tz_fancybox() {
		
		if(jQuery().fancybox) {
			jQuery("a.lightbox").fancybox({
				'transitionIn'	:	'fade',
				'transitionOut'	:	'fade',
				'speedIn'		:	300, 
				'speedOut'		:	300, 
				'overlayShow'	:	true,
				'autoScale'		:	true,
				'titleShow'		: 	false,
				'margin'		: 	10,
				onClosed		: function() {
					jQuery('.post-thumb-overlay').fadeOut(200);
				}
			});
		}
	}
	
	tz_fancybox();
	
/*-----------------------------------------------------------------------------------*/
/*	Portfolio Sorting
/*-----------------------------------------------------------------------------------*/
	
	if (jQuery().quicksand) {

		(function($) {
			
			$.fn.sorted = function(customOptions) {
				var options = {
					reversed: false,
					by: function(a) {
						return a.text();
					}
				};
		
				$.extend(options, customOptions);
		
				$data = jQuery(this);
				arr = $data.get();
				arr.sort(function(a, b) {
		
					var valA = options.by($(a));
					var valB = options.by($(b));
			
					if (options.reversed) {
						return (valA < valB) ? 1 : (valA > valB) ? -1 : 0;				
					} else {		
						return (valA < valB) ? -1 : (valA > valB) ? 1 : 0;	
					}
			
				});
		
				return $(arr);
		
			};
		
		})(jQuery);
		
		jQuery(function() {
		
			var read_button = function(class_names) {
				
				var r = {
					selected: false,
					type: 0
				};
				
				for (var i=0; i < class_names.length; i++) {
					
					if (class_names[i].indexOf('selected-') == 0) {
						r.selected = true;
					}
				
					if (class_names[i].indexOf('segment-') == 0) {
						r.segment = class_names[i].split('-')[1];
					}
				};
				
				return r;
				
			};
		
			var determine_sort = function($buttons) {
				var $selected = $buttons.parent().filter('[class*="selected-"]');
				return $selected.find('a').attr('data-value');
			};
		
			var determine_kind = function($buttons) {
				var $selected = $buttons.parent().filter('[class*="selected-"]');
				return $selected.find('a').attr('data-value');
			};
		
			var $preferences = {
				duration: 500,
				adjustHeight: false
			}
		
			var $list = jQuery('.image-grid');
			var $data = $list.clone();
		
			var $controls = jQuery('#filter');
		
			$controls.each(function(i) {
		
				var $control = jQuery(this);
				var $buttons = $control.find('a');
		
				$buttons.bind('click', function(e) {
		
					var $button = jQuery(this);
					var $button_container = $button.parent();
					
					var button_properties = read_button($button_container.attr('class').split(' '));      
					var selected = button_properties.selected;
					var button_segment = button_properties.segment;
		
					if (!selected) {
		
						$buttons.parent().removeClass();
						$button_container.addClass('selected-' + button_segment);
		
						var sorting_type = determine_sort($controls.eq(1).find('a'));
						var sorting_kind = determine_kind($controls.eq(0).find('a'));
		
						if (sorting_kind == 'all') {
							var $filtered_data = $data.find('li');
						} else {
							var $filtered_data = $data.find('li.' + sorting_kind);
						}
		
						var $sorted_data = $filtered_data.sorted({
							by: function(v) {
								return parseInt(jQuery(v).find('.count').text());
							}
						});
		
						$list.quicksand($sorted_data, $preferences, function () {
								tz_fancybox();
								tz_postThumbOverlay();
						});
						
						console.log($sorted_data);
			
					}
			
					e.preventDefault();
					
				});
			
			}); 
			
		});
	
	}

	
/*-----------------------------------------------------------------------------------*/
/*	All done!
/*-----------------------------------------------------------------------------------*/

});

/**
 *  Plugin which is applied on a list of img objects and calls
 *  the specified callback function, only when all of them are loaded (or errored).
 *  @author:  H. Yankov (hristo.yankov at gmail dot com)
 *  @version: 1.0.0 (Feb/22/2010)
 *	http://yankov.us
 */

(function($) {
$.fn.batchImageLoad = function(options) {
	var images = $(this);
	var originalTotalImagesCount = images.size();
	var totalImagesCount = originalTotalImagesCount;
	var elementsLoaded = 0;

	// Init
	$.fn.batchImageLoad.defaults = {
		loadingCompleteCallback: null, 
		imageLoadedCallback: null
	}
    var opts = $.extend({}, $.fn.batchImageLoad.defaults, options);
		
	// Start
	images.each(function() {
		// The image has already been loaded (cached)
		if ($(this)[0].complete) {
			totalImagesCount--;
			if (opts.imageLoadedCallback) opts.imageLoadedCallback(elementsLoaded, originalTotalImagesCount);
		// The image is loading, so attach the listener
		} else {
			$(this).load(function() {
				elementsLoaded++;
				
				if (opts.imageLoadedCallback) opts.imageLoadedCallback(elementsLoaded, originalTotalImagesCount);

				// An image has been loaded
				if (elementsLoaded >= totalImagesCount)
					if (opts.loadingCompleteCallback) opts.loadingCompleteCallback();
			});
			$(this).error(function() {
				elementsLoaded++;
				
				if (opts.imageLoadedCallback) opts.imageLoadedCallback(elementsLoaded, originalTotalImagesCount);
					
				// The image has errored
				if (elementsLoaded >= totalImagesCount)
					if (opts.loadingCompleteCallback) opts.loadingCompleteCallback();
			});
		}
	});

	// There are no unloaded images
	if (totalImagesCount <= 0)
		if (opts.loadingCompleteCallback) opts.loadingCompleteCallback();
};
})(jQuery);