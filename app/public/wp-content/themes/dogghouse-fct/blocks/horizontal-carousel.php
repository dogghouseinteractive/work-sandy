<?php global $block_count; ?>

<?php
	$background_image_key = get_sub_field_object('background_image')['key'];
	$background_image_label = get_sub_field_object('background_image')['label'];
	$background_image_key = get_sub_field_object('background_image')['key'];
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
	$slide_count = count(get_sub_field('slides'));
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

<section id="block-<?php echo $block_count; ?>" class="flexible-content-block horizontal-carousel" aria-labelledby="<?php echo $aria_label; ?>" style="height: calc(340px * <?php echo $slide_count; ?>);">
	<?php if($eyebrow || $heading || $content) { ?>
		<div class="container">
			<?php if($background_image) { ?>
				<div class="background-image<?php if($bg_img_animation_style) { echo ' lazy ' . $bg_img_animation_style; } ?>" style="background-image: url(<?php echo $background_image; ?>);">
					<div id="<?php echo $background_image_key; ?>-container" data-field-label="<?php echo $background_image_label; ?>" class="acf-field-container">
						<div id="<?php echo $bg_img_animation_style_key; ?>-container" class="acf-field-container"></div>
					</div>
				</div>
			<?php } ?>
			<div class="block-content-container">
				<?php if($eyebrow) { ?>
					<h3 id="<?php echo $aria_label; ?>" class="eyebrow">
						<div id="<?php echo $eyebrow_key; ?>-container" data-field-label="<?php echo $eyebrow_label; ?>" class="acf-field-container"></div>
						<?php echo $eyebrow; ?>
					</h3>
				<?php } ?>	
				<?php if($heading) { ?>
					<?php if($block_count == 0) { ?>
						<h1 class="block-heading lazy fade-in-down"<?php if(!$eyebrow) { echo ' id="'.$aria_label.'"'; } ?>>
							<div id="<?php echo $heading_key; ?>-container" data-field-label="<?php echo $heading_label; ?>" class="acf-field-container"></div>
							<?php echo $heading; ?>
						</h1>
					<?php } else { ?>
						<h2 class="block-heading lazy fade-in-down"<?php if(!$eyebrow) { echo ' id="'.$aria_label.'"'; } ?>>
							<div id="<?php echo $heading_key; ?>-container" data-field-label="<?php echo $heading_label; ?>" class="acf-field-container"></div>
							<?php echo $heading; ?>
						</h2>
					<?php } ?>
				<?php } ?>
				<?php if($content) { ?>
					<div class="block-content lazy fade-in-up delay-one-quarter">
						<div id="<?php echo $content_key; ?>-container" data-field-label="<?php echo $content_label; ?>" class="acf-field-container"></div>
						<?php echo $content; ?>
					</div>
				<?php } ?>
			</div>
			<?php $total_slides = count(get_sub_field('slides')); ?>
			<?php if(have_rows('slides')) { ?>
				<div class="slider-holder">
					<div class="slider cycle-slideshow horizontal lazy fade-in delay-one-quarter">
						<?php while(have_rows('slides')) { ?>
							<?php the_row(); ?>
							<?php $slide_icon_key = get_sub_field_object('slide_icon')['key']; ?>
							<?php $slide_icon_label = get_sub_field_object('slide_icon')['label']; ?>
							<?php $slide_icon = get_sub_field('slide_icon'); ?>
							<?php $slide_eyebrow_key = get_sub_field_object('slide_eyebrow')['key']; ?>
							<?php $slide_eyebrow_label = get_sub_field_object('slide_eyebrow')['label']; ?>
							<?php $slide_eyebrow = get_sub_field('slide_eyebrow'); ?>
							<?php $slide_heading_key = get_sub_field_object('slide_heading')['key']; ?>
							<?php $slide_heading_label = get_sub_field_object('slide_heading')['label']; ?>
							<?php $slide_heading = get_sub_field('slide_heading'); ?>
							<?php $slide_content_key = get_sub_field_object('slide_content')['key']; ?>
							<?php $slide_content_label = get_sub_field_object('slide_content')['label']; ?>
							<?php $slide_content = get_sub_field('slide_content'); ?>
							<?php $slide_aria_label = ''; ?>
							<?php if($slide_eyebrow) {
									$slide_aria_label = $slide_eyebrow;
								} else if($slide_heading) {
									$slide_aria_label = $slide_heading;
								} 
								$slide_aria_label = strip_tags(str_replace(' ', '-', strtolower($slide_aria_label)));
								$slide_aria_label = preg_replace('/(?![-])\p{P}/u', '', $slide_aria_label); 
							?>
							<div class="slide"<?php if($slide_aria_label) { echo ' aria-labelledby=' . $slide_aria_label; } ?>>
								<div class="slide-container">
									<div class="slide-counter">
										<?php echo get_row_index(); ?> / <?php echo $total_slides; ?>
									</div>
									<div class="slide-header">
										<?php if($slide_icon) { ?>
											<div class="slide-icon">
												<img src="<?php echo $slide_icon; ?>">
											</div>
										<?php } ?>
										<?php if($slide_eyebrow) { ?>
											<h3 id="<?php echo $slide_aria_label; ?>" class="eyebrow">
												<div id="<?php echo $slide_eyebrow_key; ?>-container" data-field-label="<?php echo $slide_eyebrow_label; ?>" class="acf-field-container"></div>
												<?php echo $slide_eyebrow; ?>
											</h3>
										<?php } ?>	
										<?php if($slide_heading) { ?>
											<h2<?php if(!$slide_eyebrow) { echo ' id="'.$slide_aria_label.'"'; } ?>>
												<div id="<?php echo $slide_heading_key; ?>-container" data-field-label="<?php echo $slide_heading_label; ?>" class="acf-field-container"></div>
												<?php echo $slide_heading; ?>
											</h2>
										<?php } ?>
									</div>
									<?php if($slide_content) { ?>
										<div class="slide-content">
											<div id="<?php echo $slide_content_key; ?>-container" data-field-label="<?php echo $slide_content_label; ?>" class="acf-field-container"></div>
											<?php echo $slide_content; ?>
										</div>
									<?php } ?>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
		</div>
	<?php } ?>
</section>


<script type="text/javascript">
//	function buildCarousel() {
//		let carouselVisible = 4;
//		if(jQuery(window).innerWidth() < 767) {
//			carouselVisible = 1;
//		} else if ( jQuery(window).innerWidth() >= 768 && jQuery(window).innerWidth() < 1024 ) {
//			carouselVisible = 2;
//		} else if ( jQuery(window).innerWidth() >= 1024 && jQuery(window).innerWidth() < 1366 ) {
//			carouselVisible = 3; 
//		} else if ( jQuery(window).innerWidth() >= 1366 ) {
//			carouselVisible = 4;
//		} 
//		jQuery('#block-<?php //echo $block_count; ?> .slider').cycle({
//			fx : 'carousel',
//			carouselVisible : carouselVisible,
//			carouselFluid : true,
//			timeout : 0,
//			speed: 500,
//			slides : '>div.slide',
//			swipe : true,
//			pager : '#block-<?php //echo $block_count; ?>-pager',
//			loop: false,
//			allowWrap: false,
//			autoHeight : 'calc'
//		});
//	}
	
	jQuery(document).ready(function() {
		var thisBlockOffsetTop = jQuery('#block-<?php echo $block_count; ?>').offset().top;
		var slideCount = <?php echo count(get_sub_field('slides')); ?>;
		var item = document.querySelector('.slider.horizontal')
		;(function(){
			var throttle = function(type, name, obj){
				var obj = obj || window;
				var running = false;
				var func = function(){
					if (running){ return; }
					running = true;
					requestAnimationFrame(function(){
						obj.dispatchEvent(new CustomEvent(name));
						running = false;
					});
				};
				obj.addEventListener(type, func);
			};

			throttle("scroll", "optimizedScroll");
		})();

		window.addEventListener("optimizedScroll", function(){
			var windowWidth = jQuery(window).width();
			if(windowWidth >= 1024) {
				var scrollPosOverDiv = Math.floor(window.pageYOffset - thisBlockOffsetTop);
				item.style.transform = "translate( -" + scrollPosOverDiv + "px, 0px)";
			}
		})
		
		//buildCarousel();
		var tallestSlide = 0;
		jQuery('#block-<?php echo $block_count; ?> .slider .slide .slide-container .slide-content').each(function() {
			if(jQuery(this).height() > tallestSlide) {
				tallestSlide = jQuery(this).height();
			}
		});
		jQuery('#block-<?php echo $block_count; ?> .slider .slide .slide-container .slide-content').height(tallestSlide);
	});

	jQuery(window).on('resize', function() {
		setTimeout(function() {
			//jQuery('#block-<?php //echo $block_count; ?> .slider').cycle('destroy');
			//buildCarousel();
			jQuery('#block-<?php echo $block_count; ?> .slider .slide .slide-container .slide-content').height('auto');
			var tallestSlide = 0;
			jQuery('#block-<?php echo $block_count; ?> .slider .slide .slide-container .slide-content').each(function() {
				if(jQuery(this).height() > tallestSlide) {
					tallestSlide = jQuery(this).height();
				}
			});
			jQuery('#block-<?php echo $block_count; ?> .slider .slide .slide-container .slide-content').height(tallestSlide);
		}, 300);
	});
</script>
