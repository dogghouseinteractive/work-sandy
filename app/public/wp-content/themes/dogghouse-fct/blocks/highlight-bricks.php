<?php global $block_count; ?>

<?php 
	$background_image_1_key = get_sub_field_object('background_image_1')['key'];
	$background_image_1_label = get_sub_field_object('background_image_1')['label'];
	$background_image_1 = get_sub_field('background_image_1');
	$bg_img_1_animation_style_key = get_sub_field_object('bg_image_1_animation_style')['key'];
	$bg_img_1_animation_style = get_sub_field('bg_image_1_animation_style');
	$background_image_2_key = get_sub_field_object('background_image_2')['key'];
	$background_image_2_label = get_sub_field_object('background_image_2')['label'];
	$background_image_2 = get_sub_field('background_image_2');
	$bg_img_2_animation_style_key = get_sub_field_object('bg_image_2_animation_style')['key'];
	$bg_img_2_animation_style = get_sub_field('bg_image_2_animation_style');
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

<section id="block-<?php echo $block_count; ?>" class="flexible-content-block highlight-bricks" aria-labelledby="<?php echo $aria_label; ?>">
	<div class="acf-field-container"></div>
		<?php if($background_image_1) { ?>
			<div class="background-image-primary<?php if($bg_img_1_animation_style) { echo ' lazy slow ' . $bg_img_1_animation_style; } ?>" style="background-image: url(<?php echo $background_image_1; ?>);">
				<div id="<?php echo $background_image_1_key; ?>-container" data-field-label="<?php echo $background_image_1_label; ?>" class="acf-field-container">
					<div id="<?php echo $bg_img_1_animation_style_key; ?>-container" class="acf-field-container"></div>
				</div>
			</div>
		<?php } ?>
		<?php if($background_image_2) { ?>
			<div class="background-image-secondary<?php if($bg_img_2_animation_style) { echo ' lazy slow delay-one-quarter ' . $bg_img_2_animation_style; } ?>" style="background-image: url(<?php echo $background_image_2; ?>);">
				<div id="<?php echo $background_image_2_key; ?>-container" data-field-label="<?php echo $background_image_2_label; ?>" class="acf-field-container">
					<div id="<?php echo $bg_img_2_animation_style_key; ?>-container" class="acf-field-container"></div>
				</div>
			</div>
		<?php } ?>	
		<?php if($eyebrow || $heading || $content || $cta) { ?>
			<div class="container">
				<?php if($eyebrow) { ?>
					<h3 id="<?php echo $aria_label; ?>" class="eyebrow lazy fade-in-down slow delay-one-quarter"><?php echo $eyebrow; ?></h3>
				<?php } ?>	
				<div id="<?php echo $heading_key; ?>-container" data-field-label="<?php echo $heading_label; ?>" class="acf-field-container"></div>
				<?php if($heading) { ?>
					<?php if($block_count == 0) { ?>
						<h1 class="lazy fade-in-down delay-one-quarter"<?php if(!$eyebrow) { echo ' id="'.$aria_label.'"'; } ?>><?php echo $heading; ?></h1>
					<?php } else { ?>
						<h2 class="lazy fade-in-down delay-one-quarter"<?php if(!$eyebrow) { echo ' id="'.$aria_label.'"'; } ?>><?php echo $heading; ?></h2>
					<?php } ?>
				<?php } ?>
				<div id="<?php echo $content_key; ?>-container" data-field-label="<?php echo $content_label; ?>" class="acf-field-container"></div>
				<?php if($content) { ?>
					<div class="block-content lazy fade-in-up delay-one-quarter">
						<?php echo $content; ?>
					</div>
				<?php } ?>
				<?php if(have_rows('bricks')) { ?>
					<div class="bricks">
						<?php while(have_rows('bricks')) { ?>
							<?php the_row(); ?>
							<?php $brick_icon = get_sub_field('brick_icon'); ?>
							<?php $brick_title = get_sub_field('brick_title'); ?>
							<?php $brick_content = get_sub_field('brick_details'); ?>
							<div class="brick">
								<div class="front">
									<?php if($brick_icon) { ?>
										<div class="brick-icon" style="background-image: url(<?php echo $brick_icon; ?>);"></div>
									<?php } ?>
									<?php if($brick_title) { ?>
										<h3 class="brick-title"><?php echo $brick_title; ?></h3>
									<?php } ?>
								</div>
								<?php if($brick_content) { ?>
									<div class="back">
										<div class="brick-content">
											<?php echo $brick_content; ?>
										</div>
									</div>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
</section>