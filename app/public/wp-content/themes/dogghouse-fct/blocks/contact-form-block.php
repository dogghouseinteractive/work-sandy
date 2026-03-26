<?php global $block_count; ?>

<?php
	$background_image_key = get_sub_field_object('background_image')['key'];
	$background_image_label = get_sub_field_object('background_image')['label'];
	$background_image = get_sub_field('background_image');
	$bg_img_animation_style_key = get_sub_field_object('bg_image_animation_style')['key'];
	$bg_img_animation_style = get_sub_field('bg_image_animation_style');
	$content_alignment_key = get_sub_field_object('content_alignment')['key'];
	$content_alignment_label = get_sub_field_object('content_alignment')['label'];
	$content_alignment = get_sub_field('content_alignment');
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

<section id="block-<?php echo $block_count; ?>" class="flexible-content-block contact-form-block" aria-labelledby="<?php echo $aria_label; ?>">
	<?php if($background_image) { ?>
		<div class="background-image<?php if($bg_img_animation_style) { echo ' lazy ' . $bg_img_animation_style; } ?>" style="background-image: url(<?php echo $background_image; ?>);">
			<div id="<?php echo $background_image_key; ?>-container" data-field-label="<?php echo $background_image_label; ?>" class="acf-field-container">
				<div id="<?php echo $bg_img_animation_style_key; ?>-container" class="acf-field-container"></div>
			</div>
		</div>
	<?php } ?>	
	<?php if($eyebrow || $heading || $content) { ?>
		<div class="container">
			<div class="block-content-container"<?php if($content_alignment) { echo ' style="text-align: ' . $content_alignment . '"'; } ?>>
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
				<?php if(have_rows('pillbox_highlights')) { ?>
					<div class="pillbox-highlights lazy fade-in delay-one-quarter">
						<?php while(have_rows('pillbox_highlights')) { ?>
							<?php the_row(); ?>
							<?php $highlight_key = get_sub_field_object('highlight')['key']; ?>
							<?php $highlight_label = get_sub_field_object('highlight')['label']; ?>
							<?php $highlight = get_sub_field('highlight'); ?>
							<?php $slide_aria_label = ''; ?>
							<?php if($highlight) { ?>
								<div class="pillbox">
									<div id="<?php echo $highlight_key; ?>-container" data-field-label="<?php echo $hightlight_label; ?>" class="acf-field-container"></div>
									<?php echo $highlight; ?>
								</div>
							<?php } ?>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
			<div class="form-container lazy fade-in slow">
				<div data-tf-live="01HKZAX5GW9GDP3V0BG6QZHGB4"></div><script src="//embed.typeform.com/next/embed.js"></script>
			</div>
		</div>
	<?php } ?>
</section>