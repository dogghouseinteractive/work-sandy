jQuery(document).ready(function() {
	lazyload();
	var headerHeight = jQuery('header.site-header').outerHeight();
	var windowHeight = jQuery(window).height();
	var totalContentBlocks = jQuery('.flexible-content-block').length;
	var secondLastBlock = totalContentBlocks - 3; // 3 instead of 1 because block-count id starts at 0, and the footer is also a flexible content block
	
	setTimeout(function() {
		jQuery('#main').css('margin-top', headerHeight);
	}, 100);
	
	//Handle the Hamburger open/close logic
	jQuery('#hamburger').on('click', function() {
		if(jQuery(this).hasClass('clicked')) {
			jQuery(this).removeClass('clicked');
			jQuery(this).css('top', '50%');
			jQuery('body').removeClass('nav-is-open');
		} else {
			jQuery(this).addClass('clicked');
			jQuery('body').addClass('nav-is-open');
			jQuery('header #hamburger-toggle-menu.clicked').css('padding-top', 0);
		}
		if(jQuery('.top-bun, .patty, .bottom-bun').hasClass('animated')) {
			jQuery('.top-bun, .patty, .bottom-bun').removeClass('animated').css('opacity', '1.0');
		}
		jQuery('#hamburger-toggle-menu').toggleClass('clicked');
	});
	
	//Prevent parent menu item from triggering navigation on click when sub nav exists
	jQuery('#toggle-nav li.menu-item-has-children').on('click', function() {
		jQuery(this).toggleClass('clicked');
	});
	jQuery('#toggle-nav li.menu-item-has-children .sub-menu li a').on('click', function(e) {
		e.stopPropagation();
	});
	jQuery('#toggle-nav li.menu-item-has-children > a').on('click', function(e) {
		e.preventDefault();
	});
	
	let highestOffset = 0;
	
	jQuery(document).imagesLoaded(function() {
		jQuery('#main').stellar();
		// Lazy load recent posts on page load, not JUST on scroll
		var scroll = jQuery(window).scrollTop();
		scroll = scroll + 32;
		if(jQuery('.flexible-content-block').length > 2) {
			if(scroll < 400) {
				jQuery('.two-column-cta').removeClass('reveal');
			} else {
				jQuery('.two-column-cta').addClass('reveal');
			}
		} else {
			jQuery('.two-column-cta').addClass('reveal');
		}
		jQuery('.flexible-content-block').each(function() {
			var thisBlock = jQuery(this);
			var thisBlockID = thisBlock.attr('ID');
			var currBlock = document.getElementById(thisBlockID);
			var currBlockTop = currBlock.offsetTop;
			var currBlockHeight = thisBlock.outerHeight();
			console.log(thisBlock.offset().top);
			if(thisBlock.offset().top > highestOffset) {
				highestOffset = thisBlock.offset().top;
			}
			if(scroll < currBlockTop || scroll > Math.floor(currBlockTop + windowHeight ) ) {
				// do nothing
			} else {
 				jQuery('#' + thisBlockID).find('.lazy').each(function() {
					jQuery(this).attr('loaded', 'true');
					jQuery(this).addClass('animated');
					if(jQuery(this).hasClass('fade-in-up')) {
						jQuery(this).addClass('fadeInUp');
					}
					if(jQuery(this).hasClass('fade-in-down')) {
						jQuery(this).addClass('fadeInDown');
					}
					if(jQuery(this).hasClass('fade-in-left')) {
						jQuery(this).addClass('fadeInLeft');
					}
					if(jQuery(this).hasClass('fade-in-right')) {
						jQuery(this).addClass('fadeInRight');
					}
					if(jQuery(this).hasClass('fade-in')) {
						jQuery(this).addClass('fadeIn');
					}
					if(jQuery(this).hasClass('zoom-in')) {
						jQuery(this).addClass('zoomIn');
						jQuery(this).css('opacity', 1.0);
					}
				});
			} 
		});
	});
	function masonry() {
		jQuery('.masonry').imagesLoaded(function() {
			jQuery('.masonry').masonry({
				itemSelector: 'a'
			});
		});
	}
	setTimeout(masonry, 300);
	
	jQuery('.brick').each(function () {
		var frontHeight = jQuery(this).children('.front').outerHeight();
		jQuery(this).children('.back').height(frontHeight);
		jQuery(this).on('click', function() {
			if(jQuery(this).hasClass('clicked')) {
				jQuery(this).removeClass('clicked');
			} else {
				jQuery(this).addClass('clicked');
			}
		})
	});

});

