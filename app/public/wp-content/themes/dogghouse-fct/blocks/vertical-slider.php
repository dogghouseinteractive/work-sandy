<?php global $block_count; ?>

<?php
	$background_color_toggle_key = get_sub_field_object('background_color_toggle')['key'];
	$background_color_toggle_label = get_sub_field_object('background_color_toggle')['label'];
	$background_color_toggle = get_sub_field('background_color_toggle');
	$text_color_toggle_key = get_sub_field_object('text_color_toggle')['key'];
	$text_color_toggle_label = get_sub_field_object('text_color_toggle')['label'];
	$text_color_toggle = get_sub_field('text_color_toggle');
	$background_image_key = get_sub_field_object('background_image')['key'];
	$background_image_label = get_sub_field_object('background_image')['label'];
	$background_image = get_sub_field('background_image');
	$bg_img_animation_style_key = get_sub_field_object('bg_image_animation_style')['key'];
	$bg_img_animation_style = get_sub_field('bg_image_animation_style');
	$eyebrow_key = get_sub_field_object('block_eyebrow')['key'];
	$eyebrow_label = get_sub_field_object('block_eyebrow')['label'];
	$eyebrow = get_sub_field('block_eyebrow');
	$heading_key = get_sub_field_object('block_heading')['key'];
	$heading_label = get_sub_field_object('block_heading')['label'];
	$heading = get_sub_field('block_heading');
	$content_key = get_sub_field_object('block_content')['key'];
	$content_label = get_sub_field_object('block_content')['label'];
	$content = get_sub_field('block_content');
	$aria_label = '';
	if($eyebrow) {
		$aria_label = $eyebrow;
	} else if($heading) {
		$aria_label = $heading;
	} else {
		$aria_label = get_the_title();
	}
	$aria_label = strip_tags(str_replace(' ', '-', strtolower($aria_label)));
	$aria_label = preg_replace('/(?![-])\p{P}/u', '', $aria_label); 
?>

