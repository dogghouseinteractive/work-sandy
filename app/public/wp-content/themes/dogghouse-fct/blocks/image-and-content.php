<?php global $block_count; ?>

<?php
	$block_image_key = get_sub_field_object('block_image')['key'];
	$block_image_label = get_sub_field_object('block_image')['label'];
	$block_image = get_sub_field('block_image');
	$layout_toggle_key = get_sub_field_object('layout_toggle')['key'];
	$layout_toggle_label = get_sub_field_object('layout_toggle')['label'];
	$layout_toggle = get_sub_field('layout_toggle');
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

<section id="block-<?php echo $block_count; ?>" class="flexible-content-block image-and-content<?php if($layout_toggle) { echo ' ' . $layout_toggle; } ?>" aria-labelledby="<?php echo $aria_label; ?>">
	<?php if($eyebrow || $heading || $content || $cta || $block_image) { ?>
		<div class="container">
			<?php if($block_image) { ?>
				<div class="block-image-container lazy fade-in slow">
					<div id="<?php echo $block_image_key; ?>" data-field-label="<?php echo $block_image_label; ?>" class="acf-field-container"></div>
						<object loading="lazy" class="lazyload" type="image/svg+xml" data="<?php echo $block_image; ?>">
							<img loading="lazy" class="lazyload" data-src="<?php echo $block_image; ?>">
						</object>
				</div>
			<?php } ?>
			<?php if($eyebrow || $heading || $content || $cta) { ?>
				<div class="block-content-container">
					<?php if($eyebrow) { ?>
						<h3 id="<?php echo $aria_label; ?>" class="eyebrow lazy fade-in-down slow delay-one-quarter">
							<?php echo $eyebrow; ?>
							<div id="<?php echo $eyebrow_key; ?>-container" data-field-label="<?php echo $eyebrow_label; ?>" class="acf-field-container"></div>
						</h3>
						
					<?php } ?>	
					<?php if($heading) { ?>
						<?php if($block_count == 0) { ?>
							<h1 class="lazy fade-in-down delay-one-quarter"<?php if(!$eyebrow) { echo ' id="'.$aria_label.'"'; } ?>>
								<?php echo $heading; ?>
								<div id="<?php echo $heading_key; ?>-container" data-field-label="<?php echo $heading_label; ?>" class="acf-field-container"></div>
							</h1>
						<?php } else { ?>
							<h2 class="lazy fade-in-down delay-one-quarter"<?php if(!$eyebrow) { echo ' id="'.$aria_label.'"'; } ?>>
								<?php echo $heading; ?>
								<div id="<?php echo $heading_key; ?>-container" data-field-label="<?php echo $heading_label; ?>" class="acf-field-container"></div>
							</h2>
						<?php } ?>
					<?php } ?>
					<?php if($content) { ?>
						<div class="block-content lazy fade-in-up delay-one-quarter">
							<div id="<?php echo $content_key; ?>-container" data-field-label="<?php echo $content_label; ?>" class="acf-field-container"></div>
							<?php echo $content; ?>
						</div>
					<?php } ?>
					<?php if($cta) { ?>
						<div class="cta lazy fade-in-up delay-one-half">
							<div id="<?php echo $cta_key; ?>-container" data-field-label="<?php echo $cta_label; ?>" class="acf-field-container">
								<div id="<?php echo $cta_class_key; ?>-container" class="acf-field-container"></div>
							</div>
							<a class="button <?php echo $cta_class; ?>" href="<?php echo $cta['url']; ?>" target="<?php echo $cta['target']; ?>"><?php echo $cta['title']; ?></a>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	<?php } ?>
</section>