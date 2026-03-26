<?php global $block_count; ?>

<?php
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

<section id="block-<?php echo $block_count; ?>" class="flexible-content-block testimonials-slider" aria-labelledby="<?php echo $aria_label; ?>">
	<?php if($eyebrow || $heading || $content) { ?>
		<div class="container">
			<div class="block-content-container">
				<?php if($eyebrow) { ?>
					<h3 id="<?php echo $aria_label; ?>" class="eyebrow lazy fade-in-down slow">
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
					<div class="block-content lazy fade-in-up">
						<div id="<?php echo $content_key; ?>-container" data-field-label="<?php echo $content_label; ?>" class="acf-field-container"></div>
						<?php echo $content; ?>
					</div>
				<?php } ?>
			</div>
			<?php $total_slides = count(get_sub_field('testimonials')); ?>
			<?php if(have_rows('testimonials')) { ?>
				<div class="slider cycle-slideshow lazy fade-in delay-one-quarter" data-cycle-fx="fade" data-cycle-slides="> div.testimonial" data-cycle-timeout="0" data-cycle-speed="500" data-cycle-prev="#block-<?php echo $block_count; ?>-prev" data-cycle-next="#block-<?php echo $block_count; ?>-next">
					<?php while(have_rows('testimonials')) { ?>
						<?php the_row(); ?>
						<?php $icon_key = get_sub_field_object('icon')['key']; ?>
						<?php $icon_label = get_sub_field_object('icon')['label']; ?>
						<?php $icon = get_sub_field('icon'); ?>
						<?php $testimonial_key = get_sub_field_object('testimonial')['key']; ?>
						<?php $testimonial_label = get_sub_field_object('testimonial')['label']; ?>
						<?php $testimonial = get_sub_field('testimonial'); ?>
						<?php $attribution_key = get_sub_field_object('attribution')['key']; ?>
						<?php $attribution_label = get_sub_field_object('attribution')['label']; ?>
						<?php $attribution = get_sub_field('attribution'); ?>
						<?php $slide_aria_label = ''; ?>
						<div class="testimonial">
							<div class="testimonial-container">
								<div class="slide-counter">
									<?php echo get_row_index(); ?> / <?php echo $total_slides; ?>
								</div>
								<div class="testimonial-icon" style="background-image: url(<?php echo $icon; ?>);"></div>
								<div class="testimonial-content">
									<?php echo $testimonial; ?>
								</div>
								<div class="attribution">
									<?php echo $attribution; ?>
								</div>
							</div>
						</div>
					<?php } ?>
					<div class="cycle-nav">
						<div id="block-<?php echo $block_count; ?>-prev" class="cycle-prev"></div>
						<div id="block-<?php echo $block_count; ?>-next" class="cycle-next"></div>
					</div>
				</div>
				
			<?php } ?>
		</div>
	<?php } ?>
</section>

<script type="text/javascript">
	jQuery(document).ready(function() {
		var tallestSlide = 0;
		jQuery('#block-<?php echo $block_count; ?> .slider .testimonial .testimonial-container').each(function() {
			if(jQuery(this).height() > tallestSlide) {
				tallestSlide = jQuery(this).height();
			}
		});
		jQuery('#block-<?php echo $block_count; ?> .slider .testimonial .testimonial-container').height(tallestSlide);
	});
	
	jQuery(window).on('resize', function() {
		setTimeout(function() {
			var tallestSlide = 0;
			jQuery('#block-<?php echo $block_count; ?> .slider .testimonial .testimonial-container').each(function() {
				jQuery(this).height('auto');
				if(jQuery(this).height() > tallestSlide) {
					tallestSlide = jQuery(this).height();
				}
			});
			jQuery('#block-<?php echo $block_count; ?> .slider .testimonial .testimonial-container').height(tallestSlide);
		}, 300);
	});
</script>