<section id="block-<?php echo $block_count; ?>" class="flexible-content-block vertical-slider<?php if($text_color_toggle) { echo ' text-' . $text_color_toggle;} ?>" aria-labelledby="<?php echo $aria_label; ?>">
	<div class="block-content-wrapper">
		<div class="block-content-container lazy<?php if($background_color_toggle) { echo ' background-' . $background_color_toggle; } ?><?php if($bg_img_animation_style) { echo ' ' . $bg_img_animation_style; } else { echo ' fade-in'; } ?>"<?php if($background_image) { echo ' style="background-image: url(' . $background_image . ');"'; } ?>>
			<?php if($eyebrow || $heading || $content) { ?>
				<?php if($eyebrow) { ?>
					<h3 id="<?php echo $aria_label; ?>" class="eyebrow">
						<div id="<?php echo $eyebrow_key; ?>-container" data-field-label="<?php echo $eyebrow_label; ?>" class="acf-field-container"></div>
						<?php echo $eyebrow; ?>
					</h3>
				<?php } ?>	
				<?php if($heading) { ?>
					<?php if($block_count == 0) { ?>
						<h1<?php if(!$eyebrow) { echo ' id="'.$aria_label.'"'; } ?>>
							<div id="<?php echo $heading_key; ?>-container" data-field-label="<?php echo $heading_label; ?>" class="acf-field-container"></div>
							<?php echo $heading; ?>
						</h1>
					<?php } else { ?>
						<h2<?php if(!$eyebrow) { echo ' id="'.$aria_label.'"'; } ?>>
							<div id="<?php echo $heading_key; ?>-container" data-field-label="<?php echo $heading_label; ?>" class="acf-field-container"></div>
							<?php echo $heading; ?>
						</h2>
					<?php } ?>
				<?php } ?>
				<?php if($content) { ?>
					<div class="block-content">
						<div id="<?php echo $content_key; ?>-container" data-field-label="<?php echo $content_label; ?>" class="acf-field-container"></div>
						<?php echo $content; ?>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
		<?php if(have_rows('slides')) { ?>
			<div class="slideshow-container lazy fade-in-right">
				<div class="slider vertical cycle-slideshow" data-cycle-fx="carousel" data-cycle-carousel-vertical="true" data-cycle-swipe="false" data-cycle-timeout="0" data-cycle-speed="500" data-cycle-slides="> div.slide" data-cycle-allow-wrap="false" data-cycle-loop="true" data-cycle-carousel-visible="1">
					<?php while(have_rows('slides')) { ?>
						<?php the_row(); ?>
						<?php $slide_content_key = get_sub_field_object('slide_content')['key']; ?>
						<?php $slide_content_label = get_sub_field_object('slide_content')['label']; ?>
						<?php $slide_content = get_sub_field('slide_content'); ?>
						<?php $slide_aria_label = ''; ?>
						<?php if($slide_content) {
								$slide_aria_label = $slide_content;
							} 
							$slide_aria_label = strip_tags(str_replace(' ', '-', strtolower($slide_aria_label)));
							$slide_aria_label = preg_replace('/(?![-])\p{P}/u', '', $slide_aria_label); 
						?>
						<div class="slide"<?php if($slide_aria_label) { echo ' aria-labelledby=' . $slide_aria_label; } ?>>
							<?php if($slide_content) { ?>
								<div id="<?php echo $slide_aria_label; ?>" class="slide-content">
									<div id="<?php echo $slide_content_key; ?>-container" data-field-label="<?php echo $slide_content_label; ?>" class="acf-field-container"></div>
										<?php echo $slide_content; ?>
								</div>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
	</div>
</section>

<script type="text/javascript">
            
  jQuery(document).ready(function() {
    var currentSlide = 0;
    var mainBlock = document.getElementById( 'main' );
    if ( mainBlock.addEventListener ) {
      // IE9, Chrome, Safari, Opera
      mainBlock.addEventListener("mousewheel", MouseWheelHandler, false);
      // Firefox
      mainBlock.addEventListener("DOMMouseScroll", MouseWheelHandler, false);
    }
    // IE 6/7/8
    else mainBlock.attachEvent("onmousewheel", MouseWheelHandler);

    thisBlock = jQuery( '#block-<?php echo $block_count; ?>' );
    thisBlock.on( 'cycle-initialized', function (e, optionHash) {
      currentSlide = optionHash.currSlide;
      totalSlides = optionHash.slideCount;
    });
    thisBlock.on('cycle-view-change', function (e, optionHash) {
      currentSlide = optionHash.currSlide;		
    });
    thisBlock.on('cycle-update-view', function (e, optionHash) { 
      currentSlide = optionHash.currSlide;		
    });																							

    function isOnScreen(element) {
      var curPos = element.offset();
      var curTop = curPos.top - 100;
      var screenHeight = jQuery(window).height();
      return (curTop > screenHeight) ? false : true;
    }

    function checkVisible( elm ) {
      var vpH = jQuery(window).height(), // Viewport Height
        st = jQuery(window).scrollTop(), // Scroll Top
        y = elm.offset().top,
        elementHeight = elm.height();
      return ((y < (vpH + st)) && (y > (st - elementHeight)));
    }

    function MouseWheelHandler(e) {
      var slides = thisBlock.find( '.slider');
      var e = window.event || e;
      var delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));

      // handle changes to slides based on delta (1 for up, -1 for down)
      // Scrolling down and not out of slides
      var scroll = jQuery('#main').scrollTop();
      var thisBlockID = thisBlock.attr('ID');
      var currBlock = document.getElementById(thisBlockID);
      var currBlockTop = currBlock.offsetTop;

      // TODO This needs to evaluate to true at whatever point the slide block
      // has sufficiently entered the viewport.
      var lockScroll = false;
      var lockScroll = checkVisible( thisBlock );
      var lockScroll = isOnScreen( thisBlock );

      if ( lockScroll && delta == -1 && currentSlide < totalSlides - 1 ) {
        e.preventDefault();
        slides.cycle( 'next');
        return false;
      }
      if ( lockScroll && delta == 1 && currentSlide !== 0 ) {
        e.preventDefault();
        slides.cycle( 'prev');
        return false;
      }
    }

    // Make the entire carousel move up as the new slide becomes active, to make it look like a teleprompter
    
    var currSliderOffsetTop = 0;
    var slide = 1;
    jQuery('#block-<?php echo $block_count; ?> .slider.vertical').on('cycle-after', function() {
      if(slide == <?php echo count(get_sub_field('slides')); ?>) {
        currSliderOffsetTop = 0;
        slide = 1;
        jQuery('#block-<?php echo $block_count; ?> .slider.vertical').animate({
          top: 0,
        }, 500);
      } else {
        let activeSlideHeight = jQuery('#block-<?php echo $block_count; ?> .slider.vertical .cycle-slide-active').outerHeight();
        let sliderOffset = Math.floor(currSliderOffsetTop - activeSlideHeight);
        jQuery('#block-<?php echo $block_count; ?>-pager').animate({
          top: sliderOffset,
        }, 500);
        currSliderOffsetTop = sliderOffset;
        slide++;
      }
    });
  });

</script>
