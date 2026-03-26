<?php global $block_count; ?>

<?php
	$layout_toggle_key = get_sub_field_object('layout_toggle')['key'];
	$layout_toggle_label = get_sub_field_object('layout_toggle')['label'];
	$layout_toggle = get_sub_field('layout_toggle');
	$background_color_toggle_key = get_sub_field_object('background_color_toggle')['key'];
	$background_color_toggle_label = get_sub_field_object('background_color_toggle')['label'];
	$background_color_toggle = get_sub_field('background_color_toggle');
	$text_color_toggle_key = get_sub_field_object('text_color_toggle')['key'];
	$text_color_toggle_label = get_sub_field_object('text_color_toggle')['label'];
	$text_color_toggle = get_sub_field('text_color_toggle');
	$background_image_1_key = get_sub_field_object('background_image_1')['key'];
	$background_image_1_label = get_sub_field_object('background_image_1')['label'];
	$background_image_1 = get_sub_field('background_image_1');
	$bg_img_1_animation_style_key = get_sub_field_object('bg_image_1_animation_style')['key'];
	$bg_img_1_animation_style = get_sub_field('bg_image_1_animation_style');
	$background_image_2_key = get_sub_field_object('background_image_2')['key'];
	$background_image_2_label = get_sub_field_object('background_image_2')['label'];
	$background_image_2 = get_sub_field('background_image_2');
	$hero_image_key = get_sub_field_object('hero_image')['key'];
	$hero_image_label = get_sub_field_object('hero_image')['label'];
	$hero_image = get_sub_field('hero_image');
	$bg_img_2_animation_style_key = get_sub_field_object('bg_image_2_animation_style')['key'];
	$bg_img_2_animation_style = get_sub_field('bg_image_2_animation_style');
	$eyebrow_key = get_sub_field_object('hero_eyebrow')['key'];
	$eyebrow_label = get_sub_field_object('hero_eyebrow')['label'];
	$eyebrow = get_sub_field('hero_eyebrow');
	$heading_key = get_sub_field_object('hero_heading')['key'];
	$heading_label = get_sub_field_object('hero_heading')['label'];
	$heading = get_sub_field('hero_heading');
	$content_key = get_sub_field_object('hero_content')['key'];
	$content_label = get_sub_field_object('hero_content')['label'];
	$content = get_sub_field('hero_content');
	$cta_key = get_sub_field_object('hero_cta')['key'];
	$cta_label = get_sub_field_object('hero_cta')['label'];
	$cta = get_sub_field('hero_cta');
	$cta_class_key = get_sub_field_object('hero_cta_class')['key'];
	$cta_class = get_sub_field('hero_cta_class');
	$aria_label = '';
	if($eyebrow) {
		$aria_label = $eyebrow;
	} else if($heading) {
		$aria_label = $heading;
	} else {
		$aria_label = get_the_title();
	}
	$aria_label = strip_tags(str_replace(' ', '-', strtolower($aria_label)));
	$aria_label = preg_replace("/(?![-])\p{P}/u", "-", $aria_label); 
?>

<section id="block-<?php echo $block_count; ?>" class="flexible-content-block hero<?php if($layout_toggle) { echo ' ' . $layout_toggle; } if($background_color_toggle) { echo ' background-' . $background_color_toggle; } if($text_color_toggle) { echo ' text-' . $text_color_toggle;} ?>" aria-labelledby="<?php echo $aria_label; ?>">
	<?php if($layout_toggle == 'background-image') { ?>
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
	<?php } else { ?>
		<div class="hero-image parallax-background lazy fade-in slow" style="background-image: url(<?php echo $hero_image; ?>);">
			<div id="<?php echo $hero_image_key; ?>-container" data-field-label="<?php echo $hero_image_label; ?>" class="acf-field-container"></div>
		</div>
	<?php } ?>
	<?php if($eyebrow || $heading || $content || $cta) { ?>
		<div class="container">
			<?php if($eyebrow) { ?>
				<h3 id="<?php echo $aria_label; ?>" class="eyebrow lazy fade-in-down">
					<div id="<?php echo $eyebrow_key; ?>-container" data-field-label="<?php echo $eyebrow_label; ?>" class="acf-field-container"></div>
					<?php echo $eyebrow; ?>
				</h3>
			<?php } ?>	
			<?php if($heading) { ?>
				<?php if($block_count == 0) { ?>
					<h1 class="lazy<?php if($layout_toggle == 'background-image') { echo ' fade-in-down'; } else { echo ' fade-in-up'; } ?> delay-one-quarter"<?php if(!$eyebrow) { echo ' id="'.$aria_label.'"'; } ?>>	<div id="<?php echo $heading_key; ?>-container" data-field-label="<?php echo $heading_label; ?>" class="acf-field-container"></div>
						<?php echo $heading; ?>
					</h1>
				<?php } else { ?>
					<h2 class="lazy<?php if($layout_toggle == 'background-image') { echo ' fade-in-down'; } else { echo ' fade-in-up'; } ?> delay-one-quarter"<?php if(!$eyebrow) { echo ' id="'.$aria_label.'"'; } ?>>
							<div id="<?php echo $heading_key; ?>-container" data-field-label="<?php echo $heading_label; ?>"  class="acf-field-container"></div>
							<?php echo $heading; ?>
					</h2>
				<?php } ?>
			<?php } ?>
			<?php if($content) { ?>
				<div class="block-content-container <?php if($cta) { echo ' has-cta'; } ?>">
					<div class="block-content lazy fade-in-up delay-one-quarter">
						<div id="<?php echo $content_key; ?>-container" data-field-label="<?php echo $content_label; ?>"  class="acf-field-container"></div>
						<?php echo $content; ?>
					</div>
					<?php if($cta) { ?>
						<div class="cta">
							<div id="<?php echo $cta_key; ?>-container" data-field-label="<?php echo $cta_label; ?>" class="acf-field-container">
								<div id="<?php echo $cta_class_key; ?>-container" class="acf-field-container"></div>
							</div>
							<a class="button lazy fade-in-up delay-one-quarter <?php echo $cta_class; ?>" href="<?php echo $cta['url']; ?>" target="<?php echo $cta['target']; ?>"><?php echo $cta['title']; ?></a>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	<?php } ?>
</section>