jQuery(window).on('scroll', function() {
	var windowWidth = jQuery(window).width();
	var windowHeight = jQuery(window).height();
	var scroll = jQuery(window).scrollTop();
	if(jQuery('.flexible-content-block').length > 2) {
		if(scroll < 400) {
			jQuery('.two-column-cta').removeClass('reveal');
		} else {
			jQuery('.two-column-cta').addClass('reveal');
		}
	} else {
		jQuery('.two-column-cta').addClass('reveal');
	}
	jQuery(function() {
		var $el = jQuery('.parallax-background');
		$el.css({
				'background-position':'50% '+(-.4*scroll)+'px'
		});
	});
	scroll = scroll + 32;
	jQuery('.flexible-content-block').each(function() {
		var thisBlock = jQuery(this);
		var thisBlockID = thisBlock.attr('ID');
		var currBlock = document.getElementById(thisBlockID);
		var currBlockTop = currBlock.offsetTop;
		var currBlockHeight = thisBlock.outerHeight();
		if(windowWidth >= 1024) {
			if(thisBlock.hasClass('vertical-slider')) {
				if(scroll >= Math.floor(currBlockTop + windowHeight + 150)) {		
					if(jQuery('#' + thisBlockID).find('h2.slider-heading').hasClass('hide')) {
						// do nothing
					} else {
						jQuery('#' + thisBlockID).find('h2.slider-heading').addClass('hide');
					}
				} else {
					if(jQuery('#' + thisBlockID).find('h2.slider-heading').hasClass('hide')) {
						jQuery('#' + thisBlockID).find('h2.slider-heading').removeClass('hide');
					} else {
						// do nothing
					}
				}
			}
		}
		if(scroll < currBlockTop - 400 || scroll > Math.floor(currBlockTop + currBlockHeight - 100)) {
			if(thisBlock.hasClass('vertical-slider') || thisBlock.hasClass('horizontal-carousel')) {
				// do nothing
			} else {
				jQuery('#' + thisBlockID).find('.lazy').each(function() {
					if(jQuery(this).hasClass('fade-in-up')) {
						jQuery(this).removeClass('fadeInUp');
						jQuery(this).addClass('fadeOut');
					}
					if(jQuery(this).hasClass('fade-in-down')) {
						jQuery(this).removeClass('fadeInDown');
						jQuery(this).addClass('fadeOut');
					}
					if(jQuery(this).hasClass('fade-in-left')) {
						jQuery(this).removeClass('fadeInLeft');
						jQuery(this).addClass('fadeOut');
					}
					if(jQuery(this).hasClass('fade-in-right')) {
						jQuery(this).removeClass('fadeInRight');
						jQuery(this).addClass('fadeOut');
					}
					if(jQuery(this).hasClass('fade-in')) {
						jQuery(this).removeClass('fadeIn');
						jQuery(this).addClass('fadeOut');
					}
					if(jQuery(this).hasClass('zoom-in')) {
						jQuery(this).removeClass('zoomIn');
							jQuery(this).css('opacity', 0);
						jQuery(this).addClass('fadeOUt');
					}
					setTimeout(function() {
						jQuery(this).removeClass('animated');
					}, 300);
				});
			}
		} else {
			jQuery('#' + thisBlockID).find('.lazy').each(function() {
				jQuery(this).attr('loaded', 'true');
				jQuery(this).addClass('animated');
				if(jQuery(this).hasClass('fade-in-up')) {
					jQuery(this).addClass('fadeInUp');
					jQuery(this).removeClass('fadeOut');
				}
				if(jQuery(this).hasClass('fade-in-down')) {
					jQuery(this).addClass('fadeInDown');
					jQuery(this).removeClass('fadeOut');
				}
				if(jQuery(this).hasClass('fade-in-left')) {
					jQuery(this).addClass('fadeInLeft');
					jQuery(this).removeClass('fadeOut');
				}
				if(jQuery(this).hasClass('fade-in-right')) {
					jQuery(this).addClass('fadeInRight');
					jQuery(this).removeClass('fadeOut');
				}
				if(jQuery(this).hasClass('fade-in')) {
					jQuery(this).addClass('fadeIn');
					jQuery(this).removeClass('fadeOut');
				}
				if(jQuery(this).hasClass('zoom-in')) {
					jQuery(this).addClass('zoomIn');
					jQuery(this).css('opacity', 1.0);
					jQuery(this).removeClass('fadeOut');
				}
			});
		} 
	});

	if(scroll >= 1) {
		jQuery('.masonry').imagesLoaded(function() {
			jQuery('.masonry').masonry({
				itemSelector: 'a'
			});
		});
	}
});

jQuery(window).on('resize', function() {
	var logoHeight = jQuery('#logo').height();
	var headerHeight = jQuery('header.site-header').outerHeight();
	setTimeout(function() {
		jQuery('#main').css('margin-top', headerHeight);
	}, 100);
	jQuery('header #hamburger-toggle-menu').css('padding-top', headerHeight - 1);
//	jQuery('.brick').each(function () {
//		jQuery(this).height('auto');
//		setTimeout(function() {
//			var frontHeight = jQuery(this).children('.front').height() + 60;
//			jQuery(this).children('.back').height(frontHeight);
//		}, 100);
//	});
});

jQuery('#logo').imagesLoaded(function() {
	if(jQuery('#hamburger').hasClass('clicked')) {
		jQuery('body').addClass('nav-is-open');
		jQuery('header #hamburger-toggle-menu').addClass('clicked');
	}
	var logoHeight = jQuery('#logo').height();
	var headerHeight = logoHeight + 40;
	jQuery('header #hamburger-toggle-menu').css('padding-top', headerHeight - 1);
	jQuery('.top-bun, .patty, .bottom-bun, #logo').addClass('animated');
});