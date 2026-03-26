<?php global $block_count; ?>

<?php 
	$container_size_key = get_sub_field_object('container_size')['key'];
	$container_size_label = get_sub_field_object('container_size')['label'];
	$container_size = get_sub_field('container_size');
	$content_container_width_key = get_sub_field_object('content_container_width')['key'];
	$content_container_width_label = get_sub_field_object('content_container_width')['label'];
	$content_container_width = get_sub_field('content_container_width');
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
	$cta_key = get_sub_field_object('block_cta')['key'];
	$cta_label = get_sub_field_object('block_cta')['label'];
	$cta = get_sub_field('block_cta');
	$cta_class_key = get_sub_field_object('block_cta_class')['key'];
	$cta_class = get_sub_field('block_cta_class');
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

<section id="block-<?php echo $block_count; ?>" class="flexible-content-block full-width-text<?php if($container_size) { echo ' ' . $container_size; } ?>" aria-labelledby="<?php echo $aria_label; ?>">
	<div id="<?php echo $container_size_key; ?>-container" class="acf-field-container" data-field-label="<?php echo $container_size_label; ?>"></div>
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
			<div class="container"<?php if($content_container_width) { echo ' style="width: ' . $content_container_width . '%;'; } if($content_container_width <= 70) { echo ' margin-left: 15%;'; } if($content_container_width) { echo '"'; } ?>>
				<div id="<?php echo $content_container_width_key; ?>-container" data-field-label="<?php echo $content_container_width_label; ?>" class="acf-field-container"></div>
				<div id="<?php echo $eyebrow_key; ?>-container" data-field-label="<?php echo $eyebrow_label; ?>" class="acf-field-container"></div>
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
				<div id="<?php echo $cta_key; ?>-container" data-field-label="<?php echo $cta_label; ?>" class="acf-field-container">
					<div id="<?php echo $cta_class_key; ?>-container" class="acf-field-container"></div>
				</div>
				<?php if($cta) { ?>
					<div class="cta lazy fade-in-up delay-one-half">
						<a class="button <?php echo $cta_class; ?>" href="<?php echo $cta['url']; ?>" target="<?php echo $cta['target']; ?>"><?php echo $cta['title']; ?></a>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
</